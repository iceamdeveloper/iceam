<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Hook_License_Page extends SP_Hook {
	protected $tag = 'admin_menu';

	public function run() {
		if ( ! is_multisite() ) {
			add_submenu_page( 'post_connector', __( 'License', 'post-connector' ), __( 'License', 'post-connector' ), 'manage_options', 'post_connector_license', array(
				$this,
				'output_screen'
			) );
		}
	}

	/**
	 * Output the screen
	 */
	public function output_screen() {
		?>
		<div class="wrap">
			<h2>Post Connector - <?php _e( 'License settings', 'post-connector' ); ?></h2>
			<?php settings_errors(); ?>
			<div class="pc-content">
				<?php
				$license_manager = new Yoast_Plugin_License_Manager( new SP_Product_Post_Connector() );
				$license_manager->show_license_form( false );
				?>
			</div>
			<?php SP_Admin_Menu::get()->sidebar(); ?>
		</div>
	<?php
	}
}