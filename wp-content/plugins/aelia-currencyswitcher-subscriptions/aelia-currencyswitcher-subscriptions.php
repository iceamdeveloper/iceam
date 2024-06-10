<?php if(!defined('ABSPATH')) { exit; } // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Subscriptions Integration
Plugin URI: https://aelia.co/
Description: Subscriptions integration for Aelia Currency Switcher for WooCommerce
Author: Aelia
Author URI: https://aelia.co
Version: 2.1.3.230905
Text Domain: wc-aelia-cs-subscriptions
Domain Path: /languages
WC requires at least: 3.0
WC tested up to: 8.1
*/

require_once __DIR__ . '/src/lib/classes/install/aelia-wc-cs-subscriptions-requirementscheck.php';
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Subscriptions_RequirementsChecks::factory()->check_requirements()) {
	require_once __DIR__ . '/src/plugin-main.php';

	// Set the path and name of the main plugin file (i.e. this file), for update
	// checks. This is needed because this is the main plugin file, but the updates
	// will be checked from within plugin-main.php
	// @since 1.4.3.190630
	$GLOBALS['wc-aelia-cs-subscriptions']->set_main_plugin_file(__FILE__);
}

// Declare support for HPOS tables
// @since 2.1.0.230705
add_action('before_woocommerce_init', function() {
	if(function_exists('aelia_declare_feature_support')) {
		aelia_declare_feature_support(__FILE__, 'custom_order_tables', true);
	}
});
