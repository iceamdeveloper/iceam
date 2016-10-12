<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Post_Connector_API {
	private $post_link_manager;

	public function __construct() {
		$this->post_link_manager = new SP_Post_Link_Manager();
	}

	/**
	 * This function is used to create a link between two posts based on the post type link ID, parent post ID and child post ID.
	 * Function will return the newly created link ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param int $pt_link_id
	 * @param int $parent_id
	 * @param int $child_id
	 *
	 * @return int ($link_id)
	 */
	public function add_link( $pt_link_id, $parent_id, $child_id ) {
		return $this->post_link_manager->add( $pt_link_id, $parent_id, $child_id );
	}

	/**
	 * This function is used to create a link between two posts based on the connection slug, parent post ID and child post ID.
	 * Function will return the newly created link ID.
	 *
	 * @since  1.2.2.0
	 * @access public
	 *
	 * @param int $pt_slug
	 * @param int $parent_id
	 * @param int $child_id
	 *
	 * @return int ($link_id)
	 */
	public function add_link_by_slug( $pt_slug, $parent_id, $child_id ) {

		// Get Post Type Link ID by slug
		$ptl_query = new WP_Query( array(
			'post_type'  => SP_Constants::CPT_PT_LINK,
			'meta_query' => array(
				array(
					'key'   => SP_Constants::PM_PTL_SLUG,
					'value' => $pt_slug
				)
			)
		) );

		// Return false when not Post Type Link found
		if ( ! $ptl_query->have_posts() ) {
			return false;
		}

		// Reset post data
		wp_reset_postdata();

		// Add the Post Type Link
		return $this->add_link( $ptl_query->post->ID, $parent_id, $child_id );
	}

	/**
	 * @deprecated 1.5.0
	 */
	public function add_post_type_link( $slug, $title, $parent, $child, $sortable, $add_new, $add_existing ) {
		_deprecated_function( __FUNCTION__, '1.5.0', 'add_connection' );

		return $this->add_connection( null, $slug, $title, $parent, $child, $sortable, $add_new, $add_existing, 0, 0 );
	}

	/**
	 * This function is used to create a connection between two post types.
	 *
	 * The following parameters should be passed when create a post type link:
	 *
	 * Slug (string) – The new slug of the PTL
	 * Title (string) – The new title of the PTL
	 * Parent (string) – The parent post type id
	 * Child (string) – The child post type id
	 * Sortable (int) – Whether the item is sortable. 1 = yes, 0 = no.
	 * Add new (int) – Whether the user can add and link new items. 1 = yes, 0 = no.
	 * Add existing (int) – Whether the user can link existing items. 1 = yes, 0 = no.
	 * After post display children - Display child posts automatically on post. 1 = yes, 0 = no.
	 * After post display parents - Display parent posts automatically on post. 1 = yes, 0 = no.
	 * Backwards Linking - Set to 1 if you want to allow backwards linking. 1 = enabled, 2 = disabled.
	 * Related - Whether this connection is a related conection or not. 1 = enabled, 2 = disabled.
	 *
	 * The function will return a SP_Connection object.
	 *
	 * @since  1.5.0
	 * @access public
	 *
	 * @param $slug
	 * @param $title
	 * @param $parent
	 * @param $child
	 * @param $sortable
	 * @param $add_new
	 * @param $add_existing
	 * @param $after_post_display_children
	 * @param $after_post_display_parents
	 * @param $backwards_linking
	 * @param $deprecated
	 *
	 * @return SP_Connection
	 */
	public function add_connection( $slug, $title, $parent, $child, $sortable, $add_new, $add_existing, $after_post_display_children = 0, $after_post_display_parents = 0, $backwards_linking = 0, $deprecated=false ) {

		// Create the Connection Manager
		$connection_manager = new SP_Connection_Manager();

		// Create the connection
		$connection = new SP_Connection();
		$connection->set_slug( $slug );
		$connection->set_title( $title );
		$connection->set_parent( $parent );
		$connection->set_child( $child );
		$connection->set_add_new( $add_new );
		$connection->set_add_existing( $add_existing );
		$connection->set_after_post_display_children( $after_post_display_children );
		$connection->set_sortable( $sortable );
		$connection->set_after_post_display_parents( $after_post_display_parents );
		$connection->set_backwards_linking( $backwards_linking );

		// Save the connection
		return $connection_manager->save( $connection );
	}

	/**
	 * This function is used to fetch children of a parent post.
	 * Function returns all linked children in an array, the array will contain default WordPress posts.
	 * Child posts will be fetched by post type slug and parent id, default WordPress arguments can be used in the $args variable.
	 *
	 * @since  1.5.0
	 * @access public
	 *
	 * @param string $pt_slug
	 * @param int    $parent_id
	 * @param array  $extra_args (default: null)
	 *
	 * @return array
	 */
	public function get_children( $pt_slug, $parent_id, $extra_args = null ) {
		return $this->post_link_manager->get_children( $pt_slug, $parent_id, $extra_args );
	}

	/**
	 * @deprecated 1.5.0
	 */
	public function get_childs( $pt_slug, $parent_id, $extra_args = null ) {
		_deprecated_function( __FUNCTION__, '1.5.0', 'get_children' );

		return $this->get_children( $pt_slug, $parent_id, $extra_args );
	}

	/**
	 * This function is used to fetch the first child of a parent post.
	 * The first child post will be fetched by post type slug and parent id.
	 * Function returns a default WordPress post.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $pt_slug
	 * @param int    $parent_id
	 *
	 * @return array
	 */
	public function get_first_child( $pt_slug, $parent_id ) {
		$child    = null;
		$children = $this->get_children( $pt_slug, $parent_id, array( 'posts_per_page' => 1 ) );

		if ( is_array( $children ) && count( $children ) > 0 ) {
			$child = array_shift( $children );
		}

		return $child;
	}

	/**
	 * This function is used to fetch the parents of a child post.
	 * Function returns all linked parents in an array, the array will contain default WordPress posts.
	 * Parents posts will be fetched by post type slug and child id.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $pt_slug
	 * @param int    $child_id
	 *
	 * @return array
	 */
	public function get_parents( $pt_slug, $child_id ) {
		return $this->post_link_manager->get_parents( $pt_slug, $child_id );
	}

	/**
	 * This function is used to delete a link between parent and child post by the link ID.
	 * Note that this will not delete the post type link.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param int $link_id
	 */
	public function delete_link( $link_id ) {
		$this->post_link_manager->delete( $link_id );
	}

	/**
	 * This function is used to delete a post type link by the post type link ID.
	 * Note that this will also delete all created links between posts using this post type link.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param $ptl_id
	 *
	 * @return bool
	 */
	public function delete_post_type_link( $ptl_id ) {
		$post_type_link_manager = new SP_Connection_Manager();

		return $post_type_link_manager->delete( $ptl_id );
	}

	/**
	 * This function is used to check if a parent post has at least one child.
	 *
	 * @since  1.3.0.0
	 * @access public
	 *
	 * @param string $pt_slug
	 * @param int    $parent_id
	 *
	 * @return bool
	 */
	public function has_child( $pt_slug, $parent_id ) {
		return ( count( $this->get_children( $pt_slug, $parent_id, array( 'posts_per_page' => 1 ) ) ) > 0 );
	}

}