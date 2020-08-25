<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Bundles Integration
Plugin URI: https://aelia.co/
Description: Bundles integration for Aelia Currency Switcher for WooCommerce
Author: Aelia <support@aelia.co>
Author URI: https://aelia.co
Version: 1.2.7.200813
Text Domain: wc-aelia-cs-bundles-integration
Domain Path: /languages
WC requires at least: 3.0
WC tested up to: 4.4
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-cs-bundles-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Bundles_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Set the path and name of the main plugin file (i.e. this file), for update
	// checks. This is needed because this is the main plugin file, but the updates
	// will be checked from within plugin-main.php
	// @since 1.2.4.190703
	$GLOBALS['wc-aelia-cs-bundles-integration']->set_main_plugin_file(__FILE__);
}
