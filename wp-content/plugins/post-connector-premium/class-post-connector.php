<?php

if ( defined( 'POST_CONNECTOR_FILE' ) ) {
	$main_file = POST_CONNECTOR_FILE;
} else if ( defined( 'POST_CONNECTOR_INSTALLER_FILE' ) ) {
	$main_file = POST_CONNECTOR_INSTALLER_FILE;
}
require_once( dirname( $main_file ) . '/core/classes/class-post-connector-core.php' );

/**
 * Class Post_Connector
 */
class Post_Connector extends Post_Connector_Core {

	/**
	 * Post Connector constructor
	 */
	public function __construct() {

		// Load autoloader
		require_once( self::get_core_dir() . '/classes/class-autoloader.php' );

		// Setup premium autoloader
		$autoloader = new SP_Autoloader( self::get_premium_dir() );
		if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
			spl_autoload_register( array( $autoloader, 'load' ), true, true );
		} else {
			spl_autoload_register( array( $autoloader, 'load' ), true );
		}

		// Do the parent int
		parent::init();

		// Load deprecated file
		require_once( self::get_premium_dir() . 'deprecated.php' );

		// Setup premium manager hooks
		$premium_manager_hook = new SP_Manager_Hook( self::get_premium_dir() . 'classes/hooks/' );
		$premium_manager_hook->load_hooks();

		// Setup premium manager filters
		$manager_filter = new SP_Manager_Filter( self::get_premium_dir() . 'classes/filters/' );
		$manager_filter->load_filters();

		// Widgets
		$manager_widget = new SP_Manager_Widget( self::get_premium_dir() . 'classes/widgets/' );
		$manager_widget->load();

		// Setup the license hooks
		$license_manager = new Yoast_Plugin_License_Manager( new SP_Product_Post_Connector() );
		$license_manager->setup_hooks();

		// Plugin upgrader
		if ( is_admin() ) {
			$premium_upgrade_manager = new SP_Premium_Upgrade_Manager();
			$premium_upgrade_manager->check_update();
		}

	}

	/**
	 * Get filename of plugin
	 *
	 * @access public
	 * @static
	 * @return String
	 */
	public static function get_plugin_file() {
		return POST_CONNECTOR_FILE;
	}

	/**
	 * Get Premium directory
	 *
	 * @return string
	 */
	public static function get_premium_dir() {
		return dirname( Post_Connector::get_plugin_file() ) . '/premium/';
	}

	/**
	 * Method to get the API object
	 *
	 * Premium only
	 *
	 * @access public
	 * @return SP_Post_Connector_API
	 */
	public static function API() {
		return new SP_Post_Connector_API();
	}

}