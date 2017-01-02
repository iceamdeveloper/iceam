<?php
/**
 * WC_PB_Helpers class
 *
 * @author   SomewhereWarm <sw@somewherewarm.net>
 * @package  WooCommerce Product Bundles
 * @since    4.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product Bundle Helper Functions.
 *
 * @class    WC_PB_Helpers
 * @version  5.1.0
 */
class WC_PB_Helpers {

	/**
	 * Runtime cache for simple storage.
	 *
	 * @var array
	 */
	public static $cache = array();

	/**
	 * Simple runtime cache getter.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public static function cache_get( $key ) {
		$value = null;
		if ( isset( self::$cache[ $key ] ) ) {
			$value = self::$cache[ $key ];
		}
		return $value;
	}

	/**
	 * Simple runtime cache setter.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public static function cache_set( $key, $value ) {
		self::$cache[ $key ] = $value;
	}

	/**
	 * True when processing a FE request.
	 *
	 * @return boolean
	 */
	public static function is_front_end() {
		$is_fe = ( ! is_admin() ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX );
		return $is_fe;
	}

	/**
	 * Loads variation IDs for a given variable product.
	 *
	 * @param  WC_Product_Variable|int  $product
	 * @return array
	 */
	public static function get_product_variations( $product ) {

		if ( ! is_object( $product ) ) {
			$product = wc_get_product( $product );
		}

		if ( ! $product ) {
			return false;
		}

		return $product->get_children();
	}

	/**
	 * Return a formatted product title based on id.
	 *
	 * @param  mixed  $product_id
	 * @return string
	 */
	public static function get_product_title( $product ) {

		if ( ! is_object( $product ) ) {
			$product = wc_get_product( $product );
		}

		if ( ! $product ) {
			return false;
		}

		$title = $product->get_title();
		$sku   = $product->get_sku();
		$id    = WC_PB_Core_Compatibility::get_id( $product );

		if ( $sku ) {
			$identifier = $sku;
		} else {
			$identifier = '#' . $id;
		}

		return self::format_product_title( $title, $identifier );
	}

	/**
	 * Return a formatted product title based on variation id.
	 *
	 * @param  int  $item_id
	 * @return string
	 */
	public static function get_product_variation_title( $variation ) {

		if ( ! is_object( $variation ) ) {
			$variation = wc_get_product( $variation );
		}

		if ( ! $variation ) {
			return false;
		}

		$description = WC_PB_Core_Compatibility::wc_get_formatted_variation( $variation, true );

		$title = $variation->get_title();
		$sku   = $variation->get_sku();
		$id    = WC_PB_Core_Compatibility::get_id( $variation );

		if ( $sku ) {
			$identifier = $sku;
		} else {
			$identifier = '#' . $id;
		}

		return self::format_product_title( $title, $identifier, $description );
	}

	/**
	 * Format a product title.
	 *
	 * @param  string   $title
	 * @param  string   $sku
	 * @param  string   $meta
	 * @param  boolean  $paren
	 * @return string
	 */
	public static function format_product_title( $title, $sku = '', $meta = '', $paren = false ) {

		if ( $sku && $meta ) {
			if ( $paren ) {
				$title = sprintf( _x( '%1$s &mdash; %2$s (%3$s)', 'product title followed by meta and sku in parenthesis', 'woocommerce-product-bundles' ), $title, $meta, $sku );
			} else {
				$title = sprintf( _x( '%1$s &ndash; %2$s &mdash; %3$s', 'sku followed by product title and meta', 'woocommerce-product-bundles' ), $sku, $title, $meta );
			}
		} elseif ( $sku ) {
			if ( $paren ) {
				$title = sprintf( _x( '%1$s (%2$s)', 'product title followed by sku in parenthesis', 'woocommerce-product-bundles' ), $title, $sku );
			} else {
				$title = sprintf( _x( '%1$s &ndash; %2$s', 'sku followed by product title', 'woocommerce-product-bundles' ), $sku, $title );
			}
		} elseif ( $meta ) {
			if ( $paren ) {
				$title = sprintf( _x( '%1$s (%2$s)', 'product title followed by meta in parenthesis', 'woocommerce-product-bundles' ), $title, $meta );
			} else {
				$title = sprintf( _x( '%1$s &mdash; %2$s', 'product title followed by meta', 'woocommerce-product-bundles' ), $title, $meta );
			}
		}

		return $title;
	}

	/**
	 * Format a product title incl qty, price and suffix.
	 *
	 * @param  string  $title
	 * @param  string  $qty
	 * @param  string  $price
	 * @param  string  $suffix
	 * @return string
	 */
	public static function format_product_shop_title( $title, $qty = '', $price = '', $suffix = '' ) {

		$quantity_string = '';
		$price_string    = '';
		$suffix_string   = '';

		if ( $qty ) {
			$quantity_string = sprintf( _x( ' &times; %s', 'qty string', 'woocommerce-product-bundles' ), $qty );
		}

		if ( $price ) {
			$price_string = sprintf( _x( ' &ndash; %s', 'price suffix', 'woocommerce-product-bundles' ), $price );
		}

		if ( $suffix ) {
			$suffix_string = sprintf( _x( ' &ndash; %s', 'suffix', 'woocommerce-product-bundles' ), $suffix );
		}

		$title_string = sprintf( _x( '%1$s%2$s%3$s%4$s', 'title, quantity, price, suffix', 'woocommerce-product-bundles' ), $title, $quantity_string, $price_string, $suffix_string );

		return $title_string;
	}
}
