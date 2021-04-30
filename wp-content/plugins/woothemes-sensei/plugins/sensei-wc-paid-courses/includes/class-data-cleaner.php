<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Data_Cleaner.
 *
 * @package sensei-wc-paid-courses
 * @since   2.3.0
 */

namespace Sensei_WC_Paid_Courses;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Methods for cleaning up all plugin data.
 *
 * @class Data_Cleaner
 */
class Data_Cleaner {
	/**
	 * Post meta to be deleted.
	 *
	 * @var string[]
	 */
	private $post_meta = [
		'_course_woocommerce_product',
		'sensei_wc_paid_courses_calculation_version',
	];

	/**
	 * Options to be deleted.
	 *
	 * @var string[]
	 */
	private $options = [
		'sensei-wc-paid-courses-memberships-cancelled-orders',
	];

	/**
	 * User meta key names to be deleted.
	 *
	 * @var string[]
	 */
	private $user_meta_keys = [
		'sensei_wcpc_modal_confirmation_date',
	];

	/**
	 * Transients to be deleted.
	 *
	 * @var string[]
	 */
	private $transients = [
		'sensei-wc-paid-courses-translations-.*',
		'sensei_language_packs_.*',
	];

	/**
	 * Uninstall a plugin and maybe remove the data.
	 *
	 * @param string $plugin Plugin name.
	 */
	public function uninstall( $plugin ) {
		if ( is_multisite() ) {
			$this->uninstall_multisite( $plugin );

			return;
		}

		$this->delete_data();
	}

	/**
	 * Uninstall a plugin and maybe remove the data on multisites.
	 *
	 * @param string $plugin Plugin name.
	 */
	private function uninstall_multisite( $plugin ) {
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Safe and rare query.
		$blog_ids         = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );
		$original_blog_id = get_current_blog_id();

		foreach ( $blog_ids as $sensei_lms_current_blog_id ) {
			switch_to_blog( $sensei_lms_current_blog_id );

			if ( $this->is_another_wcpc_activated( $plugin ) ) {
				continue;
			}

			$this->delete_data();
		}

		switch_to_blog( $original_blog_id );
	}

	/**
	 * Delete data for the current blog.
	 */
	private function delete_data() {
		if ( ! $this->is_delete_data_on_uninstall_enabled() ) {
			return;
		}

		$this->delete_post_meta();
		$this->delete_options();
		$this->delete_user_meta();
		$this->delete_transients();
	}

	/**
	 * Checks if another WCPC is activated on the specific site in the network.
	 *
	 * @param string $current_plugin Current plugin that is being deleted.
	 *
	 * @return bool True if another WCPC is activated.
	 */
	private function is_another_wcpc_activated( $current_plugin ) {
		$current_plugin_basename = plugin_basename( $current_plugin );
		$active_plugins          = (array) get_option( 'active_plugins', [] );
		$other_wcpc_basenames    = [
			'sensei-wc-paid-courses/sensei-wc-paid-courses.php',
		];

		foreach ( $other_wcpc_basenames as $basename ) {
			if ( $basename === $current_plugin_basename ) {
				// Plugins can be deleted on the network level even when activated on the site level.
				// We don't want the current plugin to count in the search.
				continue;
			}

			if ( in_array( $basename, $active_plugins, true ) || array_key_exists( $basename, $active_plugins ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if we are to delete Sensei on uninstall.
	 *
	 * @return bool
	 */
	private function is_delete_data_on_uninstall_enabled() {
		$sensei_settings = get_option( 'sensei-settings' );

		// If Sensei settings do not exist, assume Sensei deleted it while being uninstalled.
		if ( ! $sensei_settings ) {
			return true;
		}

		// Trust the Sensei setting to delete data on uninstall if it is enabled.
		if ( ! empty( $sensei_settings['sensei_delete_data_on_uninstall'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Cleanup post meta that doesn't get deleted automatically.
	 *
	 * @access private
	 */
	private function delete_post_meta() {
		global $wpdb;

		foreach ( $this->post_meta as $post_meta ) {
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Safe and rare query.
			$wpdb->delete( $wpdb->postmeta, [ 'meta_key' => $post_meta ] );
		}
	}

	/**
	 * Cleanup data for options.
	 *
	 * @access private
	 */
	private function delete_options() {
		foreach ( $this->options as $option ) {
			delete_option( $option );
		}
	}

	/**
	 * Cleanup user meta from the database.
	 *
	 * @access private
	 */
	private function delete_user_meta() {
		foreach ( $this->user_meta_keys as $meta_key ) {
			delete_metadata( 'user', 0, $meta_key, '', true );
		}
	}

	/**
	 * Cleanup transients from the database.
	 *
	 * @access private
	 */
	private function delete_transients() {
		global $wpdb;

		foreach ( [ '_transient_', '_transient_timeout_', '_site_transient_', '_site_transient_timeout_' ] as $prefix ) {
			foreach ( $this->transients as $transient ) {
				// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Safe-ish and rare query.
				$wpdb->query(
					$wpdb->prepare(
						"DELETE FROM $wpdb->options WHERE option_name RLIKE %s",
						$prefix . $transient
					)
				);
			}
		}
	}
}
