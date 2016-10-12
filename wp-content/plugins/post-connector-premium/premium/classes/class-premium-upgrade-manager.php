<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SP_Premium_Upgrade_Manager {

	/**
	 * Check if there's a plugin update
	 */
	public function check_update() {

		// Get current version
		$current_version = get_option( SP_Constants::OPTION_CURRENT_PREMIUM_VERSION, 1 );

		// Check if update is required
		if( SP_Constants::PREMIUM_VERSION_CODE > $current_version ) {

			// Do update
			$this->do_update( $current_version );

			// Update version code
			$this->update_current_version_code();

		}

	}

	/**
	 * An update is required, do it
	 *
	 * @param $current_version
	 */
	private function do_update( $current_version ) {

		/**
		 * Move the current version option, a tricky upgrade.
		 * This upgrade routine was introduced in version 1.5.2
		 */
		if( $current_version == 1 ) {

			// Get the original option and save it as the current version.
			// If there is no original option the $current_version will remain 1.
			$current_version = get_option( 'sp_current_version', 1 );

			// Only resave the version if it changed.
			if ( 1 != $current_version ) {

				// Set the new version option
				update_option( SP_Constants::OPTION_CURRENT_PREMIUM_VERSION, $current_version );

				// Delete the old version option
				delete_option( 'sp_current_version' );
			}


		}

		// < 1.5.2
		if( $current_version < 22 ) {
			/**
			 * Upgrade to version 1.5.2
			 *
			 * - Save the license key in the new option and remove the old license option
			 */

			// Resave the license key
			$license_key = get_option( 'post-connector_license', '');
			if ( '' != $license_key ) {
				update_option( 'post-connector-premium_license', $license_key );
				delete_option( 'connector_license' );
			}
		}

		// < 1.4.0
		if ( $current_version < 18 ) {

			/**
			 * Upgrade to version 1.4.0.0
			 *
			 * - Change the title of all post link to the post type link slug, see #123 for more info.
			 * - Remove 'sp_install_version' option from database, this option was and will never be used.
			 */

			// -- Remove 'sp_install_version' option from database, this option was and will never be used.
			delete_option( 'sp_install_version' );

			// -- Change the title of all post link to the post type link slug, see #123 for more info.

			// Post Type Link Manager
			$post_type_link_manager = new SP_Connection_Manager();

			// Add post title check filter
			add_filter( 'posts_clauses', array( $this, 'alter_slug_update_query' ), 10, 2 );

			// Update all link titles to new slug setup
			$post_links = get_posts( array(
					'post_type' => SP_Constants::CPT_LINK,
					'posts_per_page' => -1,
					'suppress_filters' => false,
			) );

			// Remove the check filter
			remove_filter( 'posts_clauses', array( $this, 'alter_slug_update_query' ) );

			if ( count( $post_links ) > 0 ) {

				foreach ( $post_links as $post_link ) {

					// Get Post Type Link ID
					$ptl_id = get_post_meta( $post_link->ID, 'sp_pt_link', true );

					// Check if PTL ID is != ''
					if( '' != $ptl_id ) {

						// Get the Connection object
						$ptl = $post_type_link_manager->get_connection( $ptl_id );

						// Update the post link with the new title
						wp_update_post( array(
								'ID' => $post_link->ID,
								'post_title' => 'sp_' . $ptl->get_slug()
						) );

					}

				}

			}

		}

		// < 1.5.0
		if ( $current_version < 20 ) {

			/**
			 * Upgrade to version 1.5.0
			 *
			 * - Change the title of all post link to the post type link slug, see #123 for more info.
			 * - Remove 'sp_install_version' option from database, this option was and will never be used.
			 */

			// Migrate license key and status
			$license_manager = new Yoast_Plugin_License_Manager( new SP_Product_Post_Connector() );
			$license_manager->set_license_key( get_option( 'subposts_license_key', '' ) );
			$license_manager->set_license_status( get_option( 'subposts_license_status', '' ) );

		}

	}

	/**
	 * Filter that alters the query that runs for the slug update process
	 *
	 * @param $clauses
	 * @param $wp_query
	 *
	 * @return mixed
	 */
	public function alter_slug_update_query( $clauses, $wp_query ) {
		global $wpdb;
		$clauses['where'] .= " AND ( {$wpdb->posts}.post_title = 'Sub Posts Link' )";
		return $clauses;
	}

	/**
	 * Update the current version code
	 */
	private function update_current_version_code() {
		update_option( SP_Constants::OPTION_CURRENT_PREMIUM_VERSION, SP_Constants::PREMIUM_VERSION_CODE );
	}

}