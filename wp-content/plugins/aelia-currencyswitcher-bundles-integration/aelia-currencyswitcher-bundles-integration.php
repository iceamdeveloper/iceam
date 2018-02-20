<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Bundles Integration
Plugin URI: https://aelia.co/
Description: Bundles integration for Aelia Currency Switcher for WooCommerce
Author: Aelia <support@aelia.co>
Author URI: https://aelia.co
Version: 1.2.3.171201
Text Domain: wc-aelia-cs-bundles-integration
Domain Path: /languages
WC requires at least: 2.4
WC tested up to: 3.2.5
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-cs-bundles-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Bundles_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Check for plugin updates (only when in Admin pages)
	function wc_aelia_cs_bundles_check_for_updates() {
		$GLOBALS['wc-aelia-cs-bundles-integration']->check_for_updates(__FILE__, 'aelia-currencyswitcher-bundles-integration');
	}
	add_action('admin_init', 'wc_aelia_cs_bundles_check_for_updates');
}
