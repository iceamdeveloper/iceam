<?php
namespace Aelia\WC\CurrencySwitcher\Bundles;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

require_once('lib/classes/definitions/definitions.php');

use Aelia\WC\Aelia_Plugin;
use Aelia\WC\Aelia_SessionManager;
use Aelia\WC\Messages;

/**
 * Aelia Currency Switcher Bundles Integration plugin.
 **/
class WC_Aelia_CS_Bundles_Plugin extends Aelia_Plugin {
	public static $version = '1.2.13.210128';

	public static $plugin_slug = Definitions::PLUGIN_SLUG;
	public static $text_domain = Definitions::TEXT_DOMAIN;
	public static $plugin_name = 'WooCommerce Aelia Currency Switcher - Bundles Integration';

	/**
	 * The slug used to check for updates.
	 *
	 * @var string
	 * @since 1.2.4.190703
	 */
	public static $slug_for_update_check = Definitions::PLUGIN_SLUG_FOR_UPDATES;

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
		$this->bundles_integration = new Bundles_Integration();
	}

	/**
	 * Determines if one of plugin's admin pages is being rendered. Override it
	 * if plugin implements pages in the Admin section.
	 *
	 * @return bool
	 */
	protected function rendering_plugin_admin_page() {
		global $post, $woocommerce;

		return isset($post) && ($post->post_type == 'product');
	}

	/**
	 * Registers the plugin for automatic updates.
	 *
	 * @param array The array of the plugins to update, structured as follows:
	 * array(
	 *   'free' => <Array of free plugins>,
	 *   'premium' => <Array of premium plugins, which require licence activation>,
	 * )
	 * @return array The array of plugins to update, with the details of this
	 * plugin added to it.
	 * @since 1.2.4.190703
	 */
	public function wc_aelia_afc_register_plugins_to_update(array $plugins_to_update) {
		$plugins_to_update['free'][self::$plugin_slug] = $this;
		return $plugins_to_update;
	}
}

$GLOBALS[WC_Aelia_CS_Bundles_Plugin::$plugin_slug] = WC_Aelia_CS_Bundles_Plugin::factory();
