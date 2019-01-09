<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

require_once('aelia-wc-requirementscheck.php');

/**
 * Checks that plugin's requirements are met.
 */
class Aelia_WC_CS_Dynamic_Pricing_RequirementsChecks extends Aelia_WC_RequirementsChecks {
	// @var string The namespace for the messages displayed by the class.
	protected $text_domain = 'wc-aelia-cs-dynamic-pricing-integration';
	// @var string The plugin for which the requirements are being checked. Change it in descendant classes.
	protected $plugin_name = 'WooCommerce Currency Switcher - Dynamic Pricing Integration';

	// @var array An array of WordPress plugins (name => version) required by the plugin.
	protected $required_plugins = array(
		'WooCommerce' => '2.6',
		'Aelia Foundation Classes for WooCommerce' => array(
			'version' => '1.7.5.160722',
			'extra_info' => 'You can get the plugin <a href="http://bit.ly/WC_AFC_S3">from our site</a>, free of charge.',
			'autoload' => true,
			'url' => 'http://bit.ly/WC_AFC_S3',
		),
		'Aelia Currency Switcher for WooCommerce' => array(
			'version' => '4.4.6.170120',
			'extra_info' => 'You can buy the plugin <a href="https://aelia.co/shop/currency-switcher-woocommerce/">from our shop</a>.',
		),
		'WooCommerce Dynamic Pricing' => array(
			'version' => '3.1.7',
			'extra_info' => 'You can get the plugin <a href="https://woocommerce.com/products/dynamic-pricing/?aff=2914">from the WooCommerce Marketplace</a>.',
		),
	);

	/**
	 * Factory method. It MUST be copied to every descendant class, as it has to
	 * be compatible with PHP 5.2 and earlier, so that the class can be instantiated
	 * in any case and and gracefully tell the user if PHP version is insufficient.
	 *
	 * @return Aelia_WC_AFC_RequirementsChecks
	 */
	public static function factory() {
		$instance = new self();
		return $instance;
	}
}
