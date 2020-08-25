=== WooCommerce Currency Switcher - Dynamic Pricing Integration ===
Tags: woocommerce, currency switcher, dynamic-pricing, integration, dynamic pricing
Requires at least: 3.6
Tested up to: 5.5
License: GPLv3
WC requires at least: 2.6
WC tested up to: 4.4

Implements the integration between [Aelia Currency Switcher](https://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Dynamic Pricing plugin](https://www.woothemes.com/products/woocommerce-dynamic-pricing/).

== Description ==
This plugin is a temporary workaround for the lack of multi-currency support in the Dynamic Pricing plugin. It acts as a bridge between [Aelia Currency Switcher](https://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Dynamic Pricing plugin](http://www.woothemes.com/products/woocommerce-dynamic-pricing/), ensuring that Dynamic Pricing prices are converted correctly into the currency being used to place an order.

= Requirements =

* PHP 5.4 or newer.
* WordPress 4.7 or newer.
* WooCommerce 2.6.x to 3.6.x
* Aelia Currency Switcher 4.4.6.170120 or newer.
* WooCommerce Dynamic Pricing (by Brent Shepherd) 3.17 or newer.
* Free [Aelia Foundation Classes plugin for WooCommerce](https://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.8.3.170202 or newer.

== Installation ==
1. Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it! Now the price of the Dynamic Pricing you enter will be converted automatically in the appropriate currency.

== Changelog ==

= 1.0.7.200813 =
* Updated supported WordPress and WooCommerce versions.

= 1.0.7.200625 =
* Updated supported WooCommerce versions.

= 1.0.7.200603 =
* Updated supported WooCommerce versions.

= 1.0.6.200428 =
* Updated requirement checking class.
* Updated requirements.
* Updated supported WooCommerce versions.

= 1.0.5.190426 =
* Tweak - Improved compatibility with Dynamic Pricing plugin 3.1.13 and later.
* Tweak - Updated logic to handle automatic updates.
* Updated supported WooCommerce versions.

= 1.0.4.181213 =
* Updated supported WooCommerce version.
* Updated supported Dynamic Pricing plugin version.

= 1.0.3.180713 =
* Fix - Fixed display of individual variation prices in WC 3.4 and later.

= 1.0.2.171106 =
* Tweak - Added logic to handle discounts that use commas as the decimal separator.

= 1.0.1.170710 =
* Fix - Fixed display of variable product price range in Dynamic Pricing 3.0.7 and later.

= 1.0.0.170123 =
* First release.
