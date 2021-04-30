=== WooCommerce Cache Handler ===
Tags: woocommerce, multi-currency, multiple currency, caching
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8ND89AA8B8QJ
Requires at least: 4.0
Tested up to: 5.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 3.0
WC tested up to: 5.0

Implements a workaround to allow plugins to work with caching systems that don't support dynamic cache.

== Description ==

The Cache Handler plugin can work around the limitations of rigid caching systems. Its purpose is to ensure that the correct content is served to the visitors, depending on their country, province, currency and tax status.

= Requirements =
* WordPress 4.0 or newer.
* PHP 5.3 or newer.
* WooCommerce 3.0 or newer
* [AFC plugin for WooCommerce](http://aelia.co/downloads/wc-aelia-foundation-classes.zip) 1.8.2.161216 or later.

== Installation ==

1. Download the Cache Handler plugin from our site.
2. Upload and activate the plugin.
3. Go to WooCommerce > Settings > Cache Handler to configure the plugin. You will be presented with three options:
  * **Disabled**. The Cache Handler will be disabled and won't do anything.
	* **Enable Redirect**. The Cache Handler will use the same redirect mechanism adopted by WooCommerce to redirect users to the correct content. Visitor's will be redirected to pages that have a unique page identifier appended to the URL (e.g. http://example.org?ph=23985623985). The identifier will be unique for the combination of country, province, currency and tax status, and it will ensure that visitors will see the correct content.
	* **Enable Ajax Loader**. The Cache Handler will use Ajax to load prices dynamically on each page. This method will trigger an Ajax request that will update "on the fly" all the prices found on a page. Its main drawback is that it cannot handle prices introduced by other plugins (e.g. pricing tables, product addons, etc). If you use that type of plugins, you should use the Enable Redirect method instead.
4. Choose the option that works best for your site, and save the settings.
5. Clear all the caching systems you are using (plugins, Nginx, Varnish, CloudFlare, etc). This is important, as it will allow the Cache Handler to add its scripts to your pages, and ensure that the correct content is served.

== Changelog ==

= 1.0.20.210128 =
* Updated supported WooCommerce versions.
* Updated supported WordPress versions.

= 1.0.19.201207 =
* Updated supported WooCommerce versions.
* Updated supported WordPress versions.

= 1.0.18.201103 =
* Updated supported WooCommerce versions.

= 1.0.16.201005 =
* Updated supported WooCommerce versions.
* Updated supported WordPress versions.

= 1.0.15.200904 =
* Updated supported WooCommerce versions.

= 1.0.14.200813 =
* Updated supported WordPress and WooCommerce versions.

= 1.0.14.200629 =
* Updated supported WooCommerce versions.

= 1.0.14.200603 =
* Updated supported WooCommerce versions.

= 1.0.13.200428 =
* Updated requirement checking class.
* Updated requirements.
* Updated supported WooCommerce versions.

= 1.0.12.200323 =
* Updated supported WooCommerce versions.

= 1.0.11.191111 =
* Tweak - Added check in Ajax Loader, to ensure that only valid product ID are handled.
* Updated supported WooCommerce versions.

= 1.0.10.190522 =
* Updated supported WooCommerce versions.

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
