<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Cache Handler
Description: Implements a workaround to allow plugins to work with caching systems that don't support dynamic cache.
Plugin URI: https://aelia.co
Version: 1.2.2.230905
Author: Aelia
Author URI: https://aelia.co
Text Domain: wc-cache-handler
License: GPL-3.0
WC requires at least: 3.0
WC tested up to: 8.1
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/plugin-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Cache_Handler_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Check for plugin updates (only when in Admin pages)
	function woocommerce_cache_handler_check_for_updates() {
		$GLOBALS['woocommerce-cache-handler']->check_for_updates(__FILE__);
	}
	add_action('admin_init', 'woocommerce_cache_handler_check_for_updates', 5);
}

// Declare support for HPOS tables
// @since 1.2.0.230705
add_action('before_woocommerce_init', function() {
	if(function_exists('aelia_declare_feature_support')) {
		aelia_declare_feature_support(__FILE__, 'custom_order_tables', true);
	}
});
