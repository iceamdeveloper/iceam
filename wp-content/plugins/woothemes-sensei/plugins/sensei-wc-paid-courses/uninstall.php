<?php
/**
 * Sensei WooCommerce Paid Courses Uninstall
 *
 * Uninstalls the plugin and associated data.
 *
 * @package sensei-wc-paid-courses
 * @since 2.0.0
 *
 * @var string $plugin Plugin name being passed to `uninstall_plugin()`.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

if ( class_exists( 'Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses' ) ) {
	// Another instance of WCPC is installed and activated on the current site or network.
	return;
}

require dirname( __FILE__ ) . '/sensei-wc-paid-courses.php';

if ( ! class_exists( 'Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses' ) ) {
	// We still want people to be able to delete WCPC if they don't meet dependencies.
	return;
}

require dirname( __FILE__ ) . '/includes/class-data-cleaner.php';

( new Sensei_WC_Paid_Courses\Data_Cleaner() )->uninstall( $plugin );
