<?php
/**
 * Plugin Name: Sensei WooCommerce Paid Courses
 * Plugin URI: https://senseilms.com/
 * Description: Whether you want to teach, tutor or train, we have you covered.
 * Version: 2.1.0
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 5.2
 * Tested up to: 5.5
 * Requires PHP: 7.0
 * WC requires at least: 3.0
 * WC tested up to: 4.3
 * Author: Automattic
 * Author URI: https://senseilms.com/
 * Text Domain: sensei-wc-paid-courses
 * Domain Path: /languages/
 *
 * @package sensei-wc-paid-courses
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SENSEI_WC_PAID_COURSES_VERSION', '2.1.0' );
define( 'SENSEI_WC_PAID_COURSES_PLUGIN_FILE', __FILE__ );
define( 'SENSEI_WC_PAID_COURSES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once dirname( __FILE__ ) . '/includes/class-sensei-wc-paid-courses-dependency-checker.php';

if ( ! Sensei_WC_Paid_Courses_Dependency_Checker::are_system_dependencies_met() ) {
	return;
}

// Include deprecated functions.
require_once dirname( __FILE__ ) . '/includes/deprecated-functions.php';
require_once dirname( __FILE__ ) . '/includes/class-sensei-wc-paid-courses.php';

// Load the plugin after all the other plugins have loaded.
add_action( 'plugins_loaded', array( 'Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses', 'init' ), 5 );

Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses::instance();

