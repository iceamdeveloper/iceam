<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Rest_Api\Controllers\Course_Products.
 *
 * @package sensei-wc-paid-courses
 * @since   1.1.0
 */

namespace Sensei_WC_Paid_Courses\Rest_Api\Controllers;

use \WP_REST_Posts_Controller;
use \WP_REST_Controller;
use \WP_REST_Server;
use \WP_Error;

use \Sensei_WC_Paid_Courses\Courses;

/**
 * REST API class for retrieving products that may be attached to courses.
 *
 * @since 1.1.0
 */
class Course_Products extends WP_REST_Controller {

	/**
	 * Endpoint namespace for internal routes.
	 *
	 * @var string
	 */
	protected $namespace = 'sensei-wcpc-internal/v1';

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'course-products';

	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $post_type = 'product';

	/**
	 * An instance of WP_REST_Posts_Controller.
	 *
	 * @var WP_REST_Posts_Controller
	 */
	protected $posts_controller;

	/**
	 * Constructor.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		$this->posts_controller = new WP_REST_Posts_Controller( $this->post_type );
	}

	/**
	 * Register the route for getting products that are available to courses.
	 * This route should only be used internally, and may change in the future.
	 *
	 * @since 1.1.0
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_items' ],
					'permission_callback' => [ $this, 'get_items_permissions_check' ],
					'args'                => $this->get_collection_params(),
				],
				'schema' => [ $this, 'get_public_item_schema' ],
			]
		);
	}

	/**
	 * Check if the current user has permission to view the course products
	 * list.
	 *
	 * @since 1.1.0
	 *
	 * @param WP_REST_Request $request The current request.
	 * @return bool|WP_Error
	 */
	public function get_items_permissions_check( $request ) {
		if ( ! current_user_can( 'edit_courses' ) ) {
			return new WP_Error(
				'sensei_wc_paid_courses_rest_cannot_view',
				__( 'Sorry, you cannot list this resource.', 'sensei-wc-paid-courses' ),
				[ 'status' => rest_authorization_required_code() ]
			);
		}

		return true;
	}

	/**
	 * Get the products which may be added to a course and return the REST
	 * response.
	 *
	 * @since 1.1.0
	 *
	 * @param WP_REST_Request $request The current request.
	 */
	public function get_items( $request ) {
		$registered         = $this->get_collection_params();
		$args               = [];
		$parameter_mappings = [
			'page'     => 'paged',
			'per_page' => 'posts_per_page',
			'search'   => 's',
			'status'   => 'post_status',
			'include'  => 'post__in',
		];

		/*
		 * For each known parameter which is both registered and present in the request,
		 * set the parameter's value on the query $args.
		 */
		foreach ( $parameter_mappings as $api_param => $wp_param ) {
			if ( isset( $registered[ $api_param ], $request[ $api_param ] ) ) {
				$args[ $wp_param ] = $request[ $api_param ];
			}
		}

		// Load the data.
		$products          = Courses::instance()->get_assignable_products( $request['course_id'], $args );
		$products_response = [];

		// Prepare for response.
		foreach ( $products as $product ) {
			$product_response    = $this->prepare_item_for_response( $product, $request );
			$products_response[] = $this->prepare_response_for_collection( $product_response );
		}

		$response = [
			'user_confirmed_modal' => Courses::instance()->has_user_confirmed_modal(),
			'products'             => $products_response,
		];

		return rest_ensure_response( $response );
	}

	/**
	 * Prepare a product for the REST response.
	 *
	 * @since 1.1.0
	 *
	 * @param mixed           $product The product.
	 * @param WP_REST_Request $request The request.
	 * @return WP_REST_Response
	 */
	public function prepare_item_for_response( $product, $request ) {
		$data   = [];
		$fields = $this->get_fields_for_response( $request );

		if ( in_array( 'id', $fields, true ) ) {
			$data['id'] = $product->ID;
		}

		if ( in_array( 'name', $fields, true ) ) {
			$data['name'] = $this->get_product_name( $product );
		}

		if ( in_array( 'total_sales', $fields, true ) ) {
			$data['total_sales'] = get_post_meta( $product->ID, 'total_sales', true );
		}

		return rest_ensure_response( $data );
	}

	/**
	 * Retrieves the query params for the collection.
	 *
	 * @since 1.1.0
	 *
	 * @return array
	 */
	public function get_collection_params() {
		$query_params = parent::get_collection_params();

		// Add "status" from Posts Controller.
		$posts_controller_params           = $this->posts_controller->get_collection_params();
		$query_params['status']            = $posts_controller_params['status'];
		$query_params['status']['default'] = 'any';

		// Add "include" from Posts Controller.
		$query_params['include'] = $posts_controller_params['include'];

		// Add course ID to get only products that are assignable to that course.
		$query_params['course_id'] = [
			'description'       => __( 'ID of course for which to get assignable products', 'sensei-wc-paid-courses' ),
			'type'              => 'integer',
			'default'           => null,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'rest_validate_request_arg',
			'minimum'           => 1,
		];

		return $query_params;
	}

	/**
	 * Get our product schema.
	 *
	 * @since 1.1.0
	 *
	 * @return array
	 */
	public function get_item_schema() {
		$schema = [
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'product',
			'type'       => 'object',
			'properties' => [
				'id'          => [
					'description' => esc_html__( 'The product ID.', 'sensei-wc-paid-courses' ),
					'type'        => 'integer',
					'readonly'    => true,
				],
				'name'        => [
					'description' => esc_html__( 'The product name.', 'sensei-wc-paid-courses' ),
					'type'        => 'string',
					'readonly'    => true,
				],
				'total_sales' => [
					'description' => esc_html__( 'The product\'s total sales.', 'sensei-wc-paid-courses' ),
					'type'        => 'integer',
					'readonly'    => true,
				],
			],
		];

		return $schema;
	}

	/**
	 * Get the display name for the product. Generally, this will be the post
	 * title, but for variations it will also show the variable attributes.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @param mixed $product The product. This can be a WP_Post, WC_Product, or ID.
	 * @return string
	 */
	private function get_product_name( $product ) {
		$product = wc_get_product( $product );

		if ( ! ( $product instanceof \WC_Product ) ) {
			return '';
		}

		if ( in_array( $product->get_type(), [ 'variation', 'subscription_variation' ], true ) ) {
			$parent_name = $product->get_parent_data()['title'];
			$attributes  = $product->get_attribute_summary();
			return "$parent_name - $attributes";
		}

		return $product->get_title();
	}
}

/**
 * Register the routes for the Course_Products controller.
 */
function sensei_wc_paid_courses_register_course_products_routes() {
	$controller = new Course_Products();
	$controller->register_routes();
}
add_action( 'rest_api_init', 'Sensei_WC_Paid_Courses\Rest_Api\Controllers\sensei_wc_paid_courses_register_course_products_routes' );
