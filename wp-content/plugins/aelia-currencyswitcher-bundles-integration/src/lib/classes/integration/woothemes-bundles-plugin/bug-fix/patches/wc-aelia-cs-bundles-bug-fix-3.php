<?php
namespace Aelia\WC\CurrencySwitcher\Bundles\Bug_Fixes\Patches;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

use Aelia\WC\CurrencySwitcher\Bundles\Bug_Fixes\IBug_Fix;

/**
 * Bug fix FOR THE BUNDLES PLUGIN (not the Currency Switcher), which causes a double discount
 * to be applied to prices of bundled variations on the product details page.
 *
 * @since 1.3.2.2201011
 */
class Bug_Fix_3 implements IBug_Fix {
	public function apply_bug_fix(): void {
		// Allow 3rd parties to enable or disable the bug fix programmatically
		// @since 1.3.2.2201011
		if(!apply_filters('wc_aelia_cs_bundles_addon_enable_bug_fix_3', '__return_true')){
			return;
		}

		// @since 1.3.2.2201011
		// @link https://bitbucket.org/businessdad/currency-switcher-bundles-integration/issues/3
		// @link https://aelia.freshdesk.com/a/tickets/97368
		// @link https://aelia.freshdesk.com/a/tickets/97353
		add_filter('woocommerce_variation_prices_price', [$this, 'woocommerce_variation_prices_price_before'], 0, 3);
		add_filter('woocommerce_variation_prices_price', [$this, 'woocommerce_variation_prices_price_after'], PHP_INT_MAX, 3);
	}

	/**
	 * Disable the discount calculation in the Product Bundles plugin for the variation durign the
	 * execution of filter "woocommerce_variation_prices_price", which might trigger filter
	 * "woocommerce_product_variation_get_price". The discount will be applied by filter
	 * "woocommerce_variation_prices".
	 *
	 * @param float price The original variation price.
	 * @param WC_Product_Variation variation The variation to which the price belongs.
	 * @param WC_Product_Variable The parent product to which the variation belongs.
	 * @return float The variation price, unaltered.
	 * @since @link https://bitbucket.org/businessdad/currency-switcher-bundles-integration/issues/3
	 * @link https://aelia.freshdesk.com/a/tickets/97368
	 * @link https://aelia.freshdesk.com/a/tickets/97353
	 */
	public function woocommerce_variation_prices_price_before($price, $variation, $parent_product) {
		remove_filter('woocommerce_product_variation_get_price', ['WC_PB_Product_Prices', 'filter_get_price'], 15, 2);
		return $price;
	}

	/**
	* Restore the discount calculation in the Product Bundles plugin after the execution of filter
	* "woocommerce_variation_prices_price".
	*
	 * @param float price The original variation price.
	 * @param WC_Product_Variation variation The variation to which the price belongs.
	 * @param WC_Product_Variable The parent product to which the variation belongs.
	 * @return float The variation price, unaltered.
	 * @see Bug_Fix_3::woocommerce_variation_prices_price_before()
	 */
	public function woocommerce_variation_prices_price_after($price) {
		add_filter('woocommerce_product_variation_get_price', ['WC_PB_Product_Prices', 'filter_get_price'], 15, 2);
		return $price;
	}
}
