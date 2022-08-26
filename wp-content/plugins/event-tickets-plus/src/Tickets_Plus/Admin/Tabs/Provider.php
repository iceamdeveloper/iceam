<?php

namespace TEC\Tickets_Plus\Admin\Tabs;

use tad_DI52_ServiceProvider;

/**
 * Class Service_Provider
 *
 * @package TEC\Tickets_Plus\Admin\Tabs
 *
 * @since 5.5.1
 */
class Provider extends tad_DI52_ServiceProvider {

	/**
	 * Register the provider.
	 *
	 * @since 5.5.1
	 */
	public function register() {
		$this->container->singleton( Attendee_Registration::class );

		// Hook actions and filters.
		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Add the action hooks.
	 *
	 * @since 5.5.1
	 */
	public function add_actions() {
		add_action( 'tribe_settings_do_tabs', [ $this, 'add_attendee_registration_tab' ] );
	}

	/**
	 * Add fhe filter hooks.
	 *
	 * @since 5.5.1
	 */
	public function add_filters() {
		add_filter( 'tec_tickets_settings_tabs_ids', [ $this, 'filter_include_attendee_registration_tab_id' ] );
	}

	/**
	 * Register the Attendee Registration tab.
	 *
	 * @since 5.5.1
	 *
	 * @param string Admin page id.
	 *
	 * @return void
	 */
	public function add_attendee_registration_tab( $admin_page ) {
		$this->container->make( Attendee_Registration::class )->register_tab( $admin_page );
	}

	/**
	 * Register the Attendee Registration tab id.
	 *
	 * @since 5.5.1
	 *
	 * @param array $tabs Array of tabs IDs for the Events settings page.
	 *
	 * @return array
	 */
	public function filter_include_attendee_registration_tab_id( array $tabs ): array {
		return $this->container->make( Attendee_Registration::class )->register_tab_id( $tabs );
	}
}