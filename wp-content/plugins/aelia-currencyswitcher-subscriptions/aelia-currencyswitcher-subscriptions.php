<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Currency Switcher - Subscriptions Integration
Plugin URI: https://aelia.co/
Description: Subscriptions integration for Aelia Currency Switcher for WooCommerce
Author: Aelia
Author URI: https://aelia.co
Version: 1.4.7.190828
Text Domain: wc-aelia-cs-subscriptions
Domain Path: /languages
WC requires at least: 3.0
WC tested up to: 3.7.0
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-cs-subscriptions-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Subscriptions_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Set the path and name of the main plugin file (i.e. this file), for update
	// checks. This is needed because this is the main plugin file, but the updates
	// will be checked from within plugin-main.php
	// @since 1.4.3.190630
	$GLOBALS['wc-aelia-cs-subscriptions']->set_main_plugin_file(__FILE__);
}
