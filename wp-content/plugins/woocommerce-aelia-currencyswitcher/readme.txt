=== WooCommerce Currency Switcher ===
Tags: aelia, woocommerce, currency switcher, multiple currencies
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8ND89AA8B8QJ
Requires at least: 3.6
Tested up to: 4.9
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 2.4
WC tested up to: 3.4.4

Currency Switcher for WooCommerce allows your shop to display prices and accept payments in multiple currencies. This will grant your customers the possibility of shopping in their favourite currency, thus increasing conversions.

== Description ==

The Currency Switcher will allow you to configure a list of the currencies you would like to accept. Such currencies will then appear in a list, displayed as a widget, which your Users can use to choose their preferred currency. When a customer selects a currency, the shop will be both displaying prices and completing transactions in the new currency. The prices displayed on the shop will be the ones that the customer will pay upon completing the order.

Increase conversion by cutting credit card fees
Credit Card operators often charge a conversion fee when a payment is made in a currency different from the one for which the card was issued. This adds an extra cost on every purchase, and it can discourage prospective customers. Giving your Visitors the possibility of paying in their currency can help improving conversion.

Every order will store the currency used to place it, so that both Shop Managers and customers will be able to retrieve it and see how much they paid.

Important: Your ability to accept payment in each currency will depend on your payment gateway and/or payment processing company.

The Currency Switcher for WooCommerce includes GeoLite data created by MaxMind, available from http://www.maxmind.com.
== Requirements ==

* WordPress 4.0 or newer.
* PHP 5.3 or newer.
* WooCommerce 2.6.x to 3.5.x.
* **Free** [Aelia Foundation Classes framework](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 2.0.1.180821 or newer (the plugin can install the framework automatically).

== Installation ==

1. Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Follow the instructions in our knowledge base to configure the Currency Switcher: [Aelia Currency Switcher - Getting Started](https://aelia.freshdesk.com/solution/articles/3000063641-aelia-currency-switcher-getting-started).

== Support ==
The Currency Switcher is backed by a top class support service, as well as a knowledge base to help you getting the best out of it. You can find them both here: [Currency Switcher - Support Portal](https://aelia.freshdesk.com/support/solutions/120257).

==  Changelog ==

= 4.6.6.181004 =
* Updated supported WooCommerce versions.

= 4.6.5.180828 =
* Feature - Added support for exchange rate markups expressed as a percentage (e.g. "10%").

= 4.6.4.180827 =
* Updated requirements. The plugin now requires Aelia Foundation Classed 2.0.1.180821 or newer.

= 4.6.3.180821 =
* Feature - Added order net total in base currency next to the order total, in Orders List page.
* Tweak - Changed minimum requirements to WooCommerce 2.6

= 4.6.2.180725 =
* Tweak - Implemented "lazy load" of exchange rates provider models. This is to allow 3rd parties to hook into the logic and add their own models.
* Tweak - Removed warnings when the price properties expected by the Currency Switcher are not found.

= 4.6.1.180716 =
* Fix - Fixed bug that caused the exchange rates settings to be lost after removing a currency.

= 4.6.0.180628 =
* Tweak - Implemented workaround to prevent the Memberships plugin from triggering notices during the conversion of product prices.
* Tweak - Added logic to ensure that shipping costs are calculated with the correct amount of decimals, before they are converted.

= 4.5.19.180608 =
* Fix - Set currency for Latvia to EUR.

= 4.5.18.180529 =
* Updated supported WooCommerce version.

= 4.5.18.180417 =
* Fix - Fixed logic used to save the order currency for manual orders.

= 4.5.17.180404 =
* Fix - Fixed display of variation prices on variable product pages.
* Fix - Fixed active currency when saving order meta.

= 4.5.16.180307 =
* Tweak - Removed redundant logger class and optimised logging logic.
* Fix - Fixed name of `<select>` field in the currency selector widget.
* Feature - Added new filter `wc_aelia_cs_force_currency_by_country`.

= 4.5.15.180222 =
* Tweak - Added new filter `wc_aelia_cs_load_order_edit_scripts`.

= 4.5.14.180122 =
* Fix - Removed notice with Grouped Products.
* Improvement - Added admin message to inform merchants that Yahoo! Finance has been discontinued.

= 4.5.13.180118 =
* Update - Discountinued Yahoo! Finance provider.
* Feature - Added interface with OFX exchange rates service.
* Feature - Added new filter `wc_aelia_cs_exchange_rates_models`.

= 4.5.12.171215 =
* Fix - Fixed bug that sometimes caused an infinite loop when processing refunds on WooCommerce 3.2.5 and newer.

= 4.5.11.171210 =
* Fix - Fixed logic used to collect refund data for reports.

= 4.5.10.171206 =
* Improvement - Improved performance of the logic used to handle variable products.

= 4.5.9.171204 =
* Tweak - Improved compatibility of geolocation logic with WooCommerce 3.2.x.

= 4.5.8.171127 =
* Fix - Fixed integration with BE Table Rates Shipping plugin, to ensure the conversion of "subtotal" thresholds.

= 4.5.7.171124 =
* Fix - Fixed "force currency by country" logic. The new logic makes sure that the "currency by country" takes priority over other selections.
* Improvement - Refactored logic used to show error messages related to the currency selector widget.
* Tweak - Added warning in the currency selector widget when the "force currency by country" option is enabled, to inform the site administrators that the manual currency selection has no effect.

= 4.5.6.171120 =
* Fix - Fixed pricing filter in WooCommerce 3.2.4. The filter range was no longer converted, due to an undocumented breaking change in WooCommerce.

= 4.5.5.171114 =
* Tweak - Added check to prevent the "force currency by country" option from interfering with the manual creation of orders.
* Tweak - Added possibility to specify the currency to be used during Admin operations, such as Edit Order.

= 4.5.4.171109 =
* Tweak - Applied further optimisations to the installation process, to make it run in small steps and minimise the risk of timeouts.

= 4.5.3.171108 =
* Tweak - Improved compatibility of installation process with WP Engine and other managed WP hosts. The process now runs step by step, reducing the chance of timeouts and 502 errors.

= 4.5.2.171019 =
* Tweak - Improved settings page to make it clearer that the Open Exchange Rates service requires an API key.

= 4.5.1.171012 =
* Fix - Removed notice related to the conversion of shipping in WooCommerce 3.2.

= 4.5.1.170912 =
* Fix - Improved logic used to ensure that minicart is updated when the currency changes, to handle the new "hashed" cart fragment IDs.

= 4.5.0.170901 =
* Improved compatibility with WooCommerce 3.2:
	* Altered conversion of shipping costs and thresholds to support the new logic in WC 3.2.

= 4.4.21.170830 =
* Fixed conversion of shipping costs in WooCommerce 3.1.2.

= 4.4.20.170807 =
* Fixed display of coupon amounts in the WooCommerce > Coupons admin page.

= 4.4.19.170602 =
* Feature - New `wc_aelia_cs_get_product_base_currency` filter.

= 4.4.18.170517 =
* Improved compatibility with WooCommerce 3.0.x:
	* Removed legacy code that could trigger a warning.

= 4.4.17.170512 =
* Improved compatibility with WooCommerce 3.0.x:
	* Added workaround to issue caused by the new CRUD classes always returning a currency value, even when the order has none associated.

= 4.4.16.170424 =
* Improved compatibility with WooCommerce 3.0.x:
	* Fixed handling of coupons. Altered logic to use the new coupon hooks.
* Fixed issue of stale data displayed in the mini-cart. Added logic to refresh the mini-cart when the currency is selected via the URL.

= 4.4.15.170420 =
* Improved compatibility with WooCommerce 3.0.3:
	* Added logic to ensure that orders are created in the correct currency in the backend.
* Improved backward compatibility of requirement checking class. Added check to ensure that the parent constructor exists before calling it.

= 4.4.14.170415 =
* Improved performance of reports and dashboard.

= 4.4.13.170408 =
* Fixed bug in logic used to retrieve exchange rates. When the configured exchange rate provider could not be determined, the original logic tried to load an invalid class.
* Set default provider to Yahoo! Finance, to replace the unreliable WebServiceX.

= 4.4.12.170407 =
* Improved compatibility with WooCommerce 3.0.1:
	* Fixed bug caused by WooCommerce 3.0.1 returning dates as objects, instead of timestamps.

= 4.4.11.170405 =
* Improved compatibility with WooCommerce 3.0:
	* Fixed deprecation notice in Edit Order page.
* Fixed logic used to retrieve customer's country when the "force currency by country" option is active.

= 4.4.10.170316 =
* Added new filter `wc_aelia_currencyswitcher_product_base_currency`.
* Changed permission to access the Currency Switcher options to "manage_woocommerce".

= 4.4.9.170308 =
* Fixed minor warning on Product Edit pages.

= 4.4.8.170306 =
* Improved compatibility with WooCommerce 2.7:
	* Replaced call to `WC_Customer::get_country()` with `WC_Customer::get_billing_country()` in WC 2.7 and newer.
* Updated requirement checking class.
* Improved user experience. Added links and information to configure the Currency Switcher.
* Improved Admin UI. Added possibility to sort the currencies from the Currency Switcher Admin page.

= 4.4.8.170210 =
* Improved compatibility with WooCommerce 2.7 and 3rd party plugins:
	* Improved currency conversion logic to prevent affecting plugins that use `$product->set_price()` to override a product price.

= 4.4.7.170202 =
* Improved compatibility with WooCommerce 2.7:
	* Fixed infinite recursion caused by the premature loading of order properties in the new DataStore class.
	* Added caching of orders, for optimised performance.
* Removed obsolete code.
* Improved logic to determine if a product is on sale. The new logic can fix incompatibility issues with 3rd party plugins, such as Bundles.

= 4.4.6.170120 =
* Optimised performance of logic used for conversion of product prices.
* Removed integration with Dynamic Pricing plugin. The integration has been moved to a separate plugin.

= 4.4.5.170118 =
* Updated integration with BE Table Rates Shipping plugin.

= 4.4.2.170117 =
* Improved logger. Replaced basic WooCommerce logger with the more flexible Monolog logger provided by the AFC.

= 4.4.1.170108 =
* Improved compatibility with WooCommerce 2.7:
	* Refactored currency conversion logic to follow the new guidelines.
	* Replaced obsolete filters.
	* Added support for the new logic for the conversion of variable products.
