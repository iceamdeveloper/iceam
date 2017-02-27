=== WooCommerce Cache Handler ===
Requires at least: 3.6
Tested up to: 4.6
Stable tag: 1.0.4.161003
Tags: woocommerce, multi-currency, multiple currency, caching
License: GPL-3.0

Implements a workaround to allow plugins to work with caching systems that don't support dynamic cache.

== Description ==

*** Write extended description here ***

= Requirements =

*** Describe requirements here ***

* WordPress 3.6 or later.
* PHP 5.3 or later.
* WooCommerce 2.1.x/2.2.x/2.3.x.
* [AFC plugin for WooCommerce](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.4.9.150111 or later.

== Frequently Asked Questions ==

*** Write the FAQ here ***

== Installation ==

*** Write installation instructions here ***

For more information about installation and management of plugins, please refer to [WordPress documentation](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

== Screenshots ==

*** Add screenshots here (if any) ***

1. **Settings > Options**. Miscellaneous options.

== Changelog ==

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
