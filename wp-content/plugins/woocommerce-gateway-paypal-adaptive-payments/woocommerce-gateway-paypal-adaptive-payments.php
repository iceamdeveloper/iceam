<?php
/**
 * Plugin Name: WooCommerce PayPal Adaptive Payments
 * Plugin URI: http://www.woothemes.com/products/paypal-adaptive-payments/
 * Description: PayPal Adaptive Payments integration for WooCommerce
 * Version: 1.1.5
 * Author: WooThemes
 * Author URI: http://woothemes.com
 * Text Domain: woocommerce-gateway-paypal-adaptive-payments
 * Domain Path: /languages
 *
 * @package  WC_PayPal_Adaptive_Payments
 * @category Core
 * @author   WooThemes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '307e9af43581a11b4b6cb05525e2dd65', '442373' );

if ( ! class_exists( 'WC_PayPal_Adaptive_Payments' ) ) :

/**
 * WooCommerce PayPal Adaptive Payments main class.
 */
class WC_PayPal_Adaptive_Payments {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.1.5';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin public actions.
	 */
	private function __construct() {
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Checks with WooCommerce is installed.
		if ( class_exists( 'WC_Payment_Gateway' ) ) {
			$this->includes();

			if ( is_admin() ) {
				$this->admin_includes();
			}

			add_filter( 'woocommerce_payment_gateways', array( $this, 'add_gateway' ) );
		} else {
			add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'woocommerce-gateway-paypal-adaptive-payments' );

		load_textdomain( 'woocommerce-gateway-paypal-adaptive-payments', trailingslashit( WP_LANG_DIR ) . 'woocommerce-gateway-paypal-adaptive-payments/woocommerce-gateway-paypal-adaptive-payments-' . $locale . '.mo' );
		load_plugin_textdomain( 'woocommerce-gateway-paypal-adaptive-payments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once 'includes/class-wc-paypal-adaptive-payments-gateway.php';
	}

	/**
	 * Admin includes.
	 */
	private function admin_includes() {
		include_once 'includes/class-wc-paypal-adaptive-payments-admin.php';
	}

	/**
	 * Add the gateway.
	 *
	 * @param  array $methods WooCommerce payment methods.
	 *
	 * @return array          PayPal Adaptive Payments gateway.
	 */
	public function add_gateway( $methods ) {
		$methods[] = 'WC_PayPal_Adaptive_Payments_Gateway';

		return $methods;
	}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @return string
	 */
	public function woocommerce_missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'WooCommerce PayPal Adaptive Payments Gateway depends on the last version of %s to work!', 'woocommerce-gateway-paypal-adaptive-payments' ), '<a href="http://wordpress.org/extend/plugins/woocommerce/">' . __( 'WooCommerce', 'woocommerce-gateway-paypal-adaptive-payments' ) . '</a>' ) . '</p></div>';
	}
}

add_action( 'plugins_loaded', array( 'WC_PayPal_Adaptive_Payments', 'get_instance' ) );

endif;
