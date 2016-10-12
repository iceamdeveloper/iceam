<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Filter_Connection_Catch_Post extends SP_Filter {
	protected $tag = 'pc_connection_catch_post';

	/**
	 * Enrich the connection
	 *
	 * @param SP_Connection $connection
	 *
	 * @return SP_Connection $connection
	 */
	public function run( $connection ) {

		// Check sortable
		$sortable = 0;
		if ( isset( $_POST['sortable'] ) && $_POST['sortable'] == '1' ) {
			$sortable = 1;
		}
		$connection->set_sortable( $sortable );

		// Check the display parents
		$after_post_display_parents = 0;
		if ( isset( $_POST['after_post_display_parents'] ) && $_POST['after_post_display_parents'] == '1' ) {
			$after_post_display_parents = 1;
		}
		$connection->set_after_post_display_parents( $after_post_display_parents );

		// Check the backwards linking
		$backwards_linking = 0;
		if ( isset( $_POST['backwards_linking'] ) && $_POST['backwards_linking'] == '1' ) {
			$backwards_linking = 1;
		}
		$connection->set_backwards_linking( $backwards_linking );

		// Check APDC excerpt
		$apdc_excerpt = 0;
		if ( isset( $_POST['after_post_display_children_excerpt'] ) && $_POST['after_post_display_children_excerpt'] == '1' ) {
			$apdc_excerpt = 1;
		}
		$connection->set_after_post_display_children_excerpt( $apdc_excerpt );

		// Check APDC image
		$apdc_image = 0;
		if ( isset( $_POST['after_post_display_children_image'] ) && $_POST['after_post_display_children_image'] == '1' ) {
			$apdc_image = 1;
		}
		$connection->set_after_post_display_children_image( $apdc_image );

		return $connection;
	}
}