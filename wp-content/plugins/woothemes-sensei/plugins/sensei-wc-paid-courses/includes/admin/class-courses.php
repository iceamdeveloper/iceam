<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Admin\Courses.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses\Admin;

use Sensei_WC;
use Sensei_WC_Utils;
use Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for admin functionality related to courses.
 *
 * @class Sensei_WC_Paid_Courses\Admin\Courses
 */
final class Courses {
	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Courses constructor. Prevents other instances from being created outside of `Courses::instance()`.
	 */
	private function __construct() {}

	/**
	 * Initializes the class and adds all filters and actions related to WP admin.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_action( 'add_meta_boxes', [ $this, 'meta_box_setup' ], 20 );
		add_filter( 'sensei_course_meta_default_save', [ $this, 'disable_default_save_for_course_woocommerce_product' ], 10, 3 );
		add_action( 'sensei_course_meta_before_save', [ $this, 'save_course_woocommerce_product' ], 10, 3 );
		add_filter( 'update_post_metadata', [ $this, 'save_course_woocommerce_product_fallback' ], 10, 4 );
		add_filter( 'manage_edit-course_columns', [ $this, 'add_column_headings' ], 10, 1 );
		add_action( 'manage_posts_custom_column', [ $this, 'add_column_data' ], 10, 2 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	/**
	 * Add meta boxes to product pages.
	 *
	 * @since 1.0.0
	 */
	public function meta_box_setup() {
		// Add Meta Box for WooCommerce Course.
		$block_editor_supported = Sensei_WC_Paid_Courses::instance()->is_block_editor_supported();
		add_meta_box( 'course-wc-product', __( 'Products', 'sensei-wc-paid-courses' ), [ $this, 'course_woocommerce_product_meta_box_content' ], 'course', 'side', 'default', [ '__back_compat_meta_box' => $block_editor_supported ] );
	}

	/**
	 * Disable default save for the `_course_woocommerce_product` meta.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @param bool   $do_save     Whether to do the default save.
	 * @param int    $course_id   The course ID.
	 * @param string $meta_key    The key of the meta to be saved.
	 *
	 * @return bool `true` if the default save should be done, `false` otherwise.
	 */
	public function disable_default_save_for_course_woocommerce_product( $do_save, $course_id, $meta_key ) {
		return $do_save && '_course_woocommerce_product' !== $meta_key;
	}

	/**
	 * Save the `_course_woocommerce_product` meta with the new array of product
	 * IDs. Used with Sensei's `sensei_course_meta_before_save` hook.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @param int    $course_id   The course ID.
	 * @param string $meta_key    The key of the meta to be saved.
	 * @param mixed  $product_ids The product IDs.
	 */
	public function save_course_woocommerce_product( $course_id, $meta_key, $product_ids ) {
		if ( '_course_woocommerce_product' !== $meta_key ) {
			return;
		}

		// Ensure array.
		if ( ! is_array( $product_ids ) ) {
			$product_ids = [ $product_ids ];
		}

		$this->set_course_products( $course_id, $product_ids );
	}

	/**
	 * Fallback method to ensure that the `_course_woocommerce_product` meta is
	 * being saved properly when Sensei LMS is at a version before 2.2.0. This
	 * should be added to the `update_post_metadata` filter.
	 *
	 * This fallback may be removed after the number of sites on WCPC > 1.1.0
	 * and Sensei LMS < 2.2.0 is small.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @param bool   $check      Whether to allow updating metadata.
	 * @param int    $object_id  The object ID.
	 * @param string $meta_key   The meta to be updated.
	 * @param mixed  $meta_value The new value being set.
	 *
	 * @return null|bool
	 */
	public function save_course_woocommerce_product_fallback( $check, $object_id, $meta_key, $meta_value ) {
		// Only process when the course product is being set to an array, and
		// when `$check` is `null` (indicating that the update has not already
		// been disallowed by another filter).
		if (
			null !== $check
			|| 'course' !== get_post_type( $object_id )
			|| '_course_woocommerce_product' !== $meta_key
			|| ! is_array( $meta_value )
		) {
			return $check;
		}

		// Save the meta correctly, and prevent the default functionality.
		$this->save_course_woocommerce_product( $object_id, $meta_key, $meta_value );
		return false;
	}

	/**
	 * Helper function for setting the product IDs on a course.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @param int   $course_id   The course ID.
	 * @param array $product_ids The product IDs to be set.
	 */
	private function set_course_products( $course_id, $product_ids ) {
		$meta_key = '_course_woocommerce_product';

		// phpcs:ignore Squiz.Commenting.InlineComment
		// Only use valid product IDs. See post__in workaround suggestion here - https://core.trac.wordpress.org/ticket/28099#comment:28
		$valid_product_ids = get_posts(
			[
				'post_type'      => [ 'product', 'product_variation' ],
				'status'         => 'any',
				'post__in'       => empty( $product_ids ) ? [ 0 ] : $product_ids,
				'fields'         => 'ids',
				'posts_per_page' => -1,
			]
		);

		// Set the new array of product IDs in place of the old ones.
		delete_post_meta( $course_id, $meta_key );
		foreach ( $valid_product_ids as $product_id ) {
			add_post_meta( $course_id, $meta_key, $product_id );
		}
	}

	/**
	 * Outputs the Product select field on course pages.
	 *
	 * @since 1.0.0
	 */
	public function course_woocommerce_product_meta_box_content() {
		global $post;

		$select_course_woocommerce_products = Sensei_WC::get_course_product_ids( $post->ID, false );

		$posts_array = \Sensei_WC_Paid_Courses\Courses::instance()->get_assignable_products( $post );

		$html = '';

		$html .= '<input type="hidden" name="' . esc_attr( 'woo_course_noonce' ) . '" id="' . esc_attr( 'woo_course_noonce' ) . '" value="' . esc_attr( wp_create_nonce( plugin_basename( __FILE__ ) ) ) . '" />';

		if ( count( $posts_array ) > 0 ) {

			$html          .= '<select id="course-woocommerce-product-options" name="course_woocommerce_product[]" class="chosen_select widefat" multiple>' . "\n";
			$prev_parent_id = 0;

			foreach ( $posts_array as $post_item ) {

				if ( 'product_variation' === $post_item->post_type ) {

					$product_object = wc_get_product( $post_item->ID );

					if ( empty( $product_object ) ) {
						// Product variation has been orphaned. Treat it like it has also been deleted.
						continue;
					}

					$parent_id = intval( wp_get_post_parent_id( $post_item->ID ) );

					$formatted_variation = wc_get_formatted_variation( Sensei_WC_Utils::get_variation_data( $product_object ), true );

					$product_name = ucwords( $formatted_variation );
					if ( empty( $product_name ) ) {
						$product_name = __( 'Variation #', 'sensei-wc-paid-courses' ) . Sensei_WC_Utils::get_product_variation_id( $product_object );
					}
				} else {

					$parent_id      = false;
					$prev_parent_id = 0;
					$product_name   = $post_item->post_title;

				}

				// Show variations in groups.
				if ( $parent_id && $parent_id !== $prev_parent_id ) {

					if ( 0 !== $prev_parent_id ) {

						$html .= '</optgroup>';

					}
					$html          .= '<optgroup label="' . esc_attr( get_the_title( $parent_id ) ) . '">';
					$prev_parent_id = $parent_id;

				} elseif ( ! $parent_id && 0 === $prev_parent_id ) {

					$html .= '</optgroup>';

				}

				$html .= '<option value="' . esc_attr( absint( $post_item->ID ) ) . '"';
				$html .= in_array( $post_item->ID, $select_course_woocommerce_products, true ) ? ' selected' : '';
				$html .= '>' . esc_html( $product_name ) . '</option>' . "\n";

			} // End For Loop.

			$html .= '</select>' . "\n";
			if ( current_user_can( 'publish_product' ) ) {

				$html .= '<p>' . "\n";
				$html .= '<a href="' . esc_url( admin_url( 'post-new.php?post_type=product' ) ) . '" title="' . esc_attr( __( 'Add a Product', 'sensei-wc-paid-courses' ) ) . '">' . esc_html__( 'Add a Product', 'sensei-wc-paid-courses' ) . '</a>' . "\n";
				$html .= '</p>' . "\n";

			} // End If Statement.
		} else {

			if ( current_user_can( 'publish_product' ) ) {

				$html .= '<p>' . "\n";
				$html .= esc_html__( 'No products exist yet.', 'sensei-wc-paid-courses' ) . '&nbsp;<a href="' . esc_url( admin_url( 'post-new.php?post_type=product' ) ) . '" title="' . esc_attr( __( 'Add a Product', 'sensei-wc-paid-courses' ) ) . '">' . esc_html__( 'Please add some first', 'sensei-wc-paid-courses' ) . '</a>' . "\n";
				$html .= '</p>' . "\n";

			} else {
				foreach ( $select_course_woocommerce_products as $product_id ) {
					$html .= '<input type="hidden" name="course_woocommerce_product[]" value="' . esc_attr( $product_id ) . '">';
				}
				$html .= '<p>' . "\n";
				$html .= esc_html( __( 'No products exist yet.', 'sensei-wc-paid-courses' ) ) . "\n";
				$html .= '</p>' . "\n";

			} // End If Statement.
		} // End If Statement.

		echo wp_kses(
			$html,
			array_merge(
				wp_kses_allowed_html( 'post' ),
				[
					'input'    => [
						'id'    => [],
						'name'  => [],
						'type'  => [],
						'value' => [],
					],
					'optgroup' => [
						'label' => [],
					],
					'option'   => [
						'selected' => [],
						'value'    => [],
					],
					'select'   => [
						'class'    => [],
						'id'       => [],
						'name'     => [],
						'multiple' => [],
					],
				]
			)
		);
	} // End course_woocommerce_product_meta_box_content()

	/**
	 * Add column headings to the course listing in WP admin.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $defaults Default column headings for the course listing page.
	 * @return array
	 */
	public function add_column_headings( $defaults ) {
		$columns                                   = [];
		$new_columns                               = [];
		$new_columns['course-woocommerce-product'] = _x( 'Products', 'column name', 'sensei-wc-paid-courses' );

		foreach ( $defaults as $key => $value ) {
			$columns[ $key ] = $value;
			if ( 'course-prerequisite' === $key ) {
				$columns += $new_columns;
			}
		}

		// Add the column if it wasn't added after `course-prerequisite`.
		if ( $columns === $defaults ) {
			$columns += $new_columns;
		}
		return $columns;
	}

	/**
	 * Output data for the Products column on the course listing page in WP admin.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $column_name Column name.
	 * @param  int    $course_id   Course ID.
	 */
	public function add_column_data( $column_name, $course_id ) {
		if ( ! Sensei_WC::is_woocommerce_active() || ( 'course-woocommerce-product' !== $column_name ) ) {
			return;
		}

		$product_ids = Sensei_WC::get_course_product_ids( $course_id, false );

		if ( ! $product_ids ) {
			return;
		}

		$last_product_id = end( $product_ids );

		foreach ( $product_ids as $product_id ) {
			$variation_id = null;

			if ( 'product_variation' === get_post_type( $product_id ) ) {
				$product_object = wc_get_product( $product_id );

				if ( ! ( $product_object instanceof \WC_Product ) ) {
					continue;
				}

				$product_name = $product_object->get_name();
				$variation_id = $product_object->get_id();
				$product_id   = Sensei_WC_Utils::get_product_id( $product_object );
			} else {
				$product_name = get_the_title( $product_id );
			}

			echo '<a href="' . esc_url( get_edit_post_link( $product_id ) ) . '">'
				. wp_kses( $product_name, [ 'br' => [] ] )
				. '</a>';

			// Append comma to all products except the last one. For variations, ensure we check against
			// the variation ID and not the parent product ID.
			if ( $variation_id ) {
				$product_id = $variation_id;
			}

			if ( $last_product_id !== $product_id ) {
				echo ', ';
			}
		}
	}

	/**
	 * Add the product select field to the form in the Course Select meta box on the edit lesson page.
	 *
	 * @since 1.0.0
	 */
	public function add_lesson_course_product_field() {
		_deprecated_function( __METHOD__, '1.1.0' );

		$html         = '';
		$product_args = [
			'post_type'        => [ 'product', 'product_variation' ],
			'posts_per_page'   => -1,
			'orderby'          => 'title',
			'order'            => 'DESC',
			'post_status'      => [ 'publish', 'private', 'draft' ],
			'tax_query'        => [
				[
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => [ 'variable', 'grouped' ],
					'operator' => 'NOT IN',
				],
			],
			'suppress_filters' => 0,
		];

		$products_array = get_posts( $product_args );
		$html          .= '<label>' . esc_html__( 'WooCommerce Product', 'sensei-wc-paid-courses' ) . '</label> ';
		$html          .= '<select id="course-woocommerce-product-options" name="course_woocommerce_product" class="chosen_select widefat" style="width: 100%">' . "\n";
		$html          .= '<option value="-">' . esc_html__( 'None', 'sensei-wc-paid-courses' ) . '</option>';
		$prev_parent_id = 0;

		foreach ( $products_array as $products_item ) {

			if ( 'product_variation' === $products_item->post_type ) {
				$product_object = wc_get_product( $products_item->ID );
				if ( empty( $product_object ) ) {
					// Product variation has been orphaned. Treat it like it has also been deleted.
					continue;
				}
				$parent_id    = intval( Sensei_WC_Utils::get_product_id( $product_object ) );
				$product_name = ucwords( wc_get_formatted_variation( Sensei_WC_Utils::get_variation_data( $product_object ), true ) );
			} else {
				$parent_id      = false;
				$prev_parent_id = 0;
				$product_name   = $products_item->post_title;
			}

			// Show variations in groups.
			if ( $parent_id && $parent_id !== $prev_parent_id ) {
				if ( 0 !== $prev_parent_id ) {
					$html .= '</optgroup>';
				}
				$html          .= '<optgroup label="' . esc_attr( get_the_title( $parent_id ) ) . '">';
				$prev_parent_id = $parent_id;
			} elseif ( ! $parent_id && 0 === $prev_parent_id ) {
				$html .= '</optgroup>';
			}

			$html .= '<option value="' . esc_attr( absint( $products_item->ID ) ) . '">' . esc_html( $product_name ) . '</option>' . "\n";
		} // End For Loop.
		$html .= '</select>' . "\n";

		echo wp_kses(
			$html,
			[
				'optgroup' => [
					'label' => [],
				],
				'option'   => [
					'selected' => [],
					'value'    => [],
				],
				'select'   => [
					'class' => [],
					'id'    => [],
					'name'  => [],
					'style' => [],
				],
			]
		);
	}

	/**
	 * Triggers after a course was created from the lesson page meta box. Handles the saving of the product ID field.
	 *
	 * @since 1.0.0
	 *
	 * @param int   $course_id Course ID that was just created.
	 * @param array $data      Data that was sent when creating the course.
	 */
	public function lesson_course_handle_product_id( $course_id, $data ) {
		_deprecated_function( __METHOD__, '1.1.0' );

		$course_woocommerce_product_id = isset( $data['course_woocommerce_product'] ) ? absint( $data['course_woocommerce_product'] ) : '-';
		if ( 0 === $course_woocommerce_product_id ) {
			$course_woocommerce_product_id = '-';
		}
		add_post_meta( $course_id, '_course_woocommerce_product', $course_woocommerce_product_id );
	}

	/**
	 * Enqueues admin scripts when needed on different screens.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {
		$screen = get_current_screen();
		if ( in_array( $screen->id, [ 'lesson', 'course' ], true ) ) {
			wp_enqueue_script( Sensei_WC_Paid_Courses::SCRIPT_ADMIN_COURSE_METADATA );
		}
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
