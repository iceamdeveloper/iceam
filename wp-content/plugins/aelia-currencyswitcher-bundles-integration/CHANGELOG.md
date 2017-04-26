# WooCommerce Currency Switcher - Bundles Integration

## Version 1.x
####1.2.2.170415
* Improved compatibility with Bundles 5.2.
	* Altered logic to determine a bundle's regular price to work correctly in Bundles 5.1 and 5.2.

####1.2.1.170414
* Improved compatibility with WooCommerce 3.0.x.
* Improved compatibility with Bundles 5.2.

####1.2.1.170108
* Improved compatibility with WooCommerce 2.7.
	* Added logic to acces product properties using the appropriate methods.
* Improved compatibility with Bundles 5.1.x:
	* Removed unneeded filters.

####1.2.0.161222
* Improved compatibility with Bundles 5.1.x:
	* Improved support for the new logic used to calculate bundles' base prices.

####1.1.1.161219
* Improved compatibility with Bundles 5.0.x:
	* Improved logic to determine if a bundle is on sale.

####1.1.0.161211
* Added compatibility with Bundles 5.0.x:
	* Added support for bundles' base prices.

####1.0.3.160326
* Fixed bug with statically priced bundles, caused by Bundler 4.3.13. A new logic added to the Bundles plugin added a breaking change and it treats bundled products as normal cart items. This causes their prices to be added to the cart total even when bundles are configured to use static (i.e. non "per product" pricing).

####1.0.2.160223
* Fixed bug in requirement checking logic. The bug triggered a warning message in the admin section, and it was caused by an incorrect plugin name.

####1.0.1.151214
* Fixed bug in conversion of bundles' base prices.

####1.0.0.151213
* First release.
