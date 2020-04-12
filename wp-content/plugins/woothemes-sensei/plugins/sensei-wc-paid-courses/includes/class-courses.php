<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Courses.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Sensei_WC;
use Sensei_WC_Utils;
use Sensei_Utils;
use WC_Order;
use WP_Query;

/**
 * Class for general functionality related to courses.
 *
 * @class Sensei_WC_Paid_Courses\Courses
 */
final class Courses {
	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Courses constructor. Prevents other instances from being created outside of `Course::instance()`.
	 */
	private function __construct() {}

	/**
	 * Initializes the class and adds all filters and actions.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_filter( 'sensei_course_meta_fields', [ $this, 'add_course_product_meta_field' ] );

		// Remove course from active courses if an order is cancelled or refunded.
		add_action( 'woocommerce_order_status_processing_to_cancelled', [ $this, 'remove_active_course' ], 10, 1 );
		add_action( 'woocommerce_order_status_completed_to_cancelled', [ $this, 'remove_active_course' ], 10, 1 );
		add_action( 'woocommerce_order_status_on-hold_to_cancelled', [ $this, 'remove_active_course' ], 10, 1 );
		add_action( 'woocommerce_order_status_processing_to_refunded', [ $this, 'remove_active_course' ], 10, 1 );
		add_action( 'woocommerce_order_status_completed_to_refunded', [ $this, 'remove_active_course' ], 10, 1 );
		add_action( 'woocommerce_order_status_on-hold_to_refunded', [ $this, 'remove_active_course' ], 10, 1 );

		// Check for purchased but unactivated courses on My Courses page.
		add_action( 'wp', [ $this, 'activate_purchased_courses_my_courses_page' ] );

		// Check for purchased but unactivated courses on Learner Profile page.
		add_action( 'sensei_before_my_courses', [ $this, 'activate_purchased_courses' ] );

		// Check for purchased but unactivated course on an individual course page.
		add_action( 'sensei_single_course_content_inside_before', [ $this, 'activate_purchased_single_course' ] );

		add_action( 'rest_api_init', [ $this, 'setup_rest_api_meta' ] );
	}

	/**
	 * Sets up the meta fields saved on course save in WP admin.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $course_meta_fields Array of meta field key names to save on course save.
	 * @return string[]
	 */
	public function add_course_product_meta_field( $course_meta_fields ) {
		$meta_box_save   = $this->is_meta_box_save_request();
		$sidebar_enabled = Sensei_WC_Paid_Courses::instance()->is_block_editor_supported();
		$prevent_save    = $meta_box_save && $sidebar_enabled;

		// Only save the product meta if we are not using the block editor sidebar for that.
		if ( ! $prevent_save ) {
			$course_meta_fields[] = 'course_woocommerce_product';
		}

		return $course_meta_fields;
	}

	/**
	 * Determine whether the current request is a "meta box save" request
	 * (typically run by the block editor).
	 *
	 * @since 1.1.0
	 * @access private
	 */
	private function is_meta_box_save_request() {
		// phpcs:ignore WordPress.Security.NonceVerification
		return isset( $_REQUEST['meta-box-loader'] ) && '1' === $_REQUEST['meta-box-loader'];
	}

	/**
	 * Backward-compatible version of `get_product_courses`. This should not
	 * be used by any new code. Use `get_product_courses` instead.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param  int $product_id Post ID for the product (default: 0).
	 * @return array
	 */
	public static function _back_compat_get_product_courses( $product_id = 0 ) { // @phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore -- Temporary private method.

		$courses = [];

		if ( ! Sensei_WC::is_woocommerce_active() || empty( $product_id ) ) {
			return $courses;
		}

		$product = wc_get_product( $product_id );

		if ( ! ( $product instanceof \WC_Product ) ) {
			return $courses;
		}

		$courses = get_posts( self::get_product_courses_query_args( $product_id ) );

		switch ( $product->get_type() ) {
			case 'subscription_variation':
			case 'variation':
				/**
				 * Merge a product variation's courses with the parent's courses. Defaults to false.
				 *
				 * @since 1.0.0
				 *
				 * @param bool $merge_courses_with_parent_product True to merge with parent product's courses.
				 */
				if ( empty( $courses ) || apply_filters( 'sensei_wc_paid_courses_merge_courses_with_parent_product', false ) ) {
					$parent_product_courses = get_posts( self::get_product_courses_query_args( $product->get_parent_id() ) );
					$courses                = array_merge( $courses, $parent_product_courses );
				}
				break;

			case 'variable-subscription':
			case 'variable':
				if ( ! ( $product instanceof \WC_Product_Variable ) ) {
					break;
				}

				$variations = $product->get_available_variations();

				foreach ( $variations as $variation ) {

					$variation_courses = get_posts( self::get_product_courses_query_args( $variation['variation_id'] ) );
					$courses           = array_merge( $courses, $variation_courses );

				}
				break;
		}

		return $courses;
	} // End _back_compat_get_product_courses()

	/**
	 * Get all the courses attached to a product or set of products.
	 *
	 * The definition for attachment is as follows:
	 *
	 * Given a product, the set of courses that are “attached” to that product
	 * are the courses to which a user would gain access if that product were
	 * purchased.
	 *
	 * To only get products that are directly attached using the
	 * `_course_woocommerce_product` meta, see
	 * `get_direct_attached_product_courses`.
	 *
	 * @since 1.0.0
	 * @since 1.2.0 New definition of attached products are applied. Internally, legacy approach moved to `Courses::_back_compat_get_product_courses`.
	 *
	 * @param int|array $product_id Post ID for the product or array of post IDs.
	 *
	 * @return array
	 */
	public static function get_product_courses( $product_id = [] ) {
		$courses = [];

		if ( ! Sensei_WC::is_woocommerce_active() || empty( $product_id ) ) {
			return $courses;
		}

		// Get array of product IDs.
		$product_ids = is_array( $product_id ) ? $product_id : [ $product_id ];

		// For product variations, include the parents in the list.
		$parent_ids = [];

		foreach ( $product_ids as $id ) {
			$product = wc_get_product( $id );

			if ( ! ( $product instanceof \WC_Product ) ) {
				continue;
			}

			$product_type = $product->get_type();

			if ( in_array( $product_type, [ 'subscription_variation', 'variation' ], true ) ) {
				$parent_ids[] = $product->get_parent_id();
			}
		}

		$product_ids = array_merge( $product_ids, $parent_ids );

		// Fetch courses for given product IDs.
		$courses = self::get_direct_attached_product_courses( $product_ids );

		/**
		 * Filter the array of courses attached to the given products. The
		 * courses returned should be all courses to which a user would
		 * gain access if they purchased the given products.
		 *
		 * @param WP_Post[] $course      The array of courses.
		 * @param array     $product_ids The array of product IDs.
		 * @param array     $args        The additional query args.
		 */
		$courses = apply_filters( 'sensei_wc_paid_courses_get_product_courses', $courses, $product_ids );

		return $courses;
	}

	/**
	 * Get all the courses that are directly attached to a product through the
	 * `_course_woocommerce_product` meta field.
	 *
	 * @since 1.2.0
	 *
	 * @param int|array $product_id Post ID for the product or array of post IDs.
	 *
	 * @return array
	 */
	public static function get_direct_attached_product_courses( $product_id ) {
		if ( empty( $product_id ) ) {
			return [];
		}

		return get_posts( self::get_product_courses_query_args( $product_id ) );
	}

	/**
	 * Generates the query arguments used to retrieve a product's courses.
	 *
	 * @since 1.0.0
	 *
	 * @param int|array $product_id Product ID to query, or array of product IDs.
	 * @return array
	 */
	public static function get_product_courses_query_args( $product_id ) {

		return [
			'post_type'        => 'course',
			'posts_per_page'   => -1,
			'meta_key'         => '_course_woocommerce_product',
			'meta_value'       => is_array( $product_id ) ? $product_id : [ $product_id ],
			'meta_compare'     => 'IN',
			'post_status'      => 'publish',
			'suppress_filters' => 0,
			'orderby'          => 'menu_order date',
			'order'            => 'ASC',
		];

	}

	/**
	 * Remove all active courses when an order is refunded or cancelled.
	 *
	 * @since 1.0.0
	 *
	 * @param  integer $order_id ID of order.
	 */
	public function remove_active_course( $order_id ) {
		$order   = wc_get_order( $order_id );
		$user_id = get_post_meta( $order_id, '_customer_user', true );

		if ( ! $user_id || ! $order ) {
			return;
		}

		$course_ids_from_order        = [];
		$course_ids_from_other_orders = [];

		$active_orders_query_args = [
			'post_type'      => 'shop_order',
			'posts_per_page' => -1,
			'post_status'    => [ 'wc-processing', 'wc-completed' ],
			'meta_key'       => '_customer_user',
			'meta_value'     => $user_id,
			'fields'         => 'ids',
		];

		$order_ids_to_check   = get_posts( $active_orders_query_args );
		$order_ids_to_check[] = $order_id;

		foreach ( $order_ids_to_check as $user_order_id ) {
			$order = wc_get_order( $user_order_id );

			if ( ! $order ) {
				continue;
			}

			foreach ( $order->get_items() as $item ) {
				if ( isset( $item['variation_id'] ) && ( 0 < $item['variation_id'] ) ) {
					// If item has variation_id then its a variation of the product.
					$item_id = $item['variation_id'];
				} else {
					// Than its real product set it's id to item_id.
					$item_id = $item['product_id'];
				}

				if ( 0 === $item_id ) {
					continue;
				}

				$product = Sensei_WC::get_product_object( $item_id );

				if ( ! is_object( $product ) ) {
					continue;
				}

				$product_courses = self::get_product_courses( $product->get_id() );

				if ( $product_courses && count( $product_courses ) > 0 ) {
					foreach ( $product_courses as $course ) {

						if ( $user_order_id === $order_id ) {
							if ( ! in_array( $course->ID, $course_ids_from_order, true ) ) {
								$course_ids_from_order[] = $course->ID;
							}
						} else {
							if ( ! in_array( $course->ID, $course_ids_from_other_orders, true ) ) {
								$course_ids_from_other_orders[] = $course->ID;
							}
						}
					} // End For Loop
				} // End If Statement
			} // End For Loop
		}

		foreach ( $course_ids_from_order as $order_course_id ) {
			if ( ! in_array( $order_course_id, $course_ids_from_other_orders, true ) ) {
				// Remove all course user meta.
				Sensei_Utils::sensei_remove_user_from_course( $order_course_id, $user_id );
			}
		}

	} // End remove_active_course()


	/**
	 * Assign user to unassigned purchased course when visiting the My Courses page.
	 *
	 * @since 1.2.0
	 */
	public function activate_purchased_courses_my_courses_page() {
		global $wp_query;

		if ( is_admin() || ! Sensei_WC::is_my_courses_page( $wp_query ) || ! is_user_logged_in() ) {
			return;
		}

		$this->activate_purchased_courses( get_current_user_id() );
	}

	/**
	 * Activate all purchased courses for user.
	 *
	 * @since  1.0.0
	 * @param  integer $user_id User ID.
	 * @return void
	 */
	public function activate_purchased_courses( $user_id = 0 ) {
		if ( ! $user_id ) {
			return;
		}

		$order_course_data = Sensei_WC::get_purchased_course_data_for_user( $user_id );

		foreach ( $order_course_data as $data ) {
			$order_id  = $data['order_id'];
			$course_id = $data['course_id'];

			if ( ! Sensei_WC_Utils::has_user_started_or_completed_course( $user_id, $course_id ) ) {
				Sensei_Utils::user_start_course( $user_id, $course_id );
			}
		}
	} // End activate_purchased_courses()

	/**
	 * Activate single course if already purchased.
	 *
	 * @return void
	 */
	public function activate_purchased_single_course() {
		global $post, $current_user;

		if ( ! is_user_logged_in() ) {
			return;
		}

		if ( ! isset( $post->ID ) ) {
			return;
		}

		$user_id            = $current_user->ID;
		$course_id          = $post->ID;
		$course_product_ids = Sensei_WC::get_course_product_ids( $course_id );

		if ( empty( $course_product_ids ) ) {
			return;
		}

		$user_course_status = Sensei_Utils::user_course_status( intval( $course_id ), $user_id );

		// Ignore course if already completed.
		if ( Sensei_Utils::user_completed_course( $course_id ) ) {
			return;
		}

		// Ignore course if already started.
		if ( $user_course_status ) {
			return;
		}

		// Get all user's orders.
		$order_args = [
			'post_type'      => 'shop_order',
			'posts_per_page' => -1,
			'post_status'    => [ 'wc-processing', 'wc-completed' ],
			'meta_query'     => [
				[
					'key'   => '_customer_user',
					'value' => $user_id,
				],
			],
			'fields'         => 'ids',
		];
		$orders     = get_posts( $order_args );

		foreach ( $orders as $order_post_id ) {

			// Get course product IDs from order.
			$order = new WC_Order( $order_post_id );

			$items = $order->get_items();
			foreach ( $items as $item ) {
				$product_id = Sensei_WC_Utils::get_item_id_from_item( $item );
				$product    = wc_get_product( $product_id );

				if ( ! ( $product instanceof \WC_Product ) ) {
					continue;
				}

				// handle product bundles.
				if ( is_object( $product ) && $product->is_type( 'bundle' ) ) {

					$bundled_product = new \WC_Product_Bundle( Sensei_WC_Utils::get_product_id( $product ) );
					$bundled_items   = $bundled_product->get_bundled_items();

					foreach ( $bundled_items as $bundled_item ) {
						if ( in_array( intval( $bundled_item->product_id ), $course_product_ids, true ) ) {
							Sensei_Utils::user_start_course( $user_id, $course_id );
							return;
						}
					}
				} else {

					// handle regular products.
					if ( in_array( intval( $item['product_id'] ), $course_product_ids, true ) ) {
						Sensei_Utils::user_start_course( $user_id, $course_id );
						return;
					}
				}
			}
		}
	} // End activate_purchased_single_course()

	/**
	 * Set up meta in REST API.
	 *
	 * @access private
	 * @since 1.1.0
	 */
	public function setup_rest_api_meta() {
		// Ensure Courses support custom fields.
		add_post_type_support( 'course', 'custom-fields' );

		register_post_meta(
			'course',
			'_course_woocommerce_product',
			[
				'type'              => 'integer',
				'description'       => 'An array of Product IDs attached to this course.',
				'single'            => false,
				'show_in_rest'      => true,
				'sanitize_callback' => function( $value ) {
					return intval( $value );
				},
				'auth_callback'     => function() {
					return current_user_can( 'edit_courses' );
				},
			]
		);

		// Deal with 0 values for ID's. These occur when the meta value is set
		// to "-" from the UI component.
		add_filter(
			'rest_prepare_course',
			function( $response ) {
				if ( isset( $response->data['meta'] ) && isset( $response->data['meta']['_course_woocommerce_product'] ) ) {
					$response->data['meta']['_course_woocommerce_product'] = array_filter( $response->data['meta']['_course_woocommerce_product'] );
				}

				return $response;
			}
		);

		add_action( 'rest_insert_course', [ $this, 'sanitize_course_woocommerce_product' ], 10, 2 );
	}


	/**
	 * Filter out non-product posts and products that have been trashed from REST API change requests.
	 *
	 * @access private
	 * @since 1.2.0
	 *
	 * @param \WP_Post         $course  Course post object.
	 * @param \WP_REST_Request $request REST request object.
	 */
	public function sanitize_course_woocommerce_product( $course, $request ) {
		$body = $request->get_json_params();

		if ( isset( $body['meta'] ) && isset( $body['meta']['_course_woocommerce_product'] ) ) {
			$products = $body['meta']['_course_woocommerce_product'];

			if ( ! is_array( $products ) ) {
				$products = [ $products ];
			}

			$body['meta']['_course_woocommerce_product'] = [];
			foreach ( $products as $key => $product_id ) {
				if (
					empty( $product_id )
					|| ! in_array( get_post_type( intval( $product_id ) ), [ 'product', 'product_variation' ], true )
					|| 'trash' === get_post_status( intval( $product_id ) )
				) {
					continue;
				}

				$body['meta']['_course_woocommerce_product'][] = intval( $product_id );
			}
		}

		$request->set_body( wp_json_encode( $body ) );
	}

	/**
	 * Gets the products which may be assigned to the given course. If no course
	 * is given, gets all products which may be assigned to a course.
	 *
	 * @since 1.2.0
	 *
	 * @param int|WP_Post|null $course     The course or the course ID.
	 * @param array|null       $query_args Additional arguments to be added to
	 *                                     the `get_posts` query.
	 *
	 * @return array The array of products
	 */
	public function get_assignable_products( $course = null, $query_args = [] ) {
		$defaults = [
			'post_type'        => [ 'product', 'product_variation' ],
			'posts_per_page'   => -1,
			'orderby'          => 'title',
			'order'            => 'DESC',
			'post_status'      => 'any',
			'tax_query'        => [
				[
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => [ 'grouped' ],
					'operator' => 'NOT IN',
				],
			],
			'suppress_filters' => 0,
		];
		$args     = wp_parse_args( $query_args, $defaults );

		// Get the WP_Post object for the course, if possible.
		if ( $course ) {
			$course = get_post( $course );
		}

		/**
		 * Filter the query arguments for getting products assignable to a
		 * course.
		 *
		 * @since 1.2.0
		 *
		 * @param array        $args   The query args.
		 * @param WP_Post|null $course The course as a WP_Post.
		 */
		$args = apply_filters( 'sensei_wc_paid_courses_assignable_products_query_args', $args, $course );

		return get_posts( $args );
	}

	/**
	 * Fetches an instance of the class.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

}
