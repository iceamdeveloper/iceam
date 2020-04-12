<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Settings.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Sensei_WC_Memberships;

/**
 * Class that handles WCPC specific settings.
 *
 * @class Sensei_WC_Paid_Courses\Settings
 */
final class Settings {
	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Settings constructor. Prevents other instances from being created outside of `Settings::instance()`.
	 */
	private function __construct() {
	}

	/**
	 * Initializes the class and adds all filters and actions.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_filter( 'sensei_settings_tabs', [ $this, 'add_setting_tabs' ] );
		add_filter( 'sensei_settings_fields', [ $this, 'add_setting_fields' ] );
	}

	/**
	 * Adds setting tabs used by WCPC.
	 *
	 * @param array $tabs Setting tabs.
	 * @return array
	 */
	public function add_setting_tabs( $tabs ) {
		$tabs['woocommerce-settings'] = [
			'name'        => __( 'WooCommerce', 'sensei-wc-paid-courses' ),
			'description' => __( 'Optional settings for WooCommerce functions.', 'sensei-wc-paid-courses' ),
		];

		if ( Sensei_WC_Memberships::is_wc_memberships_active() ) {
			$tabs['sensei-wc-memberships-settings'] = [
				'name'        => __( 'WooCommerce Memberships', 'sensei-wc-paid-courses' ),
				'description' => __( 'Optional settings for WooCommerce Memberships functions.', 'sensei-wc-paid-courses' ),
			];
		} // End If Statement

		return $tabs;
	}

	/**
	 * Add WC specific setting fields.
	 *
	 * @param array $fields Settings fields from Sensei.
	 * @return array
	 */
	public function add_setting_fields( $fields ) {

		// WooCommerce Settings.
		$fields['woocommerce_enable_sensei_debugging'] = [
			'name'        => __( 'Enable Sensei WooCommerce Integration Debugging', 'sensei-wc-paid-courses' ),
			'description' => __( 'Advanced: Log Sensei/WooCommerce integration events (Uses WC_Logger, logs events at `notice` level)', 'sensei-wc-paid-courses' ),
			'type'        => 'checkbox',
			'default'     => false,
			'section'     => 'woocommerce-settings',
		];

		if ( Sensei_WC_Memberships::is_wc_memberships_active() ) {
			$fields['sensei_wc_memberships_restrict_course_video'] = [
				'name'        => __( 'Restrict course video', 'sensei-wc-paid-courses' ),
				'description' => __( 'Used when you don\'t want the course video to be viewable by non-members', 'sensei-wc-paid-courses' ),
				'type'        => 'checkbox',
				'default'     => false,
				'section'     => 'sensei-wc-memberships-settings',
			];
			$fields['sensei_wc_memberships_auto_start_courses']    = [
				'name'        => __( 'Auto-start courses belonging to a membership', 'sensei-wc-paid-courses' ),
				'description' => __( 'Automatically start courses belonging to a WC Membership when activated', 'sensei-wc-paid-courses' ),
				'type'        => 'checkbox',
				'default'     => false,
				'section'     => 'sensei-wc-memberships-settings',
			];
		}

		return $fields;
	}

	/**
	 * Fetches an instance of the class.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
