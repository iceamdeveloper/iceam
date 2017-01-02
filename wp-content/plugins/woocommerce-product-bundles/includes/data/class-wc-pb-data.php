<?php
/**
 * WC_PB_Data class
 *
 * @author   SomewhereWarm <sw@somewherewarm.net>
 * @package  WooCommerce Product Bundles
 * @since    5.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product Bundles Data class.
 *
 * Product Bundles Data filters and includes.
 *
 * @class  WC_PB_Data
 * @since  5.1.0
 */
class WC_PB_Data {

	public static function init() {

		// DB API for custom PB tables.
		require_once( 'class-wc-pb-db.php' );

		// Bundled Item Data CRUD class.
		require_once( 'class-wc-bundled-item-data.php' );
	}
}

WC_PB_Data::init();
