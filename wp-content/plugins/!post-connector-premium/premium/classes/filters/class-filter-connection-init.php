<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Filter_Connection_Init extends SP_Filter {
	protected $tag = 'pc_connection_init';

	/**
	 * Enrich the connection
	 *
	 * @param SP_Connection $connection
	 *
	 * @return SP_Connection $connection
	 */
	public function run( $connection ) {

		// Enricht the connection
		$connection->set_sortable( get_post_meta( $connection->get_id(), SP_Constants::PM_PTL_SORTABLE, true ) );
		$connection->set_after_post_display_parents( get_post_meta( $connection->get_id(), SP_Constants::PM_PTL_APDP, true ) );
		$connection->set_backwards_linking( get_post_meta( $connection->get_id(), SP_Constants::PM_PTL_BACKWARDS, true ) );
		$connection->set_after_post_display_children_excerpt( get_post_meta( $connection->get_id(), SP_Constants::PM_PTL_APDC_EXCERPT, true ) );
		$connection->set_after_post_display_children_image( get_post_meta( $connection->get_id(), SP_Constants::PM_PTL_APDC_IMAGE, true ) );

		return $connection;
	}
}