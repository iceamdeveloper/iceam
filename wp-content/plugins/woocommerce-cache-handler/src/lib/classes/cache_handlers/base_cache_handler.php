<?php
namespace Aelia\WC\Cache_Handler;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Base class for cache handlers.
 *
 * @since 1.0.2.160601
 */
abstract class Base_Cache_Handler {
	/**
	 * Factory method.
	 */
	public static function factory() {
		return new static();
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->set_hooks();
	}

	/**
	 * Sets the hooks required by the class.
	 */
	protected function set_hooks() {
		// Hooks
		add_filter('wc_aelia_acb_ajax_callbacks', array($this, 'wc_aelia_acb_ajax_callbacks'), 10, 1);
		add_filter('wc_aelia_cb_frontend_script_params', array($this, 'wc_aelia_cb_frontend_script_params'), 10, 1);
		add_action('wp_enqueue_scripts', array($this, 'load_frontend_scripts'));
		add_filter('wc_aelia_afc_should_validate_ajax_nonce', array($this, 'wc_aelia_afc_should_validate_ajax_nonce'), 10, 1);
	}

	/**
	 * Returns the instance of the Cache Handler plugin.
	 *
	 * @return Aelia\WC\Cache_Handler\Cache_Handler
	 */
	protected function cb() {
		return Cache_Handler::instance();
	}

	/**
	 * Returns a URL relative to the plugin's location.
	 *
	 * @return string
	 * @see Aelia\WC\Aelia_Plugin::url()
	 */
	protected function url($url_key) {
		return $this->cb()->url($url_key);
	}

	/**
	 * Loads the settings that will be used by the frontend scripts.
	 *
	 * @param array frontend_script_params An array of parameters to be passed to
	 * the frontend JavaScript.
	 * @return array
	 */
	public function wc_aelia_cb_frontend_script_params($frontend_script_params) {
		return $frontend_script_params;
	}

	/**
	 * Adds the Ajax callbacks implemented by this class.
	 *
	 * @param array ajax_callbacks An array of ajax command => callback pairs.
	 * @return array The modified array of callbacks.
	 */
	public function wc_aelia_acb_ajax_callbacks($ajax_callbacks) {
		return $ajax_callbacks;
	}

	/**
	 * Registers and enqueues the frontend scripts used by this class.
	 */
	public function load_frontend_scripts() {
		// To be implemented by descendant classes
	}

	/**
	 * Returns the Ajax callbacks introduced by this class.
	 *
	 * @return array
	 * @since 1.0.4.161003
	 */
	protected function get_handler_callbacks() {
		return array();
	}

	/**
	 * Indicates if the Ajax nonce should be validated. When cached pages are served,
	 * they may contain an expired nonce, therefore we cannot reliably check it.
	 *
	 * @param bool
	 * @return bool
	 */
	public function wc_aelia_afc_should_validate_ajax_nonce($validate_flag) {
		$ajax_command = isset($_REQUEST[\Aelia\WC\Definitions::ARG_AJAX_COMMAND]) ? $_REQUEST[\Aelia\WC\Definitions::ARG_AJAX_COMMAND] : '';

		// Disable the check of the Ajax nonce for the calls related to the cache
		// handler
		if(in_array($ajax_command, array_keys($this->get_handler_callbacks()))) {
			$validate_flag = false;
		}
		return $validate_flag;
	}
}
