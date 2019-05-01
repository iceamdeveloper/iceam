<?php
/**
 * WooCommerce cart class
 *
 * @since 4.9
 */
class Tribe__Tickets_Plus__Commerce__WooCommerce__Cart extends Tribe__Tickets_Plus__Commerce__Abstract_Cart {
	/**
	 * Hook relevant actions and filters
	 *
	 * @since 4.9
	 */
	public function hook() {
		parent::hook();

		add_filter( 'tribe_tickets_attendee_registration_checkout_url', [ $this, 'maybe_filter_attendee_registration_checkout_url' ], 8 );
		add_filter( 'woocommerce_get_checkout_url', [ $this, 'maybe_filter_checkout_url_to_attendee_registration' ], 12 );
		add_filter( 'tribe_tickets_tickets_in_cart', [ $this, 'get_tickets_in_cart' ] );
		add_filter( 'tribe_providers_in_cart', [ $this, 'providers_in_cart' ], 12 );
		add_filter( 'tribe_tickets_woo_cart_url', [ $this, 'add_provider_to_cart_url' ] );
	}

	/**
	 * Hooked to the tribe_tickets_attendee_registration_checkout_url filter to hijack URL if on cart and there
	 * are attendee registration fields that need to be filled out
	 *
	 * @since 4.9
	 *
	 * @param string $checkout_url
	 *
	 * @return string
	 */
	public function maybe_filter_attendee_registration_checkout_url( $checkout_url ) {
		$checkout_url = $this->maybe_filter_checkout_url_to_attendee_registration( $checkout_url );

		if ( $checkout_url ) {
			return $checkout_url;
		}

		return wc_get_checkout_url();
	}

	/**
	 * Hooked to tribe_providers_in_cart adds WC as a provider for checks if there are EDD items in the "cart"
	 *
	 * @since 4.10.2
	 *
	 * @param array $providers
	 * @return array List of providers with EDD optionally added
	 */
	public function providers_in_cart( $providers ) {
		if ( empty( $this->get_tickets_in_cart() ) ) {
			return $providers;
		}

		$providers[] = 'WC';

		return $providers;
	}

	/**
	 * Hooked to the woocommerce_get_checkout_url filter to hijack URL if on cart and there
	 * are attendee registration fields that need to be filled out
	 *
	 * @since 4.9
	 *
	 * @param string $checkout_url
	 *
	 * @return null|string
	 */
	public function maybe_filter_checkout_url_to_attendee_registration( $checkout_url ) {

		/** @var \Tribe__Tickets_Plus__Commerce__WooCommerce__Main $commerce_woo */
		$commerce_woo = tribe( 'tickets-plus.commerce.woo' );

		if ( $commerce_woo->attendee_object !== tribe_get_request_var( 'provider' ) ) {
			return $checkout_url;
		}

		$on_registration_page = tribe( 'tickets.attendee_registration' )->is_on_page();

		// we only want to override if we are on the cart page or the attendee registration page
		if ( ! is_cart() && ! $on_registration_page ) {
			return $checkout_url;
		}

		$cart_tickets  = $this->get_tickets_in_cart();
		$cart_has_meta = Tribe__Tickets_Plus__Main::instance()->meta()->cart_has_meta( $cart_tickets );

		// If on registration page or cart page and cart has meta, return checkout url
		if ( $on_registration_page || ( is_cart() && ! $cart_has_meta ) ) {
			return $checkout_url;
		}

		$url = add_query_arg( 'provider', $commerce_woo->attendee_object, tribe( 'tickets.attendee_registration' )->get_url() );
		return $url;
	}

	/**
	 * Adds a provder parameter to the cart URL to assist with
	 * keeping tickets from different providers separate.
	 *
	 * @since TBD
	 *
	 * @param string $url Cart URL.
	 *
	 * @return string modified cart url
	 */
	public function add_provider_to_cart_url( $url ) {
		$url = add_query_arg( 'provider', tribe( 'tickets-plus.commerce.woo' )->attendee_object, $url );

		return $url;
	}

	/**
	 * Get all tickets currently in the cart.
	 *
	 * @since 4.9
	 *
	 * @param array $tickets Array indexed by ticket id with quantity as the value
	 *
	 * @return array
	 */
	public function get_tickets_in_cart( $tickets = array() ) {
		$contents = WC()->cart->get_cart_contents();
		if ( empty( $contents ) ) {
			return $tickets;
		}

		foreach ( $contents as $item ) {
			$id = $item['product_id'];
			$woo_check = get_post_meta( $id, tribe( 'tickets-plus.commerce.woo' )->event_key, true );
			if ( empty( $woo_check ) ) {
				continue;
			}

			$tickets[ $item['product_id'] ] = $item['quantity'];
		}

		return $tickets;
	}
}
