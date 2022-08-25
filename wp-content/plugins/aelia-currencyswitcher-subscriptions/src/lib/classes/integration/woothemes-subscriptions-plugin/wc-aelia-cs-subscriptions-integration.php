<?php
namespace Aelia\WC\CurrencySwitcher\Subscriptions;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

use \WC_Aelia_CurrencySwitcher;
use \WC_Aelia_CurrencyPrices_Manager;
use \WC_Subscriptions_Product;
use \WC_Product;
use \WC_Product_Subscription;
use \WC_Product_Subscription_Variation;
use \WC_Subscriptions_Cart;
use \Aelia\WC\CurrencySwitcher\WC_Aelia_CurrencySwitcher_Widget;
use \Aelia\WC\CurrencySwitcher\WC_Aelia_Currencies_Manager;

/**
 * Implements support for WooThemes Subscriptions plugin.
 */
class Subscriptions_Integration {
	const FIELD_SIGNUP_FEE_CURRENCY_PRICES = '_subscription_signup_fee_currency_prices';
	const FIELD_VARIATION_SIGNUP_FEE_CURRENCY_PRICES = '_subscription_variation_signup_fee_currency_prices';

	const FIELD_REGULAR_CURRENCY_PRICES = '_subscription_variation_regular_currency_prices';
	const FIELD_SALE_CURRENCY_PRICES = '_subscription_variation_sale_currency_prices';
	const FIELD_VARIATION_REGULAR_CURRENCY_PRICES = '_subscription_variation_regular_currency_prices';
	const FIELD_VARIATION_SALE_CURRENCY_PRICES = '_subscription_variation_sale_currency_prices';

	// @var WC_Aelia_CurrencyPrices_Manager The object that handles currency prices for the products.
	private $currencyprices_manager;

	// @var Shop's base currency. Used for caching.
	protected static $_base_currency;

	/**
	 * The currency that should be set as active during
	 * the processing of a renewal
	 *
	 * @var string
	 * @since 1.4.8.190905
	 * @link https://aelia.freshdesk.com/a/tickets/23457
	 */
	protected $subscription_renewal_currency;

	/**
	 * Logs a message.
	 *
	 * @param string message The message to log.
	 * @param bool debug Indicates if the message is for debugging. Debug messages
	 * are not saved if the "debug mode" flag is turned off.
	 * @since 1.3.0.160617
	 */
	public function log($message, $debug = true) {
		return WC_Aelia_CS_Subscriptions::instance()->log($message, $debug);
	}

	/**
	 * Fix for Subscriptions bug #1040.
	 * The currency to be used at checkout. Used to override the active currency
	 * when paying for a resubscription.
	 * @var string
	 * @since 1.2.13.151208
	 * @link https://github.com/Prospress/woocommerce-subscriptions/issues/1040
	 */
	protected $checkout_currency = '';

	/**
	 * Returns the instance of the Currency Switcher plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher
	 */
	protected function currency_switcher() {
		return WC_Aelia_CurrencySwitcher::instance();
	}

	/**
	 * Returns the instance of the settings controller loaded by the plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher_Settings
	 */
	protected function settings_controller() {
		return WC_Aelia_CurrencySwitcher::settings();
	}

	/**
	 * Returns the instance of the currency prices manager used by the Currency
	 * Switcher plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher_Settings
	 */
	protected function currencyprices_manager() {
		return WC_Aelia_CurrencyPrices_Manager::instance();
	}

	/**
	 * Convenience method. Returns an array of the Enabled Currencies.
	 *
	 * @return array
	 */
	protected function enabled_currencies() {
		return WC_Aelia_CurrencySwitcher::settings()->get_enabled_currencies();
	}

	/**
	 * Callback for array_filter(). Returns true if the passed value is numeric.
	 *
	 * @param mixed value The value to check.
	 * @return bool
	 * @since 1.4.3.190630
	 */
	protected function keep_numeric($value) {
		return is_numeric($value);
	}

	/**
	 * Returns an array of Currency => Price values containing the signup fees
	 * of a subscription, in each currency.
	 *
	 * @param int post_id The ID of the Post (subscription).
	 * @return array
	 */
	public static function get_subscription_signup_prices($post_id) {
		return WC_Aelia_CurrencyPrices_Manager::Instance()->get_product_currency_prices($post_id,
																																										self::FIELD_SIGNUP_FEE_CURRENCY_PRICES);
	}

	/**
	 * Returns an array of Currency => Price values containing the signup fees
	 * of a subscription variation, in each currency.
	 *
	 * @param int post_id The ID of the Post (subscription).
	 * @return array
	 */
	public static function get_subscription_variation_signup_prices($post_id) {
		return WC_Aelia_CurrencyPrices_Manager::Instance()->get_product_currency_prices($post_id,
																																										self::FIELD_VARIATION_SIGNUP_FEE_CURRENCY_PRICES);
	}

	/**
	 * Returns an array of Currency => Price values containing the Regular
	 * Currency Prices of a subscription.
	 *
	 * @param int post_id The ID of the Post (subscription).
	 * @return array
	 */
	public function get_subscription_regular_prices($post_id) {
		return $this->currencyprices_manager()->get_product_currency_prices($post_id,
																																				WC_Aelia_CurrencyPrices_Manager::FIELD_REGULAR_CURRENCY_PRICES);
	}

	/**
	 * Returns an array of Currency => Price values containing the Sale Currency
	 * Prices of a subscription.
	 *
	 * @param int post_id The ID of the Post (subscription).
	 * @return array
	 */
	public function get_subscription_sale_prices($post_id) {
		return $this->currencyprices_manager()->get_product_currency_prices($post_id,
																																				WC_Aelia_CurrencyPrices_Manager::FIELD_SALE_CURRENCY_PRICES);
	}

	/**
	 * Returns the value of the meta from a subscription product.
	 *
	 * @param WC_Product product
	 * @param string meta_key
	 * @param string default_value
	 * @since 1.3.1.170405
	 */
	protected function get_subscription_meta($product, $meta_key, $default_value = '') {
		return WC_Subscriptions_Product::get_meta_data($product, $meta_key, $default_value, 'use_default_value');
	}

	/**
	 * Convenience method. Returns WooCommerce base currency.
	 *
	 * @return string
	 */
	public function base_currency() {
		if(empty(self::$_base_currency)) {
			self::$_base_currency = WC_Aelia_CurrencySwitcher::settings()->base_currency();
		}
		return self::$_base_currency;
	}

	/**
	 * Indicates if the price of a product being renewed should be preserved.
	 *
	 * WHY
	 * The Subscriptions plugin applies a "grandfathering" logic to renewals,
	 * taking the price originally paid for the product. The Currency Switcher, on
	 * the other hand, always takes the latest price of each product. Due to that, a
	 * the price of a renewal could be higher or lower than the one originally paid. This
	 * method allows to preserve the original logic of the Subscriptions plugin,
	 * without overwriting the "old" product with the latest one.
	 *
	 * @param WC_Product $product
	 * @return boolean
	 * @since 1.5.0.200410
	 */
	protected function should_preserve_renewal_price($product) {
		// @note Dynamic property
		// @since x.x
		return !empty(aelia_get_object_aux_data($product, 'aelia_product_renewal')) ||
					 // If argument "subscription_renewal" is set, we are processing a renewal. The price
					 // of the product being handled should not be touched
					 // @since 1.5.3.200617
					 (!empty($_REQUEST['subscription_renewal']) && ($_REQUEST['subscription_renewal'] === 'true')) &&
					 apply_filters('wc_aelia_cs_subscriptions_preserve_renewal_price', true, $product);
	}

	/**
	 * Converts a subscription prices to the specific currency, taking
	 * into account manually entered prices.
	 *
	 * @param WC_Product product The subscription whose prices should
	 * be converted.
	 * @param string currency A currency code.
	 * @param array product_regular_prices_in_currency An array of manually entered
	 * product prices (one for each currency).
	 * @param array product_sale_prices_in_currency An array of manually entered
	 * product prices (one for each currency).
	 * @return WC_Product
	 */
	protected function convert_to_currency(WC_Product $product, $currency,
																				 array $product_regular_prices_in_currency,
																				 array $product_sale_prices_in_currency,
																				 array $product_signup_prices_in_currency) {
		// @since 1.3.1.170405
		$product_id = $product->get_id();
		$product_base_currency = $this->currencyprices_manager()->get_product_base_currency($product_id);
		$shop_base_currency = $this->base_currency();

		// If subscription price and signup fee in shop's base currency were not passed,
		// retrieve them using the Subscription plugin's function. The sale price uses
		// a standard field, and it's always passed by WooCommerce
		// @since 1.3.5.170425
		if(!isset($product_regular_prices_in_currency[$shop_base_currency])) {
			$product_regular_prices_in_currency[$shop_base_currency] = $this->get_subscription_meta($product, 'subscription_price');
		}
		if(!isset($product_signup_prices_in_currency[$shop_base_currency])) {
			$product_signup_prices_in_currency[$shop_base_currency] = $this->get_subscription_meta($product, 'subscription_sign_up_fee', 0);
		}

		// Take subscription price in the specific product base currency
		$base_subscription_price = isset($product_regular_prices_in_currency[$product_base_currency]) ? $product_regular_prices_in_currency[$product_base_currency] : null;

		// If a subscription price was not entered for the selected product base currency,
		// take the one in shop base currency
		if(!is_numeric($base_subscription_price)) {
			$base_subscription_price = isset($product_regular_prices_in_currency[$shop_base_currency]) ? $product_regular_prices_in_currency[$shop_base_currency] : null;

			// If a product doesn't have a price in the product-specific base currency,
			// then that base currency is not valid. In such case, shop's base currency
			// should be used instead
			$product_base_currency = $shop_base_currency;
		}

		// Take sale price in the specific product base currency
		$base_sale_price = isset($product_sale_prices_in_currency[$product_base_currency]) ? $product_sale_prices_in_currency[$product_base_currency] : null;
		// If a sale price was not entered for the selected product base currency,
		// take the one in shop base currency
		if(!is_numeric($base_sale_price)) {
			$base_sale_price = isset($product_sale_prices_in_currency[$shop_base_currency]) ? $product_sale_prices_in_currency[$shop_base_currency] : null;
		}

		// Take signup fee in the specific product base currency
		$base_subscription_sign_up_fee = isset($product_signup_prices_in_currency[$product_base_currency]) ? $product_signup_prices_in_currency[$product_base_currency] : null;
		// If a signup fee was not entered for the selected product base currency,
		// take the one in shop base currency
		if(!is_numeric($base_subscription_sign_up_fee)) {
			$base_subscription_sign_up_fee = isset($product_signup_prices_in_currency[$shop_base_currency]) ? $product_signup_prices_in_currency[$shop_base_currency] : null;
		}

		// If the regular price is not valid, take it from the base currency
		// @since 1.4.0.181107
		$product_regular_price = isset($product_regular_prices_in_currency[$currency]) ? $product_regular_prices_in_currency[$currency] : null;
		if(($currency != $product_base_currency) && !is_numeric($product_regular_price)) {
			$product_regular_price = $this->currencyprices_manager()->convert_product_price_from_base($base_subscription_price, $currency, $product_base_currency, $product, 'regular_price');
		}

		// If the sale price is not valid, take it from the base currency
		// @since 1.4.0.181107
		$product_sale_price = isset($product_sale_prices_in_currency[$currency]) ? $product_sale_prices_in_currency[$currency] : null;
		if(($currency != $product_base_currency) && !is_numeric($product_sale_price)) {
			$product_sale_price = $this->currencyprices_manager()->convert_product_price_from_base($base_sale_price, $currency, $product_base_currency, $product, 'sale_price');
		}

		// If the sign up fee is not valid, take it from the base currency
		// @since 1.4.0.181107
		$product_subscription_sign_up_fee = isset($product_signup_prices_in_currency[$currency]) ? $product_signup_prices_in_currency[$currency] : null;
		if(($currency != $product_base_currency) && !is_numeric($product_subscription_sign_up_fee)) {
			$product_subscription_sign_up_fee = $this->currencyprices_manager()->convert_product_price_from_base($base_subscription_sign_up_fee, $currency, $product_base_currency, $product, 'signup_fee');
		}

		if(is_numeric($product_sale_price) &&
			 $this->product_is_on_sale($product, $product_sale_price, $product_regular_price)) {
			$product_price = $product_sale_price;
		}
		else {
			$product_price = $product_regular_price;
		}
		$product_subscription_price = $product_price;

		// New logic to replace dynamic properties
		// @note Dynamic property
		// @since 1.7.0.220730
		aelia_set_object_aux_data($product, 'regular_price', $product_regular_price);
		aelia_set_object_aux_data($product, 'sale_price', $product_sale_price);
		aelia_set_object_aux_data($product, 'price', $product_price);

		aelia_set_object_aux_data($product, 'subscription_price', $product_subscription_price);
		aelia_set_object_aux_data($product, 'subscription_sign_up_fee', $product_subscription_sign_up_fee);

		// @since 1.3.1.170405
		$product->set_regular_price($product_regular_price);
		$product->set_sale_price($product_sale_price);

		// If the subscription is being renewed and the renewal price should be
		// preserved, keep the price set by the subscription plugin, instead of the
		// latest one
		// @since 1.5.0.200410
		if(!$this->should_preserve_renewal_price($product)) {
			$product->set_price($product_price);
		}

		return $product;
	}

	/**
	 * Tags cart items containing a product being renewed or resubscribed, to make
	 * it easier to distinguish them.
	 *
	 * @param WC_Cart $cart
	 * @since 1.3.3.170413
	 */
	protected function tag_cart_resubscribes_and_renewals($cart = null) {
		if(empty($cart)) {
			$cart = WC()->cart;
		}

		if(!empty($cart->cart_contents)) {
			foreach($cart->cart_contents as $cart_item) {
				// Tag the cart items with renewals, upgrades or downgrades
				$this->tag_cart_item($cart_item);
			}
		}
	}

	/**
	 * Given a subscription ID, it returns the currency stored against it.
	 *
	 * @param string $subscription_id
	 * @return string
	 * @since 1.6.0.220202
	 */
	protected function get_currency_from_subscription(string $subscription_id): string {
		$subscription = wcs_get_subscription($subscription_id);

		// Check that the subscription is a valid object, before trying to fetch the currency from it. In
		// some cases (don't know the specific conditions), the Subscriptions plugin can return "false",
		// which would throw a fatal error
		// @since 1.5.10.201120
		return ($subscription instanceof \WC_Order) ?  $this->get_order_currency($subscription) : '';
	}

	/**
	 * Tags a cart item when it contains a product being renewed or resubscribed, to make
	 * it easier to distinguish them.
	 *
	 * @param array $cart_item
	 * @since 1.5.0.200410
	 */
	protected function tag_cart_item(&$cart_item) {
		// Skip cart items that don't have a product
		if(!is_object($cart_item['data'])) {
			return;
		}

		// Tag products being resubscribed
		if(isset($cart_item['subscription_resubscribe'])) {
			// @note Dynamic property
			// @since x.x
			aelia_set_object_aux_data($cart_item['data'], 'aelia_product_resubscribe', true);

			// Fetch the currency of the original subscription. This will be used to force the
			// checkout in that currency during the resubscription
			// @since 1.6.0.220202
			$checkout_currency = $this->get_currency_from_subscription((string)$cart_item['subscription_resubscribe']['subscription_id']);
		}

		// Tag products being renewed
		if(isset($cart_item['subscription_renewal'])) {
			// @note Dynamic property
			// @since x.x
			aelia_set_object_aux_data($cart_item['data'], 'aelia_product_renewal', true);


			// Fetch the currency of the original subscription. This will be used to force the
			// checkout in that currency during the renewal
			// @since 1.6.0.220202
			$checkout_currency = $this->get_currency_from_subscription((string)$cart_item['subscription_renewal']['subscription_id']);
		}

		// Tag products being switched
		// @since 1.3.6.170531
		if(isset($cart_item['subscription_switch'])) {
			// @note Dynamic property
			// @since x.x
			aelia_set_object_aux_data($cart_item['data'], 'aelia_product_switch', true);


			// Fetch the currency of the original subscription. This will be used to force the
			// checkout in that currency during the switch
			// @since 1.6.0.220202
			$checkout_currency = $this->get_currency_from_subscription((string)$cart_item['subscription_switch']['subscription_id']);
		}

		// Store the checkout currency against the item
		if(!empty($checkout_currency)) {
			$cart_item['aelia_checkout_currency'] = $checkout_currency;
		}

		return $cart_item;
	}

	/**
	 * Indicates if a product is being purchased as a renewal.
	 *
	 * @param WC_Product product
	 * @return bool
	 * @since 1.3.3.170413
	 */
	protected function is_renewal_or_resubscribe_purchase($product) {
		/* Look cart items containing a product being renewed or resubscribed.
		 * When one is found, attach a flag to the product, to indicate that it's a
		 * renewal/resubscribe. Since objects are passed by reference, if we "tack"
		 * the flag on the same product that we got as an argument for this method,
		 * then we will be able to retrieve it at the end of the function.
		 *
		 * Example
		 * 1. Instance of Product X passed as an argument. It might not have the flag.
		 * 2. Going through the cart, we find that one instance of Product X is being
		 *    purchased as a renewal. We add the flag to the instance of that product.
		 * 3. We check for the presence of the flag on the object passed as an argument.
		 *    If we attached that flag in step #2, we will find it against the object.
		 */
		$this->tag_cart_resubscribes_and_renewals();

		// @note Dynamic property
		// @since x.x
		return !empty(aelia_get_object_aux_data($product, 'aelia_product_renewal')) ||
					 !empty(aelia_get_object_aux_data($product, 'aelia_product_resubscribe')) ||
					 !empty(aelia_get_object_aux_data($product, 'aelia_product_switch'));
	}

	/**
	 * Indicates if a product is being purchased as a subscription switch.
	 *
	 * @param WC_Product product
	 * @return bool
	 * @since 1.4.6.190807
	 * @link https://aelia.freshdesk.com/a/tickets/23356
	 */
	protected function is_subscription_switch($product) {
		/* Look cart items containing a product being renewed or resubscribed.
		 * When one is found, attach a flag to the product, to indicate that it's a
		 * renewal/resubscribe. Since objects are passed by reference, if we "tack"
		 * the flag on the same product that we got as an argument for this method,
		 * then we will be able to retrieve it at the end of the function.
		 *
		 * Example
		 * 1. Instance of Product X passed as an argument. It might not have the flag.
		 * 2. Going through the cart, we find that one instance of Product X is being
		 *    purchased as a renewal. We add the flag to the instance of that product.
		 * 3. We check for the presence of the flag on the object passed as an argument.
		 *    If we attached that flag in step #2, we will find it against the object.
		 */
		$this->tag_cart_resubscribes_and_renewals();

		// @note Dynamic property
		// @since x.x
		return !empty(aelia_get_object_aux_data($product, 'aelia_product_switch'));
	}

	public function __construct() {
		$this->set_hooks();
	}

	/**
	 * Indicates if we are editing an order.
	 *
	 * @param string post_type
	 * @return bool
	 * @since 1.3.1.170405
	 */
	protected static function editing_order($post_type = 'shop_order') {
		if(!empty($_GET['action']) && ($_GET['action'] == 'edit') && !empty($_GET['post'])) {
			$post = get_post($_GET['post']);

			if(!empty($post) && ($post->post_type == $post_type)) {
				return $post->ID;
			}
		}
		return false;
	}

	/**
	 * Indicates if we are editing a subscription.
	 *
	 * @return bool
	 * @since 1.3.8.171004
	 */
	protected static function editing_subscription() {
		return self::editing_order('shop_subscription');
	}

	/**
	 * Indicates if a product is supported by this integratoin.
	 *
	 * @param WC_Product product
	 * @return bool
	 * @since 1.3.3.170413
	 */
	protected function is_supported_subscription_product($product) {
		return in_array(get_class($product), array(
			'WC_Product_Subscription',
			'WC_Product_Subscription_Variation',
			'WC_Product_Variable_Subscription',
			// Legacy products, introduced in Subscriptions 2.2
			'WC_Product_Subscription_Legacy',
			'WC_Product_Subscription_Variation_Legacy',
			'WC_Product_Variable_Subscription_Legacy',
		));
	}

	/**
	 * Set the hooks required by the class.
	 */
	protected function set_hooks() {
		if(WC_Aelia_CS_Subscriptions::is_frontend() || self::editing_order() || self::editing_subscription()) {
			// Price conversion
			add_filter('wc_aelia_currencyswitcher_product_convert_callback', array($this, 'wc_aelia_currencyswitcher_product_convert_callback'), 10, 2);
			add_filter('woocommerce_subscriptions_product_price', array($this, 'woocommerce_subscriptions_product_price'), 10, 2);
			add_filter('woocommerce_subscriptions_product_sign_up_fee', array($this, 'woocommerce_subscriptions_product_sign_up_fee'), 10, 2);

			// Suppress "missing property" notices for subscription products
			// @since 1.4.9.191219
			add_filter('wc_aelia_cs_product_should_have_property', array($this, 'wc_aelia_cs_product_should_have_property'), 10, 3);

			// Coupon types
			add_filter('wc_aelia_cs_coupon_types_to_convert', array($this, 'wc_aelia_cs_coupon_types_to_convert'), 10, 1);
		}

		// Product edit/add hooks
		add_action('woocommerce_process_product_meta_subscription', array($this, 'woocommerce_process_product_meta_subscription'), 10);
		add_action('woocommerce_process_product_meta_variable-subscription', array($this, 'woocommerce_process_product_meta_variable_subscription'), 10);

		// WC 2.4+
		add_action('woocommerce_ajax_save_product_variations', array($this, 'woocommerce_ajax_save_product_variations'));

		// Admin UI
		add_action('woocommerce_product_options_general_product_data', array($this, 'woocommerce_product_options_general_product_data'), 20);
		add_filter('woocommerce_product_after_variable_attributes', array($this, 'woocommerce_product_after_variable_attributes'), 20);

		// Cart hooks
		add_action('wc_aelia_currencyswitcher_recalculate_cart_totals_before', array($this, 'wc_aelia_currencyswitcher_recalculate_cart_totals_before'), 10);

		add_filter('wc_aelia_currencyswitcher_prices_type_field_map', array($this, 'wc_aelia_currencyswitcher_prices_type_field_map'), 10, 2);

		add_action('woocommerce_scheduled_subscription_payment', array($this, 'woocommerce_scheduled_subscription_payment'), 0);
		add_action('woocommerce_renewal_order_payment_complete', array($this, 'woocommerce_renewal_order_payment_complete'), 999);

		// Subscriptions 2.0 - Fix bug #1040
		// Fix checkout currency during renewals
		// @link https://aelia.freshdesk.com/a/tickets/85291
		// @link https://github.com/woocommerce/woocommerce-subscriptions/issues/1040
		add_filter('wp_loaded', array($this, 'maybe_override_currency'), 50);

		// Tag renewals, upgraded and downgrades when cart items are loaded from a session
		// @link https://aelia.freshdesk.com/a/tickets/86723
		add_filter('woocommerce_get_cart_item_from_session', array($this, 'woocommerce_get_cart_item_from_session'), 5, 3);

		//add_filter('woocommerce_add_cart_item', array($this, 'woocommerce_add_cart_item'), 5, 1);
		// Add filter to prevent the conversion of product prices during renewals
		// @since 1.5.3.200617
		add_filter('wc_aelia_cs_product_requires_conversion', array($this, 'wc_aelia_cs_product_requires_conversion'), 5, 2);

		// Handle manual creation of subscription
		// @since 1.3.8.171004
		add_action('woocommerce_process_shop_order_meta', array($this, 'woocommerce_process_shop_order_meta'), 5, 2);
		// Currency selector on the Edit Subscription page
		// @since 1.3.8.171004
		add_filter('woocommerce_currency', array($this, 'get_currency_for_manual_subscription'), 35, 1);
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

		// Load the Edit Order scripts on the Edit Subscription page, to ensure that
		// product prices are loaded in the correct order currency
		// @since 1.3.11.180222
		add_filter('wc_aelia_cs_load_order_edit_scripts', array($this, 'wc_aelia_cs_load_order_edit_scripts'), 10, 2);
	}

	/**
	 * Converts all the prices of a given product in the currently selected
	 * currency.
	 *
	 * @param WC_Product product The product whose prices should be converted.
	 * @return WC_Product
	 */
	protected function convert_product_prices($product) {
		$selected_currency = $this->currency_switcher()->get_selected_currency();
		$base_currency = $this->settings_controller()->base_currency();

		$product = $this->currencyprices_manager()->convert_product_prices($product, $selected_currency);

		return $product;
	}

	/**
	 * Callback to perform the conversion of subscription prices into selected currencu.
	 *
	 * @param callable $original_convert_callback The original callback passed to the hook.
	 * @param WC_Product The product to examine.
	 * @return callable
	 */
	public function wc_aelia_currencyswitcher_product_convert_callback($original_convert_callback, $product) {
		$method_keys = array(
			'WC_Product_Subscription' => 'subscription',
			// TODO Implement conversion of variable subscriptions
			'WC_Product_Subscription_Variation' => 'subscription_variation',
			'WC_Product_Variable_Subscription' => 'variable_subscription',

			'WC_Product_Subscription_Legacy' => 'subscription',
			'WC_Product_Subscription_Variation_Legacy' => 'subscription_variation',
			'WC_Product_Variable_Subscription_Legacy' => 'variable_subscription',
		);

		// Determine the conversion method to use
		$method_key = isset($method_keys[get_class($product)]) ? $method_keys[get_class($product)] : '';

		$convert_method = 'convert_' . $method_key . '_product_prices';

		if(!method_exists($this, $convert_method)) {
			return $original_convert_callback;
		}

		return array($this, $convert_method);
	}

	/**
	 * Converts the prices of a subscription product to the specified currency.
	 *
	 * @param WC_Product_Subscription product A subscription product.
	 * @param string currency A currency code.
	 * @return WC_Product_Subscription The product with converted prices.
	 */
	public function convert_subscription_product_prices(WC_Product_Subscription $product, $currency) {
		// @since 1.3.1.170405
		$product_id = $product->get_id();
		$product = $this->convert_to_currency($product,
																					$currency,
																					$this->get_subscription_regular_prices($product_id),
																					$this->get_subscription_sale_prices($product_id),
																					self::get_subscription_signup_prices($product_id));

		return $product;
	}

	/**
	 * Converts the prices of a variable product to the specified currency.
	 *
	 * @param WC_Product_Variable product A variable product.
	 * @param string currency A currency code.
	 * @return WC_Product_Variable The product with converted prices.
	 */
	public function convert_variable_subscription_product_prices(WC_Product $product, $currency) {
		$product_children = $product->get_children();

		if(empty($product_children)) {
			return $product;
		}

		$variation_regular_prices = array();
		$variation_sale_prices = array();
		$variation_signup_prices = array();
		$variation_prices = array();

		$currencyprices_manager = $this->currencyprices_manager();
		foreach($product_children as $variation_id) {
			$variation = $this->load_subscription_variation_in_currency($variation_id, $currency);

			if(empty($variation)) {
				continue;
			}

			// @note Dynamic property
			// @since 1.7.0.220730
			$variation_regular_prices[] = aelia_get_object_aux_data($variation, 'regular_price');
			$variation_sale_prices[] = aelia_get_object_aux_data($variation, 'sale_price');
			$variation_signup_prices[] = aelia_get_object_aux_data($variation, 'subscription_sign_up_fee');
			$variation_prices[] = aelia_get_object_aux_data($variation, 'price');
		}

		// Filter out all the non-numeric prices for the variations. The remaining prices will be used to determine
		// the minimum and maximum variation prices
		// @since 1.4.3.190630
		$variation_regular_prices = is_array($variation_regular_prices) ? array_filter($variation_regular_prices, array($this, 'keep_numeric')) : array();
		$variation_sale_prices = is_array($variation_sale_prices) ? array_filter($variation_sale_prices, array($this, 'keep_numeric')) : array();
		$variation_prices = is_array($variation_prices) ? array_filter($variation_prices, array($this, 'keep_numeric')) : array() ;
		$variation_signup_prices = is_array($variation_signup_prices) ? array_filter($variation_signup_prices, array($this, 'keep_numeric')) : array() ;

		// Only set the properties if they actually exists on the object. This is to ensure compatibility
		// with PHP 8.2, which deprecates dynamic properties. If these properties don't exist, then they
		// aren't going to be used anyway.
		// @since 4.14.0.220730
		aelia_maybe_set_object_prop($product, 'min_variation_regular_price', $currencyprices_manager->get_min_value($variation_regular_prices));
		aelia_maybe_set_object_prop($product, 'max_variation_regular_price', $currencyprices_manager->get_max_value($variation_regular_prices));

		aelia_maybe_set_object_prop($product, 'min_variation_sale_price', $currencyprices_manager->get_min_value($variation_sale_prices));
		aelia_maybe_set_object_prop($product, 'max_variation_sale_price', $currencyprices_manager->get_max_value($variation_sale_prices));

		aelia_maybe_set_object_prop($product, 'min_variation_price', $currencyprices_manager->get_min_value($variation_prices));
		aelia_maybe_set_object_prop($product, 'max_variation_price', $currencyprices_manager->get_max_value($variation_prices));

		aelia_maybe_set_object_prop($product, 'min_subscription_sign_up_fee', $currencyprices_manager->get_min_value($variation_signup_prices));
		aelia_maybe_set_object_prop($product, 'max_subscription_sign_up_fee', $currencyprices_manager->get_max_value($variation_signup_prices));

		// Keep track of the product prices, using the new logic to handle auxiliary data
		// @note Dynamic property
		// @since 4.14.0.220730
		$product_subscription_price = $currencyprices_manager->get_min_value($variation_prices);
		$product_subscription_sign_up_fee = $currencyprices_manager->get_min_value($variation_signup_prices);

		aelia_set_object_aux_data($product, 'subscription_price', $product_subscription_price);
		// The product price always has the same value as the subscription price, as it represents the same information, i.e.
		// the price that the customer will pay on a regular basis
		aelia_set_object_aux_data($product, 'price', $product_subscription_price);
		aelia_set_object_aux_data($product, 'subscription_sign_up_fee', $product_subscription_sign_up_fee);

		if(!isset($product->max_variation_period)) {
			// Only set the property if it actually exists on the object. This is to ensure compatibility
			// with PHP 8.2, which deprecates dynamic propertis
			// @since 1.7.0.220730
			aelia_maybe_set_object_prop($product, 'max_variation_period', '');
		}

		if(!isset($product->max_variation_period_interval)) {
			// Only set the property if it actually exists on the object. This is to ensure compatibility
			// with PHP 8.2, which deprecates dynamic propertis
			// @since 1.7.0.220730
			aelia_maybe_set_object_prop($product, 'max_variation_period_interval', '');
		}

		return $product;
	}

	/**
	 * Converts the product prices of a variation.
	 *
	 * @param WC_Product_Variation $product A product variation.
	 * @param string currency A currency code.
	 * @return WC_Product_Variation The variation with converted prices.
	 */
	public function convert_subscription_variation_product_prices(WC_Product_Subscription_Variation $product, $currency) {
		// @since 1.3.1.170405
		$variation_id = $product->get_id();
		$product = $this->convert_to_currency($product,
																					$currency,
																					$this->currencyprices_manager()->get_variation_regular_prices($variation_id),
																					$this->currencyprices_manager()->get_variation_sale_prices($variation_id),
																					$this->get_subscription_variation_signup_prices($variation_id));

		return $product;
	}

	/**
	 * Indicates if a product requires conversion.
	 *
	 * @param WC_Product product The product to process.
	 * @param string currency The target currency for which product prices will
	 * be requested.
	 * @return bool
	 * @since 1.3.1.170405
	 */
	protected function product_requires_conversion($product, $currency) {
		// Fetch the currency from the product
		// @note Dynamic property
		// @since 1.7.0.220730
		$product_currency = aelia_get_object_aux_data($product, 'currency');

		// If the product is already in the target currency, it doesn't require
		// conversion.
		// Filter "wc_aelia_cs_product_requires_conversion" will allow 3rd parties
		// to skip the conversion in specific cases
		return apply_filters('wc_aelia_cs_product_requires_conversion', empty($product_currency) || ($product_currency != $currency), $product, $currency);
	}

	/**
	 * Given a Variation ID, it loads the variation and returns it, with its
	 * prices converted into the specified currency.
	 *
	 * @param int variation_id The ID of the variation.
	 * @param string currency A currency code.
	 * @return WC_Product_Variation
	 */
	public function load_subscription_variation_in_currency($variation_id, $currency) {
		try {
			$variation = wc_get_product($variation_id);
		}
		catch(\Exception $e) {
			$variation = null;
			$err_msg = sprintf(__('Invalid subscription variation found. Variation ID: "%s". ' .
														'Variation will be skipped.', WC_Aelia_CS_Subscriptions::$text_domain),
												 $e->getMessage());
			$this->log($err_msg, false);
		}

		if(empty($variation)) {
			return false;
		}

		$variation = $this->convert_product_prices($variation, $currency);

		return $variation;
	}

	/**
	 * Converts the price of a subscription before it's used by WooCommerce.
	 *
	 * @param float subscription_price The original price of the subscription.
	 * @param WC_Subscription_Product product The subscription product.
	 * @return float
	 */
	public function woocommerce_subscriptions_product_price($subscription_price, $product) {
		if($this->is_supported_subscription_product($product)) {
			$selected_currency = $this->currencyprices_manager()->get_selected_currency();
			if($this->product_requires_conversion($product, $selected_currency)) {
				$product = $this->convert_product_prices($product, $selected_currency);
			}
		}

		// Only use the price calculated by the Currency Switcher if it's not null
		// @since 1.7.0.220730
		$aelia_subscription_price = aelia_get_object_aux_data($product, 'subscription_price');
		if($aelia_subscription_price != null) {
			$subscription_price = $aelia_subscription_price;
		}

		return $subscription_price;
	}

	/**
	 * Returns a subscription signup fee, converted into the active currency.
	 *
	 * @param float subscription_sign_up_fee The original subscription signup fee.
	 * @param WC_Subscription_Product product The subscription product.
	 * @return float
	 */
	public function woocommerce_subscriptions_product_sign_up_fee($subscription_sign_up_fee, $product) {
		// Don't process signup fees for unsupported products, renewals or subscription switches
		if($this->is_supported_subscription_product($product) &&
			!$this->is_subscription_switch($product) &&
			!$this->is_renewal_or_resubscribe_purchase($product)) {
			$selected_currency = $this->currencyprices_manager()->get_selected_currency();
			if($this->product_requires_conversion($product, $selected_currency)) {
				$product = $this->convert_product_prices($product, $selected_currency);
			}

			// Check that the sign up fee is numeric and that nobody else changed
			// it against the product, before returning it.
			// This is to prevent warnings being raised by the Subscriptions plugin, which takes
			// fees "blindly" and doesn't check that the value is a valid number
			// @since 1.4.5.190307

			// IMPORTANT
			// During subscriptions upgrades, the Subscriptions plugin calculates the pro-rated
			// upgrade price (i.e. the price to be paid, taking into account what the customer already
			// paid), and sets such upgrade price as a sign up fee. That value is automatically converted
			// to the active currency and doesn't need further processing. Due to that, during switches,
			// we cant' take the sign up fee from the product and convert it, as we would overwrite the
			// pro-rates sign up fee.
			// @since 1.4.6.190807

			// Only use the price calculated by the Currency Switcher if it's not null
			// @since 1.7.0.220730
			$aelia_subscription_sign_up_fee = aelia_get_object_aux_data($product, 'subscription_sign_up_fee');
			if(($aelia_subscription_sign_up_fee != null) && is_numeric($aelia_subscription_sign_up_fee)) {
				$subscription_sign_up_fee = (float)$aelia_subscription_sign_up_fee;
			}
		}

		return $subscription_sign_up_fee;
	}

	/**
	 * Suppress "missing property" for specific product types:
	 * - Variable subscriptions don't have a regular price or a sale price.
	 *
	 * @param bool $should_have_property
	 * @param WC_Product $product
	 * @param string $property_name
	 * @return bool
	 * @since 1.4.9.191219
	 */
	public function wc_aelia_cs_product_should_have_property($should_have_property, $product, $property_name) {
		if($product->is_type('variable-subscription') && in_array($property_name, array('regular_price', 'sale_price'))) {
			$should_have_property = false;
		}
		return $should_have_property;
	}

	/**
	 * Returns the path where the Admin Views can be found.
	 *
	 * @return string
	 */
	protected function admin_views_path() {
		return WC_Aelia_CS_Subscriptions::plugin_path() . '/views/admin';
	}

	/**
	 * Loads (includes) a View file.
	 *
	 * @param string view_file_name The name of the view file to include.
	 */
	private function load_view($view_file_name) {
		$file_to_load = $this->admin_views_path() . '/' . $view_file_name;

		if(!empty($file_to_load) && is_readable($file_to_load)) {
			include($file_to_load);
		}
	}

	/**
	 * Event handler fired when a subscription is being saved. It processes and
	 * saves the Currency Prices associated with the subscription.
	 *
	 * @param int post_id The ID of the Post (subscription) being saved.
	 */
	public function woocommerce_process_product_meta_subscription($post_id) {
		$currency_prices = isset($_POST[self::FIELD_SIGNUP_FEE_CURRENCY_PRICES]) ? $_POST[self::FIELD_SIGNUP_FEE_CURRENCY_PRICES] : false;
		$subscription_signup_prices = $this->currencyprices_manager()->sanitise_currency_prices($currency_prices);

		// Update the post meta
		// @since WC 3.0
		// @since 1.5.0.200410
		$product = wc_get_product($post_id);
		if($product instanceof \WC_Product) {
			$product->update_meta_data(self::FIELD_SIGNUP_FEE_CURRENCY_PRICES, json_encode($subscription_signup_prices));
			$product->save_meta_data();
		}

		// Copy the currency prices from the fields dedicated to the variation inside the standard product fields
		$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_REGULAR_CURRENCY_PRICES] = $_POST[self::FIELD_REGULAR_CURRENCY_PRICES];
		$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_SALE_CURRENCY_PRICES] = $_POST[self::FIELD_SALE_CURRENCY_PRICES];

		// Set the product/variation base currency to the value of the
		// new "subscription base currency" field. This allows to keep the fields for
		// simple and variable products separate from the subscriptions ones, and
		// just "merge" the data as needed.
		//
		// @since 1.4.7.190828
		// @link https://aelia.freshdesk.com/a/tickets/23439
		$product_base_currency_field = 'subscription_' . WC_Aelia_CurrencyPrices_Manager::FIELD_PRODUCT_BASE_CURRENCY;
		if(isset($_POST[$product_base_currency_field])) {
			$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_PRODUCT_BASE_CURRENCY] = $_POST[$product_base_currency_field];
		}

		$this->currencyprices_manager()->process_product_meta($post_id);
	}

	/**
	 * Event handler fired when a subscription is being saved. It processes and
	 * saves the Currency Prices associated with the subscription.
	 *
	 * @param int post_id The ID of the Post (subscription) being saved.
	 */
	public function woocommerce_process_product_meta_variable_subscription($post_id) {
		// Save the instance of the pricing manager to reduce calls to internal method
		$currencyprices_manager = $this->currencyprices_manager();

		// Retrieve all IDs, regular prices and sale prices for all variations. The
		// "all_" prefix has been added to easily distinguish these variables from
		// the ones containing the data of a single variation, whose names would
		// be otherwise very similar
		$all_variations_ids = isset($_POST['variable_post_id']) ? $_POST['variable_post_id'] : array();
		$all_variations_signup_currency_prices = isset($_POST[self::FIELD_VARIATION_SIGNUP_FEE_CURRENCY_PRICES]) ? $_POST[self::FIELD_VARIATION_SIGNUP_FEE_CURRENCY_PRICES] : false;

		// D.Zanella - This code saves the subscription prices for all variations in
		// the various currencies
		foreach($all_variations_ids as $variation_idx => $variation_id) {
			$variation = wc_get_product($variation_id);
			if($variation instanceof \WC_Product) {
				$currency_prices = isset($all_variations_signup_currency_prices[$variation_idx]) ? $all_variations_signup_currency_prices[$variation_idx] : null;
				$variations_signup_currency_prices = $currencyprices_manager->sanitise_currency_prices($currency_prices);

				$variation->update_meta_data(self::FIELD_VARIATION_SIGNUP_FEE_CURRENCY_PRICES, json_encode($variations_signup_currency_prices));
				$variation->save_meta_data();
			}
		}

		// Copy the currency prices from the fields dedicated to the variation inside the standard product fields
		$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_VARIABLE_REGULAR_CURRENCY_PRICES] = $_POST[self::FIELD_VARIATION_REGULAR_CURRENCY_PRICES];
		$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_VARIABLE_SALE_CURRENCY_PRICES] = $_POST[self::FIELD_VARIATION_SALE_CURRENCY_PRICES];

		// Set the product/variation base currency to the value of the
		// new "subscription base currency" field. This allows to keep the fields for
		// simple and variable products separate from the subscriptions ones, and
		// just "merge" the data as needed.
		//
		// @since 1.4.7.190828
		// @link https://aelia.freshdesk.com/a/tickets/23439
		$product_base_currency_field = 'subscription_' . WC_Aelia_CurrencyPrices_Manager::FIELD_PRODUCT_BASE_CURRENCY;
		if(isset($_POST[$product_base_currency_field])) {
			$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_PRODUCT_BASE_CURRENCY] = $_POST[$product_base_currency_field];
		}

		$currencyprices_manager->woocommerce_process_product_meta_variable($post_id);
	}

	/**
	 * Alters the view used to allow entering prices manually, in each currency.
	 *
	 * @param string file_to_load The view/template file that should be loaded.
	 * @return string
	 */
	public function woocommerce_product_options_general_product_data() {
		$this->load_view('simplesubscription_currencyprices_view.php');
	}

	/**
	 * Loads the view that allows to set the prices for a subscription variation.
	 *
	 * @param string file_to_load The original file to load.
	 * @return string
	 */
	public function woocommerce_product_after_variable_attributes() {
		$this->load_view('subscriptionvariation_currencyprices_view.php');
	}

	/**
	 * Intercepts the recalculation of the cart, ensuring that subscriptions
	 * subtotals are calculated correctly.
	 */
	public function wc_aelia_currencyswitcher_recalculate_cart_totals_before() {
		if(!WC_Subscriptions_Cart::cart_contains_subscription() &&
			 !wcs_cart_contains_renewal()) {
			// Cart doesn't contain subscriptions
			return;
		}

		// If cart contains subscriptions, force the full recalculation of totals and
		// subtotals. This is required for the Subscriptions plugin to recalculate
		// the subtotal in the mini-cart and display the correct amounts
		if(!defined('WOOCOMMERCE_CART')) {
			define('WOOCOMMERCE_CART', true);
		}
	}

	/**
	 * Adds coupon types related to subscriptions, which should be converted into
	 * the selected currency when used.
	 *
	 * @param array coupon_types The original array of coupon types passed by the
	 * Currency Switcher.
	 * @return array
	 */
	public function wc_aelia_cs_coupon_types_to_convert($coupon_types) {
		$coupon_types[] = 'sign_up_fee';
		$coupon_types[] = 'recurring_fee';

		return $coupon_types;
	}

	/**
	 * Returns the currency from an order or a subscription.
	 *
	 * @param WC_Order order
	 * @return string
	 * @since 1.3.12.180308
	 */
	protected function get_order_currency(\WC_Order $order) {
		return $order->get_currency();
	}

	/**
	 * If necessary, replaces the currency active at checkout with the one from
	 * the order from which the resubscription was started.
	 *
	 * @since 1.2.13.151208
	 * @link https://github.com/Prospress/woocommerce-subscriptions/issues/1040
	 */
	public function maybe_override_currency() {
		$this->checkout_currency = $this->get_checkout_currency();

		// Force the checkout currency and display a notice when the currency was forced
		// during the checkout and the cart is not empty
		// @since 1.5.3.200618
		if(!empty($this->checkout_currency) && (isset(WC()->cart) && !WC()->cart->is_empty())) {
			add_filter('wc_aelia_cs_selected_currency', array($this, 'override_currency'), 10);

			// Inform the customer when the checkout currency has been forced, due to the
			// presence of a renewal, upgrade or downgrade
			$this->show_checkout_currency_notice($this->checkout_currency);
		}
	}

	/**
	 * Tags a cart item containin a subscription renewal, upgrade and downgrade, to
	 * keep track of the currency in which that product must be purchased.
	 *
	 * @param array $cart_item
	 * @param array $values
	 * @param string $key
	 * @return array
	 * @since 1.5.0.200410
	 */
	public function woocommerce_get_cart_item_from_session($cart_item, $values, $key) {
		return $this->tag_cart_item($cart_item);
	}

	/**
	 * Disables the conversion of product prices during the processing of renewals.
	 *
	 * @param bool $requires_conversion
	 * @param WC_Product $product
	 * @return bool
	 * @since 1.5.3.200617
	 */
	public function wc_aelia_cs_product_requires_conversion($requires_conversion, $product) {
		return $requires_conversion && !$this->should_preserve_renewal_price($product);
	}

	/**
	 * Informs the customer when the checkout currency has been forced, due to the
	 * presence of a renewal, upgrade or downgrade.
	 *
	 * @param string $checkout_currency
	 * @since 1.5.0.200410
	 */
	protected function show_checkout_currency_notice($checkout_currency) {
		// Allow 3rd parties to decide not to display the notice that informs the customer
		// when the checkout currency has been forced
		if(!apply_filters('wc_aelia_cs_subscriptions_show_checkout_currency_notice', true, $checkout_currency)) {
			return;
		}

		$currency_name = WC_Aelia_Currencies_Manager::get_currency_name($checkout_currency);

		// Build the notice to inform the user that the currency has been forced to a specific one, due to
		// the presencoe of a renewal, upgrade or downgrade in the cart
		$forced_currency_notice = wp_kses_post(implode(' ', [
			'<strong>',
			__('Important', Definitions::TEXT_DOMAIN) . ':',
			'</strong>',
			__('Subscription renewals, upgrades, downgrades and re-subscriptions must be purchased in the currency used for the original subscription.', Definitions::TEXT_DOMAIN),
			sprintf(__('The active currency has been set to %s automatically.', Definitions::TEXT_DOMAIN), $currency_name),
		]));

		// Add the notice to the list, if not present already
		if(!wc_has_notice($forced_currency_notice)) {
			wc_add_notice($forced_currency_notice);
			add_filter('wc_aelia_cs_subscriptions_show_checkout_currency_notice', '__return_false');
		}
	}

	/**
	 * Returns the currency to be used at checkout. This method inspects the cart
	 * contents to determine if there is a "resubscription" product in it. If there
	 * is, then the currency to be used at checkout is the one attached to the
	 * resubscription.
	 *
	 * @return string|null The currency from the original subscription, or null if
	 * there isn't one.
	 * @since 1.2.13.151208
	 * @link https://github.com/Prospress/woocommerce-subscriptions/issues/1040
	 */
	protected function get_checkout_currency() {
		$currency = null;

		if(!empty(WC()->cart)) {
			foreach(WC()->cart->get_cart() as $item) {
				if(!empty($item['aelia_checkout_currency'])) {
					$currency = $item['aelia_checkout_currency'];
					break;
				}
			}
		}

		// When the customer goes to a product page to upgrade or downgrade the subscription,
		// take the currency from the original subscription
		// @since 1.5.1.200414
		if(empty($currency) && !empty($_GET['switch-subscription']) && !empty($_GET['item'])) {
			$subscription = wcs_get_subscription($_GET['switch-subscription']);

			if(is_object($subscription) && ($subscription instanceof \WC_Subscription)) {
				$currency = $subscription->get_currency();
			}
		}

		return $currency;
	}

	/**
	 * Overrides the active currency during checkout, when a resubscription is
	 * being processed.
	 *
	 * @param string currency The original currency.
	 * @return string The currency to be used at checkout.
	 * @since 1.2.13.151208
	 * @link https://github.com/Prospress/woocommerce-subscriptions/issues/1040
	 */
	public function override_currency($currency) {
		return $this->checkout_currency;
	}

	/**
	 * Handles the saving of variations data using the new logic introduced in
	 * WooCommerce 2.4.
	 *
	 * @param int product_id The ID of the variable product whose variations are
	 * being saved.
	 * @since 1.2.14.151215
	 * @since WC 2.4
	 */
	public function woocommerce_ajax_save_product_variations($product_id) {
		if(WC_Subscriptions_Product::is_subscription($product_id)) {
			$this->woocommerce_process_product_meta_variable_subscription($product_id);
		}
	}

	/**
	 * Alters the map of currency pricing fields to inform the Currency Switcher
	 * how to retrieve the prices in shop's base currency.
	 *
	 * @param array prices_type_field_map
	 * @return array
	 * @since 1.3.5.170425
	 */
	public function wc_aelia_currencyswitcher_prices_type_field_map($prices_type_field_map, $post_id = null) {
		// Subscription sign up fee
		$prices_type_field_map[self::FIELD_SIGNUP_FEE_CURRENCY_PRICES] = '_subscription_sign_up_fee';

		return $prices_type_field_map;
	}

	/**
	 * Fired after an order is saved. It addsa a filter to ensure that the currency
	 * for new subscriptions is set to the active currency.
	 *
	 * @param int post_id The post (subscription) ID.
	 * @param post The post corresponding to the order that is being been saved.
	 * @since 1.3.8.171004
	 */
	public function woocommerce_process_shop_order_meta($post_id, $post) {
		if($post->post_type != 'shop_subscription') {
			return;
		}

		// Set the currency on manually created orders when their first draft is saved.
		// This is done to prevent WooCommerce from returning shop's base currency
		// when WC_Order::get_currency() is called. See old code below, for reference
		// @since 4.5.1.171012
		$order = wc_get_order($post_id);

		if($order->has_status(array('draft', 'auto-draft', 'pending')) && !empty($_POST['aelia_cs_currency'])) {
			add_filter('woocommerce_currency', array($this->currency_switcher(), 'woocommerce_currency'), 50);
		}

		// Only set the currency if the order doesn't have one set against it.
		// Using direct access to meta is less than ideal, but it's the only way to
		// determine if the meta is missing, as the new WC_Data layer always returns
		// a currency value, even when the order has none.
		// This bug has been reported in https://github.com/woocommerce/woocommerce/issues/14966
		//$order_currency = get_post_meta($post_id, '_order_currency', true);
		//if(empty($order_currency)) {
		//	add_filter('woocommerce_currency', array($this->currencyswitcher(), 'woocommerce_currency'), 5);
		//}
	}

	/**
	 * Adds meta boxes to the admin interface.
	 *
	 * @see add_meta_boxes().
	 * @since 1.3.8.171004
	 */
	public function add_meta_boxes() {
		add_meta_box('aelia_cs_order_currency_box',
								 __('Subscription currency', Definitions::TEXT_DOMAIN),
								 array($this, 'render_currency_selector_widget'),
								 'shop_subscription',
								 'side',
								 'default');
	}

	/**
	 * Renders the currency selector widget in "new subscription" page.
	 *
	 * @since 1.3.8.171004
	 */
	public function render_currency_selector_widget() {
		$order_currency = $this->displayed_order_currency();

		global $post;
		if(empty($order_currency)) {
			echo '<p>';
			echo __('Set currency for this new subscription. It is recommended to choose ' .
							'the order currency <b>before</b> adding the products, as changing ' .
							'it later will not update the product prices.',
							Definitions::TEXT_DOMAIN);
			echo '</p>';
			echo '<p>';
			echo __('<b>NOTE</b>: you can only select the currency <b>once</b>. If ' .
							'you choose the wrong currency, please discard the subscription and ' .
							'create a new one.',
							Definitions::TEXT_DOMAIN);
			echo '</p>';
			$currency_selector_options = array(
				'title' => '',
				'widget_type' => 'dropdown',
			);

			echo WC_Aelia_CurrencySwitcher_Widget::render_currency_selector($currency_selector_options);
		}
		else {
			// Prepare the text to use to display the order currency
			$order_currency_text = $order_currency;

			$currency_name = WC_Aelia_Currencies_Manager::get_currency_name($order_currency);
			// If a currency name is returned, append it to the code for displau.
			// If a currency name cannot be found, the method will return the currency
			// code itself. In such case, there would be no point in displaying the
			// code twice.
			if($currency_name != $order_currency) {
				$order_currency_text .= ' - ' . $currency_name;
			}

			echo '<h4 class="order-currency">';
			echo $order_currency_text;
			echo '</h4>';
		}
	}

	/**
	 * Indicates if we are on the Edit Subscription page.
	 *
	 * @param string action The action to check for ("edit" to check if we are
	 * modifying an existing order, or "add" to check if we are creating a new order).
	 * @return bool
	 * @since 1.3.8.171004
	 * @since WC 2.7
	 */
	protected function is_edit_subscription_page($action = 'edit') {
		if(!function_exists('get_current_screen')) {
			return false;
		}

		$screen = get_current_screen();

		return is_object($screen) && ($screen->post_type == 'shop_subscription') && ($screen->action === $action);
	}

	/**
	 * Returns the currency to be assigned to a subscription being created manually.
	 *
	 * @param string currency
	 * @return string
	 * @since 1.3.8.171004
	 */
	public function get_currency_for_manual_subscription($currency) {
		if(is_admin() && !defined('DOING_AJAX') && function_exists('get_current_screen')) {
			if($this->is_edit_subscription_page('add')) {
				$currency = null;
			}
			elseif($this->is_edit_subscription_page('edit')) {
				global $post;

				if($post->post_type == 'shop_subscription') {
					// Disable this filter temporarily, to prevent infinite recursion. This
					// is required due to changes in the admin pages in WooCommerce 2.7
					// @since WC 2.7
					remove_filter('woocommerce_currency', array($this, 'get_currency_for_manual_subscription'), 35, 1);
					$order_currency = $this->currency_switcher()->get_order_currency($post->ID);

					if(!empty($order_currency)) {
						$currency = $order_currency;
					}
					// Restore the filter
					add_filter('woocommerce_currency', array($this, 'get_currency_for_manual_subscription'), 35, 1);
				}
			}
		}
		return $currency;
	}

	/**
	 * Returns the currency of the subscription currently being displayed.
	 *
	 * @return string
	 * @since 1.3.8.171004
	 */
	protected function displayed_order_currency() {
		global $post;
		return $this->currency_switcher()->get_order_currency($post->ID);
	}

	/**
	 * Ensure that the JavaScript for the Edit Order page are also loaded on the
	 * Add/Edit Subscription page.
	 *
	 * @param bool should_load_scripts
	 * @param object post
	 * @return bool
	 * @since 1.3.11.180222
	 */
	public function wc_aelia_cs_load_order_edit_scripts($should_load_scripts, $post) {
		if(!$should_load_scripts) {
			$post_type = is_object($post) ? $post->post_type : null;
			$should_load_scripts = ($post_type === 'shop_subscription');
		}

		return $should_load_scripts;
	}

	/**
	 * Indicates if the product is on sale. A product is considered on sale if:
	 * - Its "sale end date" is empty, or later than today.
	 * - Its sale price in the active currency is lower than its regular price.
	 *
	 * @param WC_Product product The product to check.
	 * @param mixed sale_price The product's sale price. If null, the sale price
	 * is fetched by calling WC_Product::get_sale_price().
	 * @param mixed regular_price The product's regular price. If null, the regular price
	 * is fetched by calling WC_Product::get_regular_price().
	 * @return bool
	 * @since 1.3.12.180713
	 */
	protected function product_is_on_sale(WC_Product $product, $sale_price = null, $regular_price = null) {
		$sale_price_dates_from = $product->get_date_on_sale_from();
		$sale_price_dates_to = $product->get_date_on_sale_to();

		$is_on_sale = false;
		$today = current_time('timestamp', true);

		// An empty "from" date means that the sale is active right now,
		// until the "to" date.
		$from_valid = empty($sale_price_dates_from) || ($today >= $sale_price_dates_from->getTimestamp());
		// An empty "to" date means that the sale is active indefinitely,
		// starting from the "from"
		$to_valid = empty($sale_price_dates_to) || ($today < $sale_price_dates_to->getTimestamp());

		if($from_valid && $to_valid) {
			$sale_price = $sale_price !== null ? $sale_price : $product->get_sale_price();
			$regular_price = $regular_price !== null ? $regular_price : $product->get_regular_price();

			$is_on_sale = is_numeric($sale_price) && ($sale_price < $regular_price);
		}
		return $is_on_sale;
	}

	/**
	 * Converts a timestamp, or a date object, to the specified format.
	 *
	 * @param int|WC_Datetime date The date to convert.
	 * @param string format The target format.
	 * @return string The date as a string in YMD format.
	 * @since 1.3.12.180713
	 */
	protected function date_to_string($date, $format = 'Ymd') {
		if(empty($date)) {
			return '';
		}

		if(is_object($date) && ($date instanceof \WC_DateTime)) {
			return $date->format($format);
		}
		return date($format, $date);
	}

	/**
	 * Sets the active currency before the processing of a renewal. This will
	 * ensure that the correct currency settings, such as the number of decimals,
	 * will be used.
	 *
	 * @param int $subscription_id
	 * @since 1.4.8.190905
	 * @link https://aelia.freshdesk.com/a/tickets/23457
	 */
	public function woocommerce_scheduled_subscription_payment($subscription_id) {
		// Fetch the currency from the original subscription
		$subscription = wcs_get_subscription($subscription_id);

		// If the subscription ID is not valid, stop here
		// @since 1.6.0.220202
		if(!$subscription instanceof \WC_Subscription) {
			$this->subscription_renewal_currency = null;
			$this->log(sprintf(__('Invalid subscription ID passed with event "woocommerce_scheduled_subscription_payment". Subscription ID: %s',
				 										WC_Aelia_CS_Subscriptions::$text_domain), $subscription_id), false);
			return;
		}
		// Store the active currency to be used during a renewal
		$this->subscription_renewal_currency = $subscription->get_currency();

		add_filter('wc_aelia_cs_selected_currency', array($this, 'set_active_currency_for_renewal'), 999);
	}

	/**
	 * After a renewal has been paid, removes the filter that sets the active
	 * currency. This restores the active currency that was set previously.
	 *
	 * @param int $order_id
	 * @since 1.4.8.190905
	 * @link https://aelia.freshdesk.com/a/tickets/23457
	 */
	public function woocommerce_renewal_order_payment_complete($order_id) {
		// Reset the active currency to be used during a renewal
		$this->subscription_renewal_currency = null;
		remove_filter('wc_aelia_cs_selected_currency', array($this, 'set_active_currency_for_renewal'), 999);
	}

	/**
	 * Sets the active currency during the processing of a renewal
	 *
	 * @param string $currency
	 * @return string
	 * @since 1.4.8.190905
	 * @link set_active_currency_for_renewal
	 */
	public function set_active_currency_for_renewal($currency) {
		if(!empty($this->subscription_renewal_currency)) {
			$currency = $this->subscription_renewal_currency;
		}
		return $currency;
	}
}
