<?php
namespace Aelia\WC\Cache_Handler;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

require_once('lib/classes/definitions/definitions.php');

use Aelia\WC\Aelia_Plugin;
use Aelia\WC\Aelia_SessionManager;
use Aelia\WC\Cache_Handler\Settings;
use Aelia\WC\Cache_Handler\Settings_Renderer;
use Aelia\WC\Cache_Handler\Messages;

/**
 * Main plugin class.
 **/
class Cache_Handler extends Aelia_Plugin {
	public static $version = '1.0.36.220607';

	public static $plugin_slug = Definitions::PLUGIN_SLUG;
	public static $text_domain = Definitions::TEXT_DOMAIN;
	public static $plugin_name = 'Implements a workaround to allow plugins to work with caching systems that do not support dynamic cache.';

	/**
	 * The action used to route ajax calls to this plugin.
	 *
	 * @var string
	 * @since 1.0.2.160601
	 */
	protected static $ajax_action = 'woocommerce_cache_handler_ajax';

	/**
	 * An array of handlers that will implement cache busting features.
	 *
	 * @var array
	 * @since 1.0.2.160601
	 */
	protected $cache_handlers = array();

	/**
	 * Factory method.
	 */
	public static function factory() {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		$settings_key = self::$plugin_slug;

		// Settings and messages classes are loaded from the same namespace as the
		// plugin
		$settings_controller = new Settings(Settings::SETTINGS_KEY,
																				self::$text_domain);
		$messages_controller = new Messages(self::$text_domain);

		$class = get_called_class();
		// Replace $settings_controller with NULL if the plugin doesn't have settings
		$plugin_instance = new $class($settings_controller, $messages_controller);
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
	public function __construct($settings_controller = null,
															$messages_controller = null) {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');
		parent::__construct($settings_controller, $messages_controller);

		$this->load_cache_handlers();
	}

	/**
	 * Sets the hooks required by the plugin.
	 */
	protected function set_hooks() {
		parent::set_hooks();

		// Add your own hooks here
	}

	/**
	 * Loads the appropriate cache handlers.
	 */
	protected function load_cache_handlers() {
		$handlers_map = array(
			Settings::OPTION_ENABLE_REDIRECT => __NAMESPACE__ . '\Cache_Handler_Cache_Handler',
			Settings::OPTION_ENABLE_AJAX => __NAMESPACE__ . '\Ajax_Loader_Cache_Handler',
		);

		$cache_handler = $this->settings_controller()->get_cache_handler();

		if(!empty($handlers_map[$cache_handler]) && class_exists($handlers_map[$cache_handler])) {
			$this->cache_handlers[] = new $handlers_map[$cache_handler];
		}
	}

	/**
	 * Determines if one of plugin's admin pages is being rendered. Implement it
	 * if plugin implements pages in the Admin section.
	 *
	 * @return bool
	 */
	protected function rendering_plugin_admin_page() {
		// Uncomment this section if you implemented an Admin page that matches the
		// menu slug specified in the Definitions class

		//$screen = get_current_screen();
		//$page_id = $screen->id;
		//

		return isset($_GET['page']) && ($_GET['page'] === 'wc-settings') &&
					 isset($_GET['tab']) && ($_GET['tab'] === 'cache_handler');
		//return ($page_id == 'woocommerce_page_' . Definitions::MENU_SLUG);
	}

	/**
	 * Registers the script and style files needed by the admin pages of the
	 * plugin. Extend in descendant plugins.
	 */
	protected function register_plugin_admin_scripts() {
		// Scripts

		// WordPress already includes jQuery UI script, but no CSS for it. Therefore,
		// we need to load it from an external source
		//wp_register_style('jquery-ui',
		//									'//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css',
		//									array(),
		//									null,
		//									'all');

		//wp_enqueue_style('jquery-ui');
		//
		//wp_enqueue_script('jquery-ui-tabs');
		//wp_enqueue_script('jquery-ui-sortable');

		parent::register_plugin_admin_scripts();
	}

	/**
	 * Registers the script and style files required in the backend (even outside
	 * of plugin's pages). Extend in descendant plugins.
	 */
	protected function register_common_admin_scripts() {
		parent::register_common_admin_scripts();

		// Admin styles - Enable if required
		//wp_register_style(static::$plugin_slug . '-admin',
		//									$this->url('plugin') . '/design/css/admin.css',
		//									array(),
		//									null,
		//									'all');
		//wp_enqueue_style(static::$plugin_slug . '-admin');
	}

	public function woocommerce_loaded() {
		//var_dump(self::settings()->current_settings());
	}

	/**
	 * Loads Styles and JavaScript for the frontend.
	 */
	public function load_frontend_scripts() {
		// Enqueue the required Frontend stylesheets
		//wp_enqueue_style(static::$plugin_slug . '-frontend');

		// JavaScript
		wp_enqueue_script(static::$plugin_slug . '-frontend');

		$this->localize_frontend_scripts();
	}

	/**
	 * Loads the settings that will be used by the frontend scripts.
	 */
	protected function localize_frontend_scripts() {
		// Prepare the parameters for frontend scripts
		$frontend_scripts_params = array(
			'ajax_action' => $this->ajax_action(),
			'ajax_url' => admin_url('admin-ajax.php', 'relative'),
			'home_url' => home_url(),
			'wp_nonce' => wp_create_nonce($this->ajax_nonce_id()),
		);

		$frontend_scripts_params = apply_filters('wc_aelia_cb_frontend_script_params', $frontend_scripts_params);

		wp_localize_script(static::$plugin_slug . '-frontend',
											 'woocommerce_cache_handler_params',
											 $frontend_scripts_params);
	}

	/**
	 * Returns the action used to route Ajax calls to this plugin.
	 *
	 * @return string
	 * @since 1.0.2.160601
	 */
	protected function ajax_action() {
		return self::$ajax_action;
	}

	/**
	 * Returns the action used to route Ajax calls to this plugin for anonymous
	 * users (i.e "nopriv" Ajax calls).
	 *
	 * @return string
	 * @since 1.0.2.160601
	 */
	protected function nopriv_ajax_action() {
		return self::$ajax_action;
	}

	/**
	 * Returns a list of valid Ajax commands and the callback associated to each.
	 *
	 * @return array A list of command => callback pairs.
	 * @since 1.0.4.160531
	 */
	protected function get_valid_ajax_commands() {
		return apply_filters('wc_aelia_acb_ajax_callbacks', array(
			// Add the Ajax commands provided by the plugin, in
			// command => callable format
		));
	}
}

$GLOBALS[Cache_Handler::$plugin_slug] = Cache_Handler::factory();
