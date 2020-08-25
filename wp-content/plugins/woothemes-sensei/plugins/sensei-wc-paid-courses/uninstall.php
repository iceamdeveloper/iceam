<?php
/**
 * Sensei WooCommerce Paid Courses Uninstall
 *
 * Uninstalls the plugin and associated data.
 *
 * @package sensei-wc-paid-courses
 * @since 2.0.0
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// No need for any special handling for multisite since wp_usermeta is a global table.
delete_metadata( 'user', 0, 'sensei_wcpc_modal_confirmation_date', '', true );

// From `\Sensei_WC_Paid_Courses\Background_Jobs\WooCommerce_Memberships_Detect_Cancelled_Orders`.
delete_option( 'sensei-wc-paid-courses-memberships-cancelled-orders' );
