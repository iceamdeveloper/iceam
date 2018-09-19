<?php
namespace Aelia\WC\CurrencySwitcher\DynamicPricing;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

require_once('lib/classes/definitions/definitions.php');

use Aelia\WC\Aelia_Plugin;
use Aelia\WC\Aelia_SessionManager;
use Aelia\WC\Messages;

/**
 * Aelia Currency Switcher Dynamic Pricing Integration plugin.
 **/
class WC_Aelia_CS_Dynamic_Pricing_Plugin extends Aelia_Plugin {
	public static $version = '1.0.3.180713';

	public static $plugin_slug = Definitions::PLUGIN_SLUG;
	public static $text_domain = Definitions::TEXT_DOMAIN;
	public static $plugin_name = 'WooCommerce Aelia Currency Switcher - Dynamic Pricing Integration';

	public static function factory() {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		$settings_key = self::$plugin_slug;

		$messages_controller = new Messages(self::$text_domain);

		$plugin_instance = new self(null, $messages_controller);
		return $plugin_instance;
	}

	/**
	 * Constructor.
	 *
	 * @param \Aelia\WC\Settings settings_controller The controller that will handle
	 * the plugin settings.
	 * @param \Aelia\WC\Messages messages_controller The controller that will handle
	 * the messages produced by the plugin.
	 */
	public function __construct($settings_controller = null, $messages_controller = null) {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		parent::__construct($settings_controller, $messages_controller);

		$this->initialize_integration();
	}

	protected function initialize_integration() {
		$this->dynamic_pricing_integration = new Dynamic_Pricing_Integration();
	}
}


$GLOBALS[WC_Aelia_CS_Dynamic_Pricing_Plugin::$plugin_slug] = WC_Aelia_CS_Dynamic_Pricing_Plugin::factory();
