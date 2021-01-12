<?php
/**
 * Plugin Name: Sensei with WooCommerce Paid Courses
 * Plugin URI: https://woocommerce.com/products/sensei/
 * Description: Whether you want to teach, tutor or train, we have you covered.
 * Version: 3.6.1.2.2.0
 * Author: Automattic
 * Author URI: https://automattic.com
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 5.4
 * Tested up to: 5.6
 * Requires PHP: 7.0
 * WC requires at least: 3.0
 * WC tested up to: 4.3
 * Text Domain: sensei-compat
 *
 * Woo: 152116:bad2a02a063555b7e2bee59924690763
 *
 * @package sensei-compat
 */

define( 'SENSEI_COMPAT_PLUGIN', true );
define( 'SENSEI_COMPAT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once dirname( __FILE__ ) . '/class-sensei-compat-dependency-checker.php';

if ( Sensei_Compat_Dependency_Checker::is_php_version_at_least( '5.6.0' ) ) {
	add_action( 'admin_notices', array( 'Sensei_Compat_Dependency_Checker', 'show_php_notice' ) );
	add_action( 'admin_init', array( 'Sensei_Compat_Dependency_Checker', 'deactivate_self' ) );
	return;
}

add_action( 'plugins_loaded', 'sensei_compat_load', 1 );
register_activation_hook( __FILE__, 'sensei_compat_activate' );
register_deactivation_hook( __FILE__, 'sensei_compat_deactivate' );

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/class-sensei-compat-admin.php';
	add_action( 'admin_init', array( 'Sensei_Compat_Admin', 'init' ) );
}

/**
 * Load Sensei with WooCommerce Paid Courses.
 *
 * @since 1.0.0
 * @access private
 */
function sensei_compat_load() {
	static $loaded = false;
	if ( $loaded ) {
		return;
	}
	$loaded = true;

	if ( Sensei_Compat_Dependency_Checker::is_legacy_sensei_active() ) {
		add_action( 'admin_notices', array( 'Sensei_Compat_Dependency_Checker', 'show_legacy_sensei_notice' ) );
		add_action( 'admin_init', array( 'Sensei_Compat_Dependency_Checker', 'deactivate_self' ) );
		define( 'SENSEI_COMPAT_LOADING_SENSEI', false );
		define( 'SENSEI_COMPAT_LOADING_WC_PAID_COURSES', false );
		return;
	}

	if ( ! Sensei_Compat_Dependency_Checker::is_sensei_active() ) {
		define( 'SENSEI_COMPAT_LOADING_SENSEI', true );

		add_filter( 'load_textdomain_mofile', 'sensei_compat_load_sensei_static_translations', 10, 2 );

		require_once dirname( __FILE__ ) . '/plugins/sensei-lms/sensei-lms.php';

		if ( ! defined( 'SENSEI_IGNORE_ACTIVATION_CONFLICT' ) ) {
			// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
			define( 'SENSEI_IGNORE_ACTIVATION_CONFLICT', true );
		}
	} else {
		define( 'SENSEI_COMPAT_LOADING_SENSEI', false );
	}

	if ( Sensei_Compat_Dependency_Checker::is_woocommerce_active() ) {
		define( 'SENSEI_COMPAT_LOADING_WC_PAID_COURSES', true );
		require_once dirname( __FILE__ ) . '/plugins/sensei-wc-paid-courses/sensei-wc-paid-courses.php';
	} else {
		define( 'SENSEI_COMPAT_LOADING_WC_PAID_COURSES', false );
		if ( ! Sensei_Compat_Dependency_Checker::is_woothemes_updater_active() ) {
			add_action( 'admin_notices', array( 'Sensei_Compat_Dependency_Checker', 'show_woocommerce_notice' ) );
		}
	}
}

/**
 * Loads the static translations if available. Set to load at a very low priority so WP_LANG translations' strings
 * are prioritized.
 *
 * @since  1.0.0
 * @access private
 *
 * @param string $mofile Path to the .mo file.
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return string
 */
function sensei_compat_load_sensei_static_translations( $mofile, $domain ) {
	$mofile_test   = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __DIR__ . '/plugins/sensei-lms/sensei-lms.php' ) ) . '/lang/' . basename( $mofile );
	$static_mofile = __DIR__ . '/languages/' . basename( $mofile );

	if ( 'sensei-lms' !== $domain || $mofile_test !== $mofile || ! is_readable( $static_mofile ) ) {
		return $mofile;
	}

	return $static_mofile;
}

/**
 * Ensure that the activation hooks for the plugins are run.
 *
 * @since 1.0.0
 * @access private
 */
function sensei_compat_activate() {
	sensei_compat_load();
	if ( SENSEI_COMPAT_LOADING_SENSEI ) {
		$sensei_plugin_file = dirname( __FILE__ ) . '/plugins/sensei-lms/sensei-lms.php';
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'activate_' . plugin_basename( $sensei_plugin_file ) );
	}

	if ( SENSEI_COMPAT_LOADING_WC_PAID_COURSES ) {
		$sensei_wcpc_plugin_file = dirname( __FILE__ ) . '/plugins/sensei-wc-paid-courses/sensei-wc-paid-courses.php';
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'activate_' . plugin_basename( $sensei_wcpc_plugin_file ) );
	}
}


/**
 * Ensure that the deactivation hooks for the plugins are run.
 *
 * @since 2.0.0
 * @access private
 */
function sensei_compat_deactivate() {
	sensei_compat_load();
	if ( SENSEI_COMPAT_LOADING_SENSEI ) {
		$sensei_plugin_file = dirname( __FILE__ ) . '/plugins/sensei-lms/sensei-lms.php';
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'deactivate_' . plugin_basename( $sensei_plugin_file ) );
	}

	if ( SENSEI_COMPAT_LOADING_WC_PAID_COURSES ) {
		$sensei_wcpc_plugin_file = dirname( __FILE__ ) . '/plugins/sensei-wc-paid-courses/sensei-wc-paid-courses.php';
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'deactivate_' . plugin_basename( $sensei_wcpc_plugin_file ) );
	}
}
