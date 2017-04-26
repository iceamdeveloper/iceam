<?php
namespace Aelia\WC\CurrencySwitcher\Bundles;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

use \WC_Aelia_CurrencySwitcher;
use \WC_Aelia_CurrencyPrices_Manager;
use \WC_Bundles;
use \WC_Bundles_Product;
use \WC_Product;
use \WC_Product_Bundle;

/**
 * Implements support for WooThemes Bundles plugin.
 *
 * @since 1.0.0.151213
 */
class Bundles_Integration {
	const FIELD_BASE_REGULAR_CURRENCY_PRICES = '_bundle_base_currency_prices';
	const FIELD_BASE_SALE_CURRENCY_PRICES = '_bundle_base_sale_currency_prices';

	// @var WC_Aelia_CurrencyPrices_Manager The object that handles Currency Prices for the Products.
	protected static $_currencyprices_manager;

	// @var WC_Aelia_CurrencySwitcher The Currency Switcher instance .
	protected static $_currency_switcher;

	// @var string The shop's base currency
	protected static $_base_currency;
	// @var string The active currency
	protected static $_selected_currency;

	/**
	 * Returns the instance of the Currency Switcher plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher
	 */
	protected static function cs() {
		if(empty(self::$_currency_switcher)) {
			self::$_currency_switcher = WC_Aelia_CurrencySwitcher::instance();
		}
		return self::$_currency_switcher;
	}

	/**
	 * Returns the instance of the currency prices manager class.
	 *
	 * @return WC_Aelia_CurrencyPrices_Manager
	 */
	protected static function currencyprices_manager() {
		if(empty(self::$_currencyprices_manager)) {
			self::$_currencyprices_manager = \WC_Aelia_CurrencyPrices_Manager::instance();
		}
		return self::$_currencyprices_manager;
	}

	/**
	 * Indicates if the WooCommerce version is greater or equal to the one passed
	 * as a parameter.
	 *
	 * @param string $comparison_operator The operator to use for version comparison.
	 * Any of the operators supported by the version_compare function can be used.
	 * @param string version The version to which WooCommerce version will be compare.
	 * @return bool The result of the version comparison.
	 * @link http://php.net/manual/en/function.version-compare.php
	 * @since 1.1.0.161211
	 */
	protected static function bundles_version_is($comparison_operator, $version) {
		return version_compare(WC_Bundles::instance()->version, $version, $comparison_operator);
	}

	/**
	 * Indicates if a bundle is priced on a per product basis.
	 *
	 * @param WC_Product product The bundle product to check.
	 * @return bool
	 * @since 1.1.0.161211
	 */
	protected function is_bundle_priced_individually($product) {
		// Bundles 5.0 and later
		return $product->contains('priced_individually');
	}

	/**
	 * Indicates if a cart item is bundled.
	 *
	 * @param array cart_item A cart item.
	 * @return bool
	 * @since 1.1.0.161211
	 */
	protected function is_bundled_cart_item($cart_item) {
		// Bundles 5.0 and later
		return wc_pb_is_bundled_cart_item($cart_item);
	}

	/**
	 * Returns a cart item's container product.
	 *
	 * @param array cart_item A cart item.
	 * @return bool
	 * @since 1.1.0.161211
	 */
	protected function get_bundled_cart_item_container($cart_item) {
		// Bundles 5.0 and later
		return wc_pb_get_bundled_cart_item_container($cart_item);
	}

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->set_hooks();
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
	 * Set the hooks required by the class.
	 */
	protected function set_hooks() {
		add_filter('wc_aelia_currencyswitcher_product_convert_callback', array($this, 'wc_aelia_currencyswitcher_product_convert_callback'), 10, 2);
		add_action('woocommerce_process_product_meta_bundle', array($this, 'woocommerce_process_product_meta_bundle'));

		add_filter('woocommerce_product_is_on_sale', array($this, 'woocommerce_product_is_on_sale'), 8, 2);

		// Ensure that bundled cart items have the correct price
		// @since 1.0.3.160326
		add_filter('woocommerce_add_cart_item', array( $this, 'woocommerce_add_cart_item'), 20, 2);

		// Admin UI
		// TODO Implement Admin UI for Bundles 4.x
		add_action('woocommerce_product_options_general_product_data', array($this, 'woocommerce_product_options_general_product_data'), 20);

		add_action('woocommerce_init', array($this, 'woocommerce_init'), 10);
	}

	/**
	 * Performs operations that need to be executed once WooCommerce is initialised.
	 *
	 * @since 1.1.0.161211
	 */
	public function woocommerce_init() {
		if(WC_Aelia_CS_Bundles_Plugin::is_frontend()) {
			add_action('woocommerce_bundles_synced_bundle', array($this, 'woocommerce_bundles_synced_bundle'), 10, 1);
		}
	}

	/**
	 * Returns the shop's base currency.
	 *
	 * @return string
	 */
	public static function base_currency() {
		if(empty(self::$_base_currency)) {
			self::$_base_currency = WC_Aelia_CurrencySwitcher::settings()->base_currency();
		}
		return self::$_base_currency;
	}

	/**
	 * Returns the active currency.
	 *
	 * @return string
	 */
	public function selected_currency() {
		if(empty(self::$_selected_currency)) {
			self::$_selected_currency = self::cs()->get_selected_currency();
		}
		return self::$_selected_currency;
	}

	/**
	 * Converts all the prices of a given product in the currently selected
	 * currency.
	 *
	 * @param WC_Product product The product whose prices should be converted.
	 * @return WC_Product
	 */
	protected function convert_product_prices($product) {
		$selected_currency = self::selected_currency();
		$base_currency = self::base_currency();

		if(empty($product->currency) || ($product->currency != $selected_currency)) {
			$product = self::currencyprices_manager()->convert_product_prices($product, $selected_currency);
			$product->currency = $selected_currency;
		}

		return $product;
	}

	/**
	 * Callback to perform the conversion of bundle prices into selected currencu.
	 *
	 * @param callable $convert_callback A callable, or null.
	 * @param WC_Product The product to examine.
	 * @return callable
	 */
	public function wc_aelia_currencyswitcher_product_convert_callback($convert_callback, $product) {
		$method_keys = array(
			'WC_Product_Bundle' => 'bundle',
		);

		// Determine the conversion method to use
		$method_key = get_value(get_class($product), $method_keys, '');
		$convert_method = 'convert_' . $method_key . '_product_prices';

		if(!method_exists($this, $convert_method)) {
			return $convert_callback;
		}
		return array($this, $convert_method);
	}

	/**
	 * Converts a timestamp, or a date object, to the YMD format.
	 *
	 * @param int|WC_Datetime date The date to convert.
	 * @return string The date as a string in YMD format.
	 * @since 1.2.1.170414
	 */
	protected function date_to_string($date) {
		if(empty($date)) {
			return '';
		}

		if(is_object($date) && ($date instanceof \WC_DateTime)) {
			return $date->format('Ymd');
		}
		return date('Ymd', $date);
	}

	/**
	 * Returns the regular price of a bundle.
	 *
	 * @param WC_Product_Bundle product A product bundle.
	 * @param string context
	 * @return float The bundle price.
	 * @since 1.2.2.170415
	 */
	protected function get_bundle_regular_price($product, $context = 'view') {
		if($this->bundles_version_is('<', '5.2')) {
			return $product->get_bundle_regular_price('min');
		}

		return $product->get_min_raw_regular_price($context);
	}

	/**
	 * Indicates if the product is on sale. A product is considered on sale if:
	 * - Its "sale end date" is empty, or later than today.
	 * - Its sale price in the active currency is lower than its regular price.
	 *
	 * @param WC_Product product The product to check.
	 * @return bool
	 */
	protected function bundle_is_on_sale(WC_Product $product) {
		if(aelia_wc_version_is('>=', '3.0')) {
			// WC 3.0.1 and later return dates as a WC_DateTime object, and they must
			// be converted to a string format for easier comparison
			$sale_price_dates_from = $this->date_to_string($product->get_date_on_sale_from());
			$sale_price_dates_to = $this->date_to_string($product->get_date_on_sale_to());
		}
		else {
			$sale_price_dates_from = $product->base_sale_price_dates_from;
			$sale_price_dates_to = $product->base_sale_price_dates_to;
		}

		$today = date('Ymd');
		$is_on_sale = false;
		if((empty($sale_price_dates_from) ||
				$today >= date('Ymd', $sale_price_dates_from)) &&
			 (empty($sale_price_dates_to) ||
				date('Ymd', $sale_price_dates_to) > $today)) {

			// Bundles 5.1 uses the standard product methods to retrieve product
			// prices
			// @since 1.2.0.161222
			$sale_price = $product->get_sale_price();
			$regular_price = $product->get_regular_price();

			$is_on_sale = is_numeric($sale_price) && ($sale_price < $regular_price);
			// Additional logic for Bundles 5.0 and later
			if(!$is_on_sale) {
				$is_on_sale = ($product->contains('discounted_mandatory') && $this->get_bundle_regular_price($product) > 0);
			}
		}
		return $is_on_sale;
	}

	/**
	 * Recalculates bundle's prices, based on selected currency.
	 *
	 * @param WC_Product_Bundle product The bundle whose prices will be converted.
	 */
	protected function convert_bundle_base_prices(WC_Product_Bundle $product, $currency) {
		$prices_manager = self::currencyprices_manager();

		$shop_base_currency = self::base_currency();
		$product_id = aelia_get_product_id($product);
		$product_base_currency = $prices_manager->get_product_base_currency($product_id);

		// Load product's base prices in each currency
		$bundle_base_regular_prices_in_currency = $prices_manager->get_product_regular_prices($product_id);
		$bundle_base_sale_prices_in_currency = $prices_manager->get_product_sale_prices($product_id);

		// Since Bundles 5.1, the regular price in base currency is saved in a
		// separate meta.
		// @since 1.2.0.161222
		// @since Bundles 5.1
		$bundle_base_regular_prices_in_currency[$shop_base_currency] = get_post_meta($product_id, '_wc_pb_base_regular_price', true);
		$bundle_base_sale_prices_in_currency[$shop_base_currency] = get_post_meta($product_id, '_wc_pb_base_sale_price', true);

		// Take regular price in the specific product base currency
		$product_base_regular_price = get_value($product_base_currency, $bundle_base_regular_prices_in_currency);
		// If a regular price was not entered for the selected product base currency,
		// take the one in shop base currency
		if(!is_numeric($product_base_regular_price)) {
			$product_base_regular_price = get_value($shop_base_currency, $bundle_base_regular_prices_in_currency);

			// If a product doesn't have a price in the product-specific base currency,
			// then that base currency is not valid. In such case, shop's base currency
			// should be used instead
			$product_base_currency = $shop_base_currency;
		}

		// Take sale price in the specific product base currency
		$product_base_sale_price = get_value($product_base_currency, $bundle_base_sale_prices_in_currency);
		// If a sale price was not entered for the selected product base currency,
		// take the one in shop base currency
		if(!is_numeric($product_base_sale_price)) {
			$product_base_sale_price = get_value($shop_base_currency, $bundle_base_sale_prices_in_currency);
		}

		$product->base_regular_price = get_value($currency, $bundle_base_regular_prices_in_currency);
		if(($currency != $product_base_currency) && !is_numeric($product->base_regular_price)) {
			$product->base_regular_price = $prices_manager->convert_product_price_from_base($product_base_regular_price, $currency, $product_base_currency, $product, 'regular_price');
		}

		$product->base_sale_price = get_value($currency, $bundle_base_sale_prices_in_currency);
		if(($currency != $product_base_currency) && !is_numeric($product->base_sale_price)) {
			$product->base_sale_price = $prices_manager->convert_product_price_from_base($product_base_sale_price, $currency, $product_base_currency, $product, 'sale_price');
		}

		// Bundles 5.1 uses the standard price properties, instead of the base ones.
		// The logic to determine their value remains the same, so we can simply
		// copy them from the "base price" properties.
		// @since 1.2.0.161222
		// @since Bundles 5.1
		$product->regular_price = $product->base_regular_price;
		$product->sale_price = $product->base_sale_price;

		if(is_numeric($product->base_sale_price) &&
			 $this->bundle_is_on_sale($product)) {
			$product->base_price = $product->base_sale_price;
		}
		else {
			$product->base_price = $product->base_regular_price;
		}
		$product->price = $product->base_price;

		if(aelia_wc_version_is('>=', '3.0')) {
			// Set prices against the product, so that other actors can fetch them as well
			// @since 1.2.1.170414
			$product->set_regular_price($product->regular_price);
			$product->set_sale_price($product->sale_price);
			$product->set_price($product->price);
		}

		//// Debug
		//var_dump(
		//	$bundle_base_regular_prices_in_currency,
		//	"BASE CURRENCY $product_base_currency",
		//	"BASE REGULAR PRICE {$product->base_regular_price}",
		//	"BASE SALE PRICE {$product->base_sale_price}",
		//	"BASE PRICE {$product->base_price}"
		//);

		return $product;
	}

	/**
	 * Converts the prices of a bundle product to the specified currency.
	 *
	 * @param WC_Product_Bundle product A variable product.
	 * @param string currency A currency code.
	 * @return WC_Product_Bundle The product with converted prices.
	 */
	public function convert_bundle_product_prices(WC_Product_Bundle $product, $currency) {
		if($this->is_bundle_priced_individually($product)) {
			$this->convert_bundle_base_prices($product, $currency);
		}
		else {
			$product = self::currencyprices_manager()->convert_simple_product_prices($product, $currency);

		}

		return $product;
	}

	/**
	 * Determines if a bundle is on sale.
	 *
	 * @param bool is_on_sale
	 * @param WC_Product product
	 * @return bool
	 * @since 1.1.1.161219
	 */
	public function woocommerce_product_is_on_sale($is_on_sale, $product) {
		if(!$is_on_sale && $product->is_type('bundle')) {
			$is_on_sale = $this->bundle_is_on_sale($product);
		}
		return $is_on_sale;
	}

	/*** Manual pricing of bundles ***/
	/**
	 * Returns the path where the Admin Views can be found.
	 *
	 * @return string
	 */
	protected function admin_views_path() {
		return WC_Aelia_CS_Bundles_Plugin::plugin_path() . '/views/admin';
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
	 * Event handler fired when a bundle is being saved. It processes and
	 * saves the Currency Prices associated with the bundle.
	 *
	 * @param int post_id The ID of the Post (bundle) being saved.
	 */
	public function woocommerce_process_product_meta_bundle($post_id) {

		//// Copy the currency prices from the fields dedicated to the variation inside the standard product fields
		//$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_REGULAR_CURRENCY_PRICES] = $_POST[self::FIELD_REGULAR_CURRENCY_PRICES];
		//$_POST[WC_Aelia_CurrencyPrices_Manager::FIELD_SALE_CURRENCY_PRICES] = $_POST[self::FIELD_SALE_CURRENCY_PRICES];

		self::currencyprices_manager()->process_product_meta($post_id);
	}

	/**
	 * Alters the view used to allow entering prices manually, in each currency.
	 *
	 * @param string file_to_load The view/template file that should be loaded.
	 * @return string
	 */
	public function woocommerce_product_options_general_product_data() {
		//$this->load_view('simplebundle_currencyprices_view.php');
	}

	/**
	 * When a bundle is static-priced, the price of all bundled items is set to 0.
	 *
	 * @param array cart_item  Cart item data.
	 * @param  string cart_key  Cart item key.
	 * @return array The cart item data, with prices eventually set to zero.
	 * @since 1.0.3.160326
	 */
	public function woocommerce_add_cart_item($cart_item, $cart_key) {
		if($this->is_bundled_cart_item($cart_item)) {
			if($bundle_container_item = $this->get_bundled_cart_item_container($cart_item)) {
				$bundle = $bundle_container_item['data'];
				$bundled_item_id = $cart_item['bundled_item_id'];

				// If the cart item is as bundled product, and the bundle is NOT priced
				// on a per-product basis, then the cart item's price has to be set to
				// zero (the parant bundle's price is what matters, in this case)
				if($bundle->has_bundled_item($bundled_item_id) &&
					 !$this->is_bundle_priced_individually($bundle)) {
					$cart_item[ 'data' ]->regular_price = 0;
					$cart_item[ 'data' ]->price = 0;
					$cart_item[ 'data' ]->sale_price = '';
				}
			}
		}
		return $cart_item;
	}

	/**
	 * Converts the prices of a bundle after it has been synchronised with the
	 * underlying data and bundled items.
	 *
	 * @param WC_Bundle product A bundle product.
	 * @since 1.1.0.161211
	 */
	public function woocommerce_bundles_synced_bundle($product) {
		$this->convert_bundle_product_prices($product, get_woocommerce_currency());

		// Prevent overwriting product meta with the result of the conversions
		// @since 1.2.0.161222
		// @since Bundles 5.1
		add_filter('woocommerce_bundles_update_price_meta', '__return_false');
	}
}
