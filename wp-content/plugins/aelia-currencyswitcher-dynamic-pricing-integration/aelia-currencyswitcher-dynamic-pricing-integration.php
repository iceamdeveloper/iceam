<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Dynamic Pricing Integration
Plugin URI: https://aelia.co/
Description: Dynamic Pricing integration for Aelia Currency Switcher for WooCommerce
Author: Aelia <support@aelia.co>
Author URI: https://aelia.co
Version: 1.0.12.201207
Text Domain: wc-aelia-cs-dynamic-pricing-integration
Domain Path: /languages
WC requires at least: 2.6
WC tested up to: 4.8
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-cs-dynamic-pricing-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Dynamic_Pricing_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Set the path and name of the main plugin file (i.e. this file), for update
	// checks. This is needed because this is the main plugin file, but the updates
	// will be checked from within plugin-main.php
	// @since 1.0.5.190426
	$GLOBALS['wc-aelia-cs-dynamic-pricing-integration']->set_main_plugin_file(__FILE__);
}
