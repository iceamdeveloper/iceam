<?php
namespace Aelia\WC\Cache_Handler;
if(!defined('ABSPATH')) exit; // Exit ifaccessed directly

/**
 * Handles the settings for the Shipping Pricing plugin and provides convenience
 * methods to read and write them.
 */
class Settings extends \Aelia\WC\Settings {
	protected $id = 'cache_handler';

	/*** Settings Key ***/
	// @var string The key to identify plugin settings amongst WP options.
	const SETTINGS_KEY = 'wc-cache-handler';

	/*** Settings fields ***/
	const FIELD_CACHE_HANDLER = 'cache_handler';

	const OPTION_DISABLE = 'disable';
	const OPTION_ENABLE_REDIRECT = 'enable_redirect';
	const OPTION_ENABLE_AJAX = 'enable_ajax';

	/**
	 * Returns the default settings for the plugin. Used mainly at first
	 * installation.
	 *
	 * @param string key If specified, method will return only the setting identified
	 * by the key.
	 * @param mixed default The default value to return if the setting requested
	 * via the "key" argument is not found.
	 * @return array|mixed The default settings, or the value of the specified
	 * setting.
	 *
	 * @see WC_Aelia_Settings:default_settings().
	 */
	public function default_settings($key = null, $default = null) {
		$default_options = array(
			self::FIELD_CACHE_HANDLER => self::OPTION_DISABLE,
		);

		if(empty($key)) {
			return $default_options;
		}
		else {
			return get_value($key, $default_options, $default);
		}
	}

	/**
	 * Validates the settings specified via the Options page.
	 *
	 * @param array settings An array of settings.
	 */
	public function validate_settings($settings) {
		// Debug
		//var_dump($settings);die();
		$this->validation_errors = array();
		$processed_settings = $this->current_settings();

		// Validate the settings posted via the $settings variable

		// Save settings if they passed validation
		if(empty($this->validation_errors)) {
			$processed_settings = array_merge($processed_settings, $settings);
		}
		else {
			$this->show_validation_errors();
		}

		// Return the array processing any additional functions filtered by this action.
		return apply_filters('wc_acb_settings', $processed_settings, $settings);
	}

	/**
	 * Class constructor.
	 */
	public function __construct($settings_key = self::SETTINGS_KEY,
															$textdomain = '',
															\Aelia\WC\Settings_Renderer $renderer = null) {
		$this->settings_key = $settings_key;
		$this->textdomain = $textdomain;

		$this->load();
		$this->set_hooks();
	}

	protected function set_hooks() {
		add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_page'), 9999);
		add_action('woocommerce_settings_' . $this->id, array($this, 'render_options_page'), 10);
		add_action('woocommerce_update_options_'. $this->id, array($this, 'update_settings'));
	}

	/**
	 * Factory method.
	 *
	 * @param string settings_key The key used to store and retrieve the plugin settings.
	 * @param string textdomain The text domain used for localisation.
	 * @param string renderer The renderer to use to generate the settings page.
	 * @return WC_Aelia_Settings.
	 */
	public static function factory($settings_key = self::SETTINGS_KEY,
																 $textdomain = '') {
		$class = get_called_class();
		$settings_manager = new $class($settings_key, $textdomain, $renderer);
		return $settings_manager;
	}

	/**
	 * Returns the array of the settings used by the plugin.
	 */
	public function get_settings() {
		$settings = array(
			'section_title' => array(
				'name' => __('General', 'wc-aelia-eu-vat-assistant'),
				'type' => 'title',
				'desc' => '',
			),
			self::FIELD_CACHE_HANDLER => array(
				'id' => $this->id . '_' . self::FIELD_CACHE_HANDLER,
				'name' => __('Enabled', 'wc-aelia-eu-vat-assistant'),
				'type' => 'select',
				'desc' => __('Choose how the Cache Handler should work.', 'wc-aelia-eu-vat-assistant') .
									'<ul class="description">' .
									'<li><strong>' . __('Disabled', 'wc-aelia-eu-vat-assistant') . '</strong> - ' .
									__('The Cache Handler will be disabled.', 'wc-aelia-eu-vat-assistant') .
									'</li>' .
									'<li><strong>' . __('Enable Redirect', 'wc-aelia-eu-vat-assistant') . '</strong> - ' .
									__('The Cache Handler will use the same redirect mechanism adopted ' .
										 'by WooCommerce to redirect users to the correct content.', 'wc-aelia-eu-vat-assistant') .
									'</li>' .
									'<li><strong>' . __('Enable Ajax Loader', 'wc-aelia-eu-vat-assistant') . '</strong> - ' .
									__('The Cache Handler will use Ajax to load prices dynamically on each page.', 'wc-aelia-eu-vat-assistant') .
									'</li>' .
									'</ul>' .
									'<p><strong>' . __('Important', 'wc-aelia-eu-vat-assistant') . ':</strong> ' .
									__('Please make sure to clear all the cache systems after changing this ' .
										 'setting. This is necessary for the new caching handling logic to be ' .
										 'applied.', 'wc-aelia-eu-vat-assistant') .
									'</p>',
				'options' => array(
					self::OPTION_DISABLE=> __('Disabled', 'wc-aelia-eu-vat-assistant'),
					self::OPTION_ENABLE_REDIRECT => __('Enable Redirect (WooCommerce style)', 'wc-aelia-eu-vat-assistant'),
					self::OPTION_ENABLE_AJAX => __('Enable Ajax loader', 'wc-aelia-eu-vat-assistant'),
				),
				'class' => 'wc-enhanced-select',
				'default'  => self::OPTION_DISABLE,
			),
			'section_end' => array(
				'type' => 'sectionend',
			)
		);
		return apply_filters('wc_aelia_cb_demo_settings', $settings);
	}

	public function add_settings_page($pages){
		$pages[$this->id] = __('Cache Handler', 'wc-aelia-eu-vat-assistant');
		return $pages;
	}

	public function render_options_page() {
		woocommerce_admin_fields($this->get_settings());
	}

	public function update_settings() {
		woocommerce_update_options($this->get_settings());
	}

	public function load() {
		if(empty($this->_current_settings)) {
			$this->_current_settings = array();

			foreach($this->get_settings() as $name => $params) {
				if(!isset($params['id'])) {
					continue;
				}
				$default = isset($params['default']) ? $params['default'] : null;

				$setting_key = str_replace($this->id . '_', '', $params['id']);
				$this->_current_settings[$setting_key] = get_option($params['id'], $default);
			}
		}
		return $this->_current_settings;
	}

	public function delete_settings() {
		foreach($this->get_settings() as $name => $params) {
			if(!isset($params['id'])) {
				continue;
			}
			delete_option($params['id']);
		}
	}

	public function get_cache_handler() {
		return $this->get(self::FIELD_CACHE_HANDLER, self::OPTION_DISABLE);
	}

	/*** Validation methods ***/
}
