<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Hook_Meta_Box_AJAX_Sort extends SP_Hook {
	protected $tag = 'pc_meta_box_creation_after';

	public function run( $connection ) {

		// Add AJAX sorting in meta box manager
		if ( $connection->get_sortable() == '1' ) {
			add_action( 'wp_ajax_sp_item_sort', array( $this, 'metabox_manage_save_order' ) );
		}

	}

	/**
	 * Hook into admin AJAX to save our custum menu order
	 *
	 * @access public
	 * @return void
	 */
	public function metabox_manage_save_order() {
		global $wpdb;
		$items = explode( ',', $_POST['sp_items'] );

		// Check if there are items posted
		if ( count( $items ) == 0 ) {
			return;
		}

		// Check nonce
		check_ajax_referer('post-connector-ajax-nonce-omgrandomword','nonce');

		// Check if user is allowed to do this
		if ( ! current_user_can( SP_Cap_Manager::get_capability( $items[0] ) ) ) {
			return;
		}

		// Check if the items are set
		if ( ! isset( $_POST['sp_items'] ) ) {
			return;
		}

		// Change order
		$counter = 0;
		foreach ( $items as $item_id ) {
			$wpdb->update( $wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $item_id ) );
			$counter ++;
		}

		// Generate JSON response
		$response = json_encode( array( 'success' => true ) );
		header( 'Content-Type: application/json' );
		echo $response;

		// Bye
		exit();
	}
}