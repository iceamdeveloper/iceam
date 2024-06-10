<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Premium_Post_Link_Manager extends SP_Post_Link_Manager {

	/**
	 * Generate the parents list
	 *
	 * @param string $slug
	 * @param string $child
	 * @param string $link
	 * @param string $excerpt
	 * @param string $header_tag
	 * @param boolean $display_image
	 *
	 * @return string
	 */
	public function generate_parents_list( $slug, $child, $link, $excerpt, $header_tag = 'b', $display_image = false ) {

		// Make the header tag filterable
		$header_tag = apply_filters( 'pc_parents_list_header_tag', $header_tag );

		// Get the children
		$parents = $this->get_parents( $slug, $child );

		// Returned string
		$return = $this->generate_list( $parents, $slug, $link, $excerpt, $display_image, $header_tag );

		// Restore global $post of main query
		wp_reset_postdata();

		return $return;
	}

}