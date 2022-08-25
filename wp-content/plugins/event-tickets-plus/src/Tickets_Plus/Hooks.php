<?php
/**
 * Handles hooking all the actions and filters used by the module.
 *
 * To remove a filter:
 * remove_filter( 'some_filter', [ tribe( TEC\Tickets_Plus\Hooks::class ), 'some_filtering_method' ] );
 * remove_filter( 'some_filter', [ tribe( 'tickets-plus.hooks' ), 'some_filtering_method' ] );
 *
 * To remove an action:
 * remove_action( 'some_action', [ tribe( TEC\Tickets_Plus\Hooks::class ), 'some_method' ] );
 * remove_action( 'some_action', [ tribe( 'tickets-plus.hooks' ), 'some_method' ] );
 *
 * @since   5.3.0
 *
 * @package TEC\Tickets_Plus
 */

namespace TEC\Tickets_Plus;

use \tad_DI52_ServiceProvider;
use Tribe__Template;

/**
 * Class Hooks.
 *
 * @since   5.3.0
 *
 * @package TEC\Tickets_Plus
 */
class Hooks extends tad_DI52_ServiceProvider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 5.3.0
	 */
	public function register() {
		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds the actions required by each Tickets component.
	 *
	 * @since 5.3.0
	 */
	protected function add_actions() {
	}

	/**
	 * Adds the filters required by each Tickets component.
	 *
	 * @since 5.3.0
	 */
	protected function add_filters() {
		add_filter( 'tribe_template_path_list', [ $this, 'filter_template_path_list' ], 15, 2 );
		add_filter( 'tribe_template_origin_namespace_map', [ $this, 'filter_add_template_origin_namespace' ], 15, 3 );
		add_filter( 'tec_tickets_commerce_settings_top_level', [ $this, 'filter_tc_settings' ] );
	}

	/**
	 * Filters the list of folders that will be looked over to find templates and add the Event Tickets Plus.
	 *
	 * @since 5.3.0
	 *
	 * @param array           $folders  The current list of folders that will be searched template files.
	 * @param Tribe__Template $template Which template instance we are dealing with.
	 *
	 * @return array The filtered list of folders that will be searched for the templates.
	 */
	public function filter_template_path_list( array $folders, Tribe__Template $template ) {
		/** @var Plugin $main */
		$main = tribe( 'tickets-plus.main' );

		$path = (array) rtrim( $main->plugin_path, '/' );

		// Pick up if the folder needs to be added to the public template path.
		$folder = $template->get_template_folder();

		if ( ! empty( $folder ) ) {
			$path = array_merge( $path, $folder );
		}

		$folders['event-tickets-plus'] = [
			'id'        => 'event-tickets-plus',
			'namespace' => $main->template_namespace,
			'priority'  => 16,
			'path'      => implode( DIRECTORY_SEPARATOR, $path ),
		];

		return $folders;
	}

	/**
	 * Includes Event Tickets Plus into the path namespace mapping, allowing for a better namespacing when loading files.
	 *
	 * @since 5.3.0
	 *
	 * @param array           $namespace_map Indexed array containing the namespace as the key and path to `strpos`.
	 * @param string          $path          Path we will do the `strpos` to validate a given namespace.
	 * @param Tribe__Template $template      Current instance of the template class.
	 *
	 * @return array  Namespace map after adding Pro to the list.
	 */
	public function filter_add_template_origin_namespace( $namespace_map, $path, $template ) {
		/** @var Plugin $main */
		$main = tribe( 'tickets-plus.main' );

		$namespace_map[ $main->template_namespace ] = $main->plugin_path;

		return $namespace_map;
	}

	/**
	 * Remove the promotional wording from TC settings since plus is already installed.
	 *
	 * @since 5.5.2
	 *
	 * @param array   $settings Associative array of setting from Tickets Commerce.
	 *
	 * @return array  Filtered settings.
	 */
	public function filter_tc_settings( $settings ) {
		// If setting doesn't exist, bail.
		if ( ! isset( $settings['tickets-commerce-description'] ) ) {
			return $settings;
		}
		$new_description = esc_html_x( 'Tickets Commerce provides a simple and flexible ecommerce checkout for purchasing tickets. Just choose your payment gateway and configure checkout options and you\'re all set.', 'about Tickets Commerce', 'event-tickets-plus' );
		$settings['tickets-commerce-description']['html'] = '<div class="tec-tickets__admin-settings-tickets-commerce-description">' . $new_description . '</div>';
		return $settings;
	}
}
