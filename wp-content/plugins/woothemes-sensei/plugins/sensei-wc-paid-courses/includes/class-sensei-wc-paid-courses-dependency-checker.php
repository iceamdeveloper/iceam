<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses_Dependency_Checker.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sensei WooCommerce Paid Courses Extension Dependencies Check
 *
 * @since 1.0.0
 */
class Sensei_WC_Paid_Courses_Dependency_Checker {
	const MINIMUM_PHP_VERSION         = '5.6';
	const MINIMUM_SENSEI_VERSION      = '3.0.0';
	const MINIMUM_WOOCOMMERCE_VERSION = '3.0.0';

	/**
	 * Checks if system dependencies are met.
	 *
	 * @return bool
	 */
	public static function are_system_dependencies_met() {
		$are_met = true;
		if ( ! self::check_php() ) {
			add_action( 'admin_notices', array( __CLASS__, 'add_php_notice' ) );
			$are_met = false;
		}
		if ( ! $are_met ) {
			add_action( 'admin_init', array( __CLASS__, 'deactivate_self' ) );
		}

		return $are_met;
	}

	/**
	 * Checks if all plugin dependencies are met.
	 *
	 * @return bool
	 */
	public static function are_plugin_dependencies_met() {
		$are_met = true;
		if ( ! self::check_sensei() ) {
			add_action( 'admin_notices', array( __CLASS__, 'add_sensei_notice' ) );

			// Don't block loading until we take out the legacy code.
			$are_met = self::check_sensei( '2.0.0' );
		}
		if ( ! self::check_woocommerce() ) {
			add_action( 'admin_notices', array( __CLASS__, 'add_woocommerce_notice' ) );
			$are_met = false;
		}
		return $are_met;
	}

	/**
	 * Checks for our PHP version requirement.
	 *
	 * @return bool
	 */
	private static function check_php() {
		return version_compare( phpversion(), self::MINIMUM_PHP_VERSION, '>=' );
	}

	/**
	 * Deactivate self.
	 */
	public static function deactivate_self() {
		deactivate_plugins( SENSEI_WC_PAID_COURSES_PLUGIN_BASENAME );
	}

	/**
	 * Checks for our Sensei dependency.
	 *
	 * @param string $minimum_version Check for a specific minimum version. If not set, it will use the constant.
	 * @return bool
	 */
	private static function check_sensei( $minimum_version = null ) {
		if ( ! class_exists( 'Sensei_Main' ) ) {
			return false;
		}

		if ( ! $minimum_version ) {
			$minimum_version = self::MINIMUM_SENSEI_VERSION;
		}

		return version_compare( $minimum_version, get_option( 'sensei-version' ), '<=' );
	}

	/**
	 * Check if WooCommerce is activated.
	 *
	 * @return bool
	 */
	private static function check_woocommerce() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return false;
		}

		return version_compare( self::MINIMUM_WOOCOMMERCE_VERSION, get_option( 'woocommerce_db_version' ), '<=' );
	}
	/**
	 * Adds notice in WP Admin that minimum version of PHP is not met.
	 *
	 * @access private
	 */
	public static function add_php_notice() {
		$screen        = get_current_screen();
		$valid_screens = array( 'dashboard', 'plugins', 'plugins-network' );

		if ( ! current_user_can( 'activate_plugins' ) || ! in_array( $screen->id, $valid_screens, true ) ) {
			return;
		}

		// translators: %1$s is version of PHP that this plugin requires; %2$s is the version of PHP WordPress is running on.
		$message = sprintf( __( '<strong>Sensei WooCommerce Paid Courses</strong> requires a minimum PHP version of %1$s, but you are running %2$s.', 'sensei-wc-paid-courses' ), self::MINIMUM_PHP_VERSION, phpversion() );
		echo '<div class="error"><p>';
		echo wp_kses( $message, array( 'strong' => array() ) );
		$php_update_url = 'https://wordpress.org/support/update-php/';
		if ( function_exists( 'wp_get_update_php_url' ) ) {
			$php_update_url = wp_get_update_php_url();
		}
		printf(
			'<p><a class="button button-primary" href="%1$s" target="_blank" rel="noopener noreferrer">%2$s <span class="screen-reader-text">%3$s</span><span aria-hidden="true" class="dashicons dashicons-external"></span></a></p>',
			esc_url( $php_update_url ),
			esc_html__( 'Learn more about updating PHP', 'sensei-wc-paid-courses' ),
			/* translators: accessibility text */
			esc_html__( '(opens in a new tab)', 'sensei-wc-paid-courses' )
		);
		echo '</p></div>';
	}

	/**
	 * Adds the notice in WP Admin that Sensei is required.
	 *
	 * @access private
	 */
	public static function add_sensei_notice() {
		$screen        = get_current_screen();
		$valid_screens = array( 'dashboard', 'plugins', 'plugins-network' );

		if ( ! current_user_can( 'activate_plugins' ) || ! in_array( $screen->id, $valid_screens, true ) ) {
			return;
		}

		// translators: %1$s is the minimum version number of Sensei that is required.
		$message = sprintf( __( '<strong>Sensei WooCommerce Paid Courses</strong> requires that the plugin <strong>Sensei LMS</strong> (minimum version: <strong>%1$s</strong>) is installed and activated.', 'sensei-wc-paid-courses' ), self::MINIMUM_SENSEI_VERSION );
		echo '<div class="error"><p>';
		echo wp_kses( $message, array( 'strong' => array() ) );
		echo '</p></div>';
	}

	/**
	 * Adds the notice in WP Admin that WooCommerce is required.
	 *
	 * @access private
	 */
	public static function add_woocommerce_notice() {
		$screen        = get_current_screen();
		$valid_screens = array( 'dashboard', 'plugins', 'plugins-network' );

		if ( ! current_user_can( 'activate_plugins' ) || ! in_array( $screen->id, $valid_screens, true ) ) {
			return;
		}

		// translators: %1$s is the minimum version number of WooCommerce that is required.
		$message = sprintf( __( '<strong>Sensei WooCommerce Paid Courses</strong> requires that the plugin <strong>WooCommerce</strong> (minimum version: <strong>%1$s</strong>) is installed and activated.', 'sensei-wc-paid-courses' ), self::MINIMUM_WOOCOMMERCE_VERSION );
		echo '<div class="error"><p>';
		echo wp_kses( $message, array( 'strong' => array() ) );
		echo '</p></div>';
	}
}
