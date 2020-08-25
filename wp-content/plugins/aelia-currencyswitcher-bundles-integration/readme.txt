=== WooCommerce Currency Switcher - Bundles Integration ===
Tags: woocommerce, currency switcher, bundles, integration
Requires at least: 4.0
Tested up to: 5.5
License: GPLv3
WC requires at least: 3.0
WC tested up to: 4.4

Implements integration between the [Aelia Currency Switcher](http://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Bundles plugin](http://www.woothemes.com/products/woocommerce-bundles/).

== Description ==
This plugin acts as a bridge between [Aelia Currency Switcher](http://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Bundles plugin](http://www.woothemes.com/products/woocommerce-bundles/), ensuring that Bundles prices are converted correctly into the currency being used to place an order.

= Requirements =

* PHP 5.3+
* WordPress 3.6+
* WooCommerce 3.0.x or newer.
* Aelia Currency Switcher 3.8.14.151214 or or newer.
* WooCommerce Bundles (by SomewhereWarm) 5.10 or newer.
* [AFC plugin for WooCommerce](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.6.7.150910 or later.

== Installation ==
1. Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it! Now the price of the Bundles you enter will be converted automatically in the appropriate currency.

== Changelog ==

= 1.2.7.200813 =
* Updated supported WordPress and WooCommerce versions.

= 1.2.7.200625 =
* Updated supported WooCommerce versions.

= 1.2.7.200603 =
* Updated supported WooCommerce versions.

= 1.2.6.200428 =
* Updated requirement checking class.
* Updated requirements.
* Updated supported WooCommerce versions.

= 1.2.5.200205 =
* Tweak - Added extra check to prevent double conversion of a  bundle's base price, in case the conversion function is called multiple times.
* Updated supported WooCommerce versions.

= 1.2.4.190703 =
* Tweak - Improved compatibility with Currency Switcher 4.7.5.190628 and newer.
* Tweak - Updated logic to handle automatic updates.
* Updated supported WooCommerce versions.

= 1.2.3.171201 =
* Improved compatibility with Bundles 5.6.1.
	* Improved logic used to prevent the Bundles plugin from storing the converted prices agains bundles' meta.

= 1.2.2.170415 =
* Improved compatibility with Bundles 5.2.
	* Altered logic to determine a bundle's regular price to work correctly in Bundles 5.1 and 5.2.

= 1.2.1.170414 =
* Improved compatibility with WooCommerce 3.0.x.
* Improved compatibility with Bundles 5.2.

= 1.2.1.170108 =
* Improved compatibility with WooCommerce 2.7.
	* Added logic to acces product properties using the appropriate methods.
* Improved compatibility with Bundles 5.1.x:
	* Removed unneeded filters.

= 1.2.0.161222 =
* Improved compatibility with Bundles 5.1.x:
	* Improved support for the new logic used to calculate bundles' base prices.

= 1.1.1.161219 =
* Improved compatibility with Bundles 5.0.x:
	* Improved logic to determine if a bundle is on sale.

= 1.1.0.161211 =
* Added compatibility with Bundles 5.0.x:
	* Added support for bundles' base prices.

= 1.0.3.160326 =
* Fixed bug with statically priced bundles, caused by Bundler 4.3.13. A new logic added to the Bundles plugin added a breaking change and it treats bundled products as normal cart items. This causes their prices to be added to the cart total even when bundles are configured to use static (i.e. non "per product" pricing).

= 1.0.2.160223 =
* Fixed bug in requirement checking logic. The bug triggered a warning message in the admin section, and it was caused by an incorrect plugin name.

= 1.0.1.151214 =
* Fixed bug in conversion of bundles' base prices.

= 1.0.0.151213 =
* First release.

