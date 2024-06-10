<?php
			
		//Live Preview code
		if (  (isset($_GET['wpsm_coming_soon_pro_preview']) && $_GET['wpsm_coming_soon_pro_preview'] == 'true') )
		{ 		
			$file = plugin_dir_path( __FILE__ )."templates/template1/index.php";
			include($file);
			exit();
		}
		
		function wpsm_coming_soon_redirect()
		{
			$wpsm_rcs_plugin_options_dashboard = unserialize(get_option('wpsm_rcs_plugin_options_dashboard'));
			$wpsm_csp_status = $wpsm_rcs_plugin_options_dashboard['wpsm_csp_status'];
			
			if($wpsm_csp_status=="1")
			{				
				
				// phpcs:disable
				$request_uri = trailingslashit( strtolower( wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) ) );
				// phpcs:enable

				// Some URLs have to be accessible at all times.
				$white_list = array( '/wp-admin/', '/feed/', '/feed/rss/', '/feed/rss2/', '/feed/rdf/', '/feed/atom/', '/admin/', '/login/', '/wp-login.php' );

				if ( in_array( $request_uri, $white_list, true ) || false !== strpos( $request_uri, '/wp-login.php' ) ) {
					return;
				}
								
				
				// Check if user is logged in.
				if (!is_user_logged_in())
				{
					$file = plugin_dir_path( __FILE__ )."templates/template1/index.php";
					include($file);
					exit();
				}
				else
				{
					if(false === current_user_can('administrator'))
					{
						$file = plugin_dir_path( __FILE__ )."templates/template1/index.php";
						include($file);
						exit();
					}
				}
			}
			
		}
		
		add_action( 'template_redirect', 'wpsm_coming_soon_redirect' );		
		
		add_action('admin_bar_menu', 'wpsm_rcs_admin_bar_menu', 1000);
		function wpsm_rcs_admin_bar_menu()
		{			
			global $wp_admin_bar;
			$wpsm_rcs_plugin_options_dashboard = unserialize(get_option('wpsm_rcs_plugin_options_dashboard'));
			$wpsm_csp_status = $wpsm_rcs_plugin_options_dashboard['wpsm_csp_status'];
			if($wpsm_csp_status=='0') return;
			$msg = __('Coming Soon Mode Active','');
			// Add Parent Menu
			$argsParent=array(
				'id' => 'myCustomMenu',
				'title' => $msg,
				'parent' => 'top-secondary',
				'href' => '?page=wpsm_responsive_coming_soon',
				'meta'   => array( 'class' => 'wpsm_cs_active' ),
			);
			$wp_admin_bar->add_menu($argsParent);
			?>
			<style>
				.wpsm_cs_active a{
					background: #31a3dd !important;
					color: #fff !important;
				}
				.wpsm_cs_active a:hover{
					background: #31a3dd !important;
					color: #fff !important;
				}
			</style>
			<?php
		   
		}

 ?>