<?php
namespace Aelia\WC\Cache_Handler;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Contains a list of definitions and constants used throughout the plugin.
 */
class Definitions {
	// @var string The menu slug for plugin's settings page.
	const MENU_SLUG = 'wc_cache_handler';
	// @var string The plugin slug
	const PLUGIN_SLUG = 'woocommerce-cache-handler';
	// @var string The plugin text domain
	const TEXT_DOMAIN = 'wc-cache-handler';

	// URL Arguments
	const ARG_PAGE_HASH = 'ph';

	// Results
	const RES_OK = 0;
}
