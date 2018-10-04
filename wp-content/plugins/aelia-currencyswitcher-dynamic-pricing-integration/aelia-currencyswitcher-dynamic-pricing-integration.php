<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Dynamic Pricing Integration
Plugin URI: https://aelia.co/
Description: Dynamic Pricing integration for Aelia Currency Switcher for WooCommerce
Author: Aelia <support@aelia.co>
Author URI: https://aelia.co
Version: 1.0.3.180713
Text Domain: wc-aelia-cs-dynamic-pricing-integration
Domain Path: /languages
WC requires at least: 2.4.0
WC tested up to: 3.4.3
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-cs-dynamic-pricing-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Dynamic_Pricing_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Check for plugin updates (only when in Admin pages)
	function wc_aelia_cs_dynamic_pricing_check_for_updates() {
		$GLOBALS['wc-aelia-cs-dynamic-pricing-integration']->check_for_updates(__FILE__, 'aelia-currencyswitcher-dynamic-pricing-integration');
	}
	add_action('admin_init', 'wc_aelia_cs_dynamic_pricing_check_for_updates');
}
