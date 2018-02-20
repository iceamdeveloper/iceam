=== WooCommerce Cache Handler ===
Tags: woocommerce, multi-currency, multiple currency, caching
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8ND89AA8B8QJ
Requires at least: 4.0
Tested up to: 4.8
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 2.4
WC tested up to: 3.1.2

Implements a workaround to allow plugins to work with caching systems that don't support dynamic cache.

== Description ==

*** Write extended description here ***

= Requirements =

*** Describe requirements here ***

* WordPress 4.0 or newer.
* PHP 5.3 or newer.
* WooCommerce 2.4.x to 3.3.x.
* [AFC plugin for WooCommerce](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.8.2.161216 or later.

== Frequently Asked Questions ==

*** Write the FAQ here ***

== Installation ==

*** Write installation instructions here ***

For more information about installation and management of plugins, please refer to [WordPress documentation](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

== Screenshots ==

*** Add screenshots here (if any) ***

1. **Settings > Options**. Miscellaneous options.

== Changelog ==

= 1.0.9.180212 =
* Tweak - Handled condition in which a country selector widget doesn't contain the country code that the Cache Handler is trying to set.

= 1.0.8.180207 =
* Improvement - Improved error handling for Ajax calls in in Ajax Loader.
* Fix - Fixed compatibility with country selector widget implemented by the Tax Display by Country plugin.
* Updated supported WooCommerce versions.

= 1.0.7.170926 =
* Bug fix - Fixed handling of cookies with WooCommerce 3.0 and later.

= 1.0.6.170520 =
* Code cleanup.

= 1.0.5.170420 =
* Improved compatibility with WooCommerce 3.0.x:
	* Fixed notice due to a direct call to `$product->id`.

= 1.0.4.161003 =
* Improved handling of Ajax calls in cache handlers:
	* Prevented infinite loops in cache buster, when Ajax calls fail.
	* Added new checks to prevent a failed check of the Ajax nonce from causing issues.

= 1.0.4.160701 =
* Improved Ajax Loader. Added support for the country selector widgets used by Aelia plugins.

= 1.0.3.160602 =
* Implemented Cache Buster Handler.

= 1.0.2.160601 =
* Implemented Base Cache Handler.
* Implemented Ajax Loader Handler.

= 1.0.1.160531 =
* Added settings page.

= 1.0.0 =
* First plugin draft.
