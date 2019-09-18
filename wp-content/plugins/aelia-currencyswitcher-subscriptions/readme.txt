=== WooCommerce Currency Switcher - Subscriptions Integration ===
Tags: woocommerce, currency switcher, subscriptions, integration
Requires at least: 3.6
Tested up to: 5.2
icense: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 3.0
WC tested up to: 3.7.0

Implements the integration between [Aelia Currency Switcher](http://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Subscriptions plugin](http://www.woothemes.com/products/woocommerce-subscriptions/).

== Description ==
This plugin acts as a bridge between [Aelia Currency Switcher](http://aelia.co/shop/currency-switcher-woocommerce/) and [WooCommerce Subscriptions plugin](http://www.woothemes.com/products/woocommerce-subscriptions/), ensuring that Subscriptions prices are converted correctly into the currency being used to place an order.

== Requirements ==

* PHP 5.3 or newer.
* WordPress 3.6 or newer.
* WooCommerce 3.0.x or newer.
* Aelia Currency Switcher 4.4.7.170202 or newer
* WooCommerce Subscriptions (by Brent Shepherd) 2.2 or newer.
* [AFC plugin for WooCommerce](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.7.5.160722 or newer.

== Installation ==

1. Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it! Now the price of the Subscriptions you enter will be converted automatically in the appropriate currency.

== Support ==

This is a free plugin, and it's provided as is, without explicit or implicit guarantees, and it's not covered by the support service provided for premium Aelia plugins.
Should you need assistance, please feel free to [contact us](https://aelia.co/contact) andto avail of our paid support service (standard charges apply).

== Changelog ==

= 1.4.7.190828 =
* Fix - Fixed glitch that caused a product's base currency to be overwritten by the one introduced by this integration addon.

= 1.4.6.190807 =
* Tweak - Handled edge case which caused the upgrade price of a subscription to be returned as zero.

= 1.4.6.190706 =
* Fix - Fixed bug that prevented the subscription price from being converted in some cases.

= 1.4.5.190703 =
* Tweak - Added workaround to prevent conflicts with other plugins while returning product prices in currency.

= 1.4.4.190630 =
* Tweak - Improved UI to enter prices in Edit Product page.
* Tweak - Updated logic to handle automatic updates.
* Fix - Fixed issue that caused a variable subscription to become unavailable when one variation didn't have a price.

= 1.4.2.181217 =
* Tweak - Altered CSS for Edit Product page, to restore the size of price fields.

= 1.4.1.181124 =
* Fix - Updated "product is on sale" check, to take into account the time zone.

= 1.4.0.181107 =
* Tweak - Improved support for Currency Switcher's "product base currency" feature.
* Tweak - Replaced README.md with readme.txt.

= 1.3.12.180713 =
* Fix - Removed notices that appeared when the integration logic tried to check if a product is on sale.

= 1.3.11.180222 =
* Fix - Added logic to ensure that the product prices are loaded in the correct currency on the Edit Subscription page.

= 1.3.10.180218 =
* Fix - Added check to ensure that the sign up fees returned to the Subscriptions plugin are numeric.

= 1.3.9.171109 =
* Fix - Fixed typo and invalid reference to the Currency Switcher instance on Edit/Create Order pages.

= 1.3.8.171004 =
* Tweak - Improved support for the selection of the currency during the manual creation of subscriptions.

= 1.3.7.170607 =
* Improved compatibility with Subscriptions 2.2.7.
	* Fixed display of "From" price for variable subscriptions.

= 1.3.6.170531 =
* Improved compatibility with Subscriptions 2.2.7.
	* Fixed handling of subscription switching. Thanks to Mr. T.Steur for the contribution.

= 1.3.5.170425 =
* Improved compatibility with Subscriptions 2.2.5.
	* Fixed handling of subscriptions sale prices.

= 1.3.4.170422 =
* Refactored logic used to calculate final subscription price. The new logic fixes the conversion in calls to static method WC_Subscriptions_Product::get_price_string() and the new functions `wcs_get_price_including_tax` and `wcs_get_price_excluding_tax`.

= 1.3.3.170413 =
* Fixed logic handling renewals and resubscriptions.

= 1.3.2.170405 =
* Fixed logic used to determine when product prices should be triggered.

= 1.3.1.170405 =
* Improved compatibility with WooCommerce 3.0 and Subscription 2.2.
	* Altered conversion logic to ensure that subscription prices are converted correctly.
	* Updated requirements.

= 1.3.0.160617 =
* Added handling of new exceptions introduced in WooCommerce 2.6. The new logic prevents WooCommerce from throwing a fatal error when an orphaned product variation is found.

= 1.2.14.151215 =
* Fixed bug in saving of variations with WooCommerce 2.4 and Subscriptions 2.0. The bug prevented the variations from being saved, in some circumstances.

= 1.2.13.151208 =
* Added workaround for bug #1040 of Subscriptions plugin. The bug caused the wrong currency to be used at checkout for subscription renewals. See  https://github.com/Prospress/woocommerce-subscriptions/issues/1040.
* Passed product price type to `convert_product_price_from_base()` call.

= 1.2.12.151109 =
* Updated requirements.
* Fixed call to conversion logic for product prices. The new call triggers a filter that can be used to round product prices.
* Fixed loading of Messages controller. The controller now uses the correct tex domain.

= 1.2.11.150910 =
* Updated download link for Aelia Foundation Classes.

= 1.2.10.150824 =
* Fixed bug in update checking logic.
* Updated requirement checking class.

= 1.2.9.150815 =
* Improved support for WooCommerce 2.4:
	* Fixed issue caused by the caching logic used to handle variations in WooCommerce 2.4.3.

= 1.2.8.141010 =
* Changed links to point to new website at [http://aelia.co](http://aelia.co).

= 1.2.7.141008 =
* Removed debug message.

= 1.2.6.140820 =
* Fixed minor bugs in user interface:
	* Removed notice messages from pricing interface for simple and variable subscriptions.
	* Fixed reference to text domain variable in variable subscriptions pricing interface.

= 1.2.5.140819 =
* Updated logic used to for requirements checking.

= 1.2.4.140724 =
* Removed deprecated method `WC_Aelia_CS_Subscriptions::check_requirements()`.

= 1.2.3.140715 =
* Fixed bug that prevented currency prices for non-subscription products from being saved.

= 1.2.2.140704 =
* Fixed reference to root WC_Product class in Aelia\WC\CurrencySwitcher\Subscriptions\Subscriptions_Integration.

= 1.2.1.140623 =
* Redesigned plugin to use Aelia Foundation Classes.

= 1.2.0.140619 =
* Added support for variable subscriptions.

= 1.1.8.140519-beta =
* Added subscription coupons to the list of the coupons to be converted by the Currency Switcher.

= 1.1.7.140419-beta =
* Updated base classes.

= 1.1.6.140414-beta =
* Redesigned interface for manual pricing of simple subscriptions.

= 1.1.5.140331-beta =
* Implemented handling of manual prices for simple subscriptions.
* Cleaned up unneeded code.

= 1.1.1.140331-beta =
* Removed unneeded hook.

= 1.1.0.140324-beta =
* Implemented basic conversion of simple subscriptions.

= 1.0.1.140318 =
* Updated base classes.

= 1.0.0.140220 =
* Initial release.

