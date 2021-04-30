<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Blocks\Block_Purchase_Course.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses\Blocks;

use Sensei_WC;
use Sensei_WC_Utils;
use Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses;
use Sensei_WC_Paid_Courses\Frontend\Courses;
use Sensei_WC_Paid_Courses\Course_Enrolment_Providers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Block for Purchase course button.
 */
class Block_Purchase_Course {
	/**
	 * Take course block render callback.
	 *
	 * @var callable
	 */
	private $render_take_course;

	/**
	 * Course product IDs.
	 *
	 * @var \WC_Product[]
	 */
	private $products;

	/**
	 * Button HTML.
	 *
	 * @var string
	 */
	private $button;

	/**
	 * Course ID.
	 *
	 * @var int
	 */
	private $course_id;

	/**
	 * Initialize block.
	 */
	public static function init() {
		new self();
	}

	/**
	 * Block_Purchase_Course constructor.
	 */
	public function __construct() {
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_block_assets' ] );
		add_filter( 'sensei_block_type_args', [ $this, 'extend_take_course_block' ], 10, 2 );
		add_action( 'template_redirect', [ $this, 'setup_single_course_page_with_blocks' ] );
	}

	/**
	 * Handle block-based single course page.
	 *
	 * @access private
	 */
	public function setup_single_course_page_with_blocks() {
		global $post;

		$is_legacy_course = true;
		if ( method_exists( Sensei()->course, 'is_legacy_course' ) ) {
			$is_legacy_course = Sensei()->course->is_legacy_course( $post );
		}

		// Remove legacy actions on courses with new blocks.
		if (
			$post
			&& is_singular( 'course' )
			&& ! $is_legacy_course
		) {
			$this->remove_legacy_course_actions();
		}
	}

	/**
	 * Remove single course page actions not needed for blocks.
	 */
	private function remove_legacy_course_actions() {
		remove_action( 'sensei_single_course_content_inside_before', [ 'Sensei_WC', 'course_in_cart_message' ], 20 );
	}

	/**
	 * Enqueue frontend and editor assets.
	 *
	 * @access private
	 */
	public function enqueue_block_assets() {
		if ( 'course' !== get_post_type() ) {
			return;
		}

		if ( isset( Sensei_WC_Paid_Courses::instance()->assets ) ) {
			Sensei_WC_Paid_Courses::instance()->assets->enqueue( 'sensei-wcpc-blocks', 'blocks/blocks.css' );

			if ( ! is_admin() ) {
				Sensei_WC_Paid_Courses::instance()->assets->enqueue( 'sensei-wcpc-block-purchase-course-frontend', 'blocks/purchase-course/frontend.js', [], true );
			}
		}
	}

	/**
	 * Extend take course block.
	 *
	 * @access private
	 *
	 * @param array  $args Block settings.
	 * @param string $name Block name.
	 *
	 * @return array
	 */
	public function extend_take_course_block( $args, $name ) : array {

		if ( 'sensei-lms/button-take-course' === $name ) {
			$this->render_take_course = $args['render_callback'];

			$args['render_callback'] = [ $this, 'maybe_override_take_course_block' ];
		}

		return $args;
	}

	/**
	 * Render the purchase course block instead of Take course if the course is purchasable.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block HTML.
	 *
	 * @return string Block output.
	 */
	public function maybe_override_take_course_block( $attributes, $content ) {

		global $post;
		$this->course_id = $post->ID;
		$this->products  = $this->get_purchasable_products();
		$this->button    = $content;

		$user_has_membership = class_exists( 'Sensei_WC_Paid_Courses\Course_Enrolment_Providers\WooCommerce_Memberships' )
			&& \Sensei_WC_Paid_Courses\Course_Enrolment_Providers\WooCommerce_Memberships::does_user_have_membership( get_current_user_id(), $this->course_id );

		if ( ! Sensei_WC::is_course_purchasable( $this->course_id, true ) || $user_has_membership ) {
			return call_user_func( $this->render_take_course, $attributes, $content );
		} else {
			return $this->render_purchase_course_block();
		}
	}

	/**
	 * Render the purchase course block.
	 *
	 * @return string Purchase course block output.
	 */
	private function render_purchase_course_block() {
		if ( Course_Enrolment_Providers::is_user_enrolled( $this->course_id, get_current_user_id() ) ) {
			return '';
		}

		if ( ! \Sensei_Course::is_prerequisite_complete( $this->course_id ) ) {
			return $this->get_prerequisite_notice();
		}

		if ( Sensei_WC::is_course_in_cart( $this->course_id ) ) {
			return $this->course_in_cart();
		}

		if ( empty( $this->products[0] ) ) {
			return $this->get_unavailable_product_notice();
		}

		return $this->render_form();
	}

	/**
	 * Get purchasable products for the course.
	 *
	 * @return array
	 */
	private function get_purchasable_products() {
		$purchasable_products = [];

		$product_ids = Sensei_WC::get_course_product_ids( $this->course_id );

		if ( ! $product_ids ) {
			return $purchasable_products;
		}

		foreach ( $product_ids as $product_id ) {
			$product = Sensei_WC::get_product_object( $product_id );

			if ( ! ( $product instanceof \WC_Product ) ) {
				continue;
			}

			if ( $product->is_purchasable() && $product->is_in_stock() ) {
				$purchasable_products[] = $product;
			}
		}

		return $purchasable_products;
	}

	/**
	 * Render purchase form.
	 *
	 * @return string Purchase form HTML.
	 */
	private function render_form() {
		if ( 1 < count( $this->products ) ) {
			return $this->render_multiple_products_form();
		}

		return $this->render_single_product_form();
	}

	/**
	 * Render single product form.
	 *
	 * @return string Single product form HTML.
	 */
	private function render_single_product_form() {
		$product     = $this->products[0];
		$price       = $product->get_price_html();
		$button_text = $price . ' - ' . esc_html__( 'Purchase Course', 'sensei-wc-paid-courses' );
		$button_text = apply_filters( 'sensei_wc_paid_courses_add_to_cart_button_text', $button_text );
		$button      = $this->render_button( $button_text );

		return '
			<form action="' . esc_url( $product->add_to_cart_url() ) . '" method="post" enctype="multipart/form-data">
				<input type="hidden" name="product_id" value="' . esc_attr( Sensei_WC_Utils::get_product_id( $product ) ) . '" />
				<input type="hidden" name="quantity" value="1" />
				' . $this->product_variation_fields( $product, true ) . '
				' . $button . '
			</form>';
	}

	/**
	 * Render multiple products form.
	 *
	 * @return string Multiple products form HTML.
	 */
	private function render_multiple_products_form() {
		$button = $this->render_button( esc_html__( 'Purchase Course', 'sensei-wc-paid-courses' ) );

		return '
			<form method="post" enctype="multipart/form-data" class="multiple-products-form">
				<input type="hidden" name="quantity" value="1" />
				' . $this->render_products() . '
				' . $button . '
			</form>';
	}

	/**
	 * Render course products.
	 *
	 * @return string Products HTML.
	 */
	private function render_products() {
		return '
			<div class="wp-block-sensei-lms-purchase-course__products">
				<ul class="wp-block-sensei-lms-purchase-course__products__list">' .
					implode(
						'',
						array_map( [ $this, 'render_product_item' ], $this->products, array_keys( $this->products ) )
					) . '
				</ul>
			</div>
		';
	}

	/**
	 * Render product item.
	 *
	 * @param WC_Product $product Product object.
	 * @param int        $key     Array key.
	 *
	 * @return string Product item HTML.
	 */
	private function render_product_item( $product, $key ) {
		$value               = esc_attr( Sensei_WC_Utils::get_product_id( $product ) );
		$name                = wp_kses_post( $product->get_name() );
		$description         = $product->is_type( 'variation' ) ? wp_kses_post( $product->get_description() ) : wp_kses_post( $product->get_short_description() );
		$price               = wp_kses_post( $product->get_price_html() );
		$product_data_attrs  = $this->product_variation_fields( $product );
		$product_data_attrs .= ' data-action=' . esc_url( $product->add_to_cart_url() );
		$checked             = 0 === $key ? ' checked="checked" ' : '';

		$id = $product->is_type( 'variation' )
			? $value . '-' . esc_attr( Sensei_WC_Utils::get_product_variation_id( $product ) )
			: $value;

		return '
			<li class="wp-block-sensei-lms-purchase-course__products__item">
				<label>
					<input
						class="wp-block-sensei-lms-purchase-course__products__radio"
						name="product_id"
						type="radio"
						value="' . $value . '"
						' . $product_data_attrs . '
						' . $checked . '
					/>
					<span class="wp-block-sensei-lms-purchase-course__products__label">
							<strong class="wp-block-sensei-lms-purchase-course__products__product-title">
								' . $name . '
							</strong>
							<span class="wp-block-sensei-lms-purchase-course__products__product-description">
								' . $description . '
							</span>
							<span class="wp-block-sensei-lms-purchase-course__products__price">
								' . $price . '
							</span>
						</span>
				</label>
			</li>
		';
	}

	/**
	 * Render button with given text content.
	 *
	 * @param string $text Button label.
	 *
	 * @return string Button HTML.
	 */
	private function render_button( $text ) {
		$button = preg_replace(
			'|<button(.*)>.*</button>|i',
			'<button $1>' . wp_kses_post( $text ) . '</button>',
			$this->button
		);

		$button = $this->add_login_notice( $button );

		return $button;
	}

	/**
	 * Render cart notice and complete purchase prompt.
	 *
	 * @return string
	 */
	private function course_in_cart() {
		$checkout_url = wc_get_checkout_url();

		$cart_link = '<a class="cart-complete" href="' . esc_url( wc_get_cart_url() ) . '">'
			. esc_html__( 'added to cart', 'sensei-wc-paid-courses' )
			. '</a>';

		$complete_purchase_notice = '
			<div class="sensei-message clean">'
				// translators: Placeholder is a link to the cart.
				. wp_kses_post( sprintf( __( 'Course %1s. Please complete the purchase to access the course.', 'sensei-wc-paid-courses' ), $cart_link ) ) . '
			</div>';

		// phpcs:ignore WordPress.Security.NonceVerification
		$product_id            = isset( $_GET['add-to-cart'] ) ? absint( $_GET['add-to-cart'] ) : null;
		$taking_courses_notice = $this->taking_courses_with_product_notice( $product_id );

		return $complete_purchase_notice
			. $taking_courses_notice
			. '<form action="' . esc_url( $checkout_url ) . '">'
			. $this->render_button( 'Complete purchase' )
			. '</form>';
	}

	/**
	 * Notice informing if learner is already taking courses with the product.
	 *
	 * @param int $product_id Product ID.
	 *
	 * @return string Notice informing if learner is already taking courses.
	 */
	private function taking_courses_with_product_notice( $product_id ) {
		if ( null === $product_id ) {
			return '';
		}

		// Case 2 (already taking all courses) won't happen because we don't render the purchase block if the user is enrolled in the course.
		switch ( \Sensei_WC::get_enrollment_status_for_product_courses( $product_id ) ) {
			case 0:
				return '';
			case 1:
				return '
					<div class="sensei-message alert">
						' . __( 'The product you are buying contains a course you are already taking.', 'sensei-wc-paid-courses' ) . '
					</div>
				';
		}

		return '';
	}

	/**
	 * Render additional product variation input fields.
	 *
	 * @param \WC_Product $product        Products object.
	 * @param bool        $single_product Whether the data will be used for single or multiple products.
	 *
	 * @return string Inputs or data attributes.
	 */
	private function product_variation_fields( \WC_Product $product, $single_product = false ) {
		$data_template = $single_product ? ' <input type="hidden" name="%1$s" value="%2$s" /> ' : ' data-%1$s=%2$s ';
		$variation     = '';

		if ( $product->is_type( 'variation' ) ) {
			$variation_data = Sensei_WC_Utils::get_variation_data( $product );

			$variation .= sprintf( $data_template, 'variation_id', esc_attr( Sensei_WC_Utils::get_product_variation_id( $product ) ) );
			if ( is_array( $variation_data ) && count( $variation_data ) > 0 ) {

				foreach ( $variation_data as $att => $val ) {
					$variation .= sprintf( $data_template, esc_attr( $att ), esc_attr( $val ) );
				}
			}
		}

		return $variation;
	}

	/**
	 * Append a log in notice to the button.
	 *
	 * @param string $content Button HTML.
	 *
	 * @return string|string[]|null
	 */
	private function add_login_notice( $content ) {

		if ( ! is_user_logged_in() ) {
			$notice_content = sprintf(
			// translators: Placeholder is a link to log in.
				__( 'Or %1$s to access your purchased courses.', 'sensei-wc-paid-courses' ),
				'<a href="' . sensei_user_login_url() . '">' . __( 'log in', 'sensei-wc-paid-courses' ) . '</a>'
			);
			$notice = '<div class="wp-block-sensei-button__notice">' . $notice_content . '</div>';

			$content = preg_replace( '/(<\/button>)/', '$1 ' . $notice, $content );

		}

		return $content;
	}

	/**
	 * Render notice for course prerequisite.
	 *
	 * @return string
	 */
	private function get_prerequisite_notice() {
		$notice = Sensei()->blocks->course->take_course->get_course_prerequisite_message( $this->course_id );
		return '<div class="sensei-message clean">' . $notice . '</div>';
	}

	/**
	 * Get unavailable product notice.
	 *
	 * @return string
	 */
	private function get_unavailable_product_notice() {
		$notice = '<div class="sensei-message clean">' . esc_html__( 'There are no products available to purchase.', 'sensei-wc-paid-courses' ) . '</div>';
		return $notice;
	}
}