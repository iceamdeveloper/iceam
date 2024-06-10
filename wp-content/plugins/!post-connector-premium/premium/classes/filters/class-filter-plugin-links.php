<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Filter_Plugin_Links extends SP_Filter {
	protected $tag = 'plugin_action_links_post-connector-premium/post-connector.php';

	public function run( $links ) {

		array_unshift( $links, '<a href="' . get_admin_url() . 'admin.php?page=post_connector_license">' . __( 'License', 'post-connector' ) . '</a>' );
		array_unshift( $links, '<a href="' . get_admin_url() . 'admin.php?page=post_connector">' . __( 'Manage', 'post-connector' ) . '</a>' );

		return $links;
	}
}