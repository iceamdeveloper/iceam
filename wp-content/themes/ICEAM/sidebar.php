<?php
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package WooFramework
 * @subpackage Template
 */

 
global $post, $wp_query, $woo_options;

$settings = array(
				'portfolio_layout' => 'one-col'
				);

$settings = woo_get_dynamic_values( $settings );

// Reset Main Query
wp_reset_query();

$layout = woo_get_layout();

// Cater for custom portfolio gallery layout option.
if ( is_tax( 'portfolio-gallery' ) || is_post_type_archive( 'portfolio' ) ) {
	if ( '' != $settings['portfolio_layout'] ) { $layout = $settings['portfolio_layout']; }
}

if ( 'one-col' != $layout ) {
	if ( woo_active_sidebar( 'primary' ) ) {
		woo_sidebar_before();
?>
<aside id="sidebar">

<?php

	woo_sidebar_inside_before();
	woo_sidebar( 'primary' );
	woo_sidebar_inside_after();
?>
</aside><!-- /#sidebar -->
<?php
		woo_sidebar_after();
	}
}
?>