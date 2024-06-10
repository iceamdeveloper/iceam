<?php 
if(isset($_POST['security'])) 
{
	if ( wp_verify_nonce( $_POST['security'], 'csp_security_action_nonce' ) )
	{	
		if(isset($_POST['action_rcs']) == "action_rcs_page_setting_save_post")
		{

			
			$hook = sanitize_text_field($_POST['hook']);			
			
			if($hook=="dashboard"){
				$wpsm_rcs_plugin_options_dashboard = array( 'wpsm_csp_status' => sanitize_text_field($_POST['wpsm_csp_status']) );
				update_option("wpsm_rcs_plugin_options_dashboard", serialize($wpsm_rcs_plugin_options_dashboard));
			}
			
			if($hook=="general"){		
	
				$wpsm_rcs_plugin_options_general = array( 
				'rcsp_logo_url' => sanitize_text_field($_POST['rcsp_logo_url']),
				'logo_width' => sanitize_text_field($_POST['logo_width']),
				'logo_height' => sanitize_text_field($_POST['logo_height']),
				'logo_enable' => sanitize_text_field($_POST['logo_enable']),
				'rcsp_headline' => sanitize_text_field($_POST['rcsp_headline']),
				'rcsp_description' => wp_kses_post($_POST['rcsp_description']),
				'home_sec_link_txt' => sanitize_text_field($_POST['home_sec_link_txt']),
				);
				
				update_option("wpsm_rcs_plugin_options_general", serialize($wpsm_rcs_plugin_options_general));
				
			}
			
			if($hook=="header"){	
	
				$wpsm_rcs_plugin_options_header = array( 
					'favicon' => sanitize_text_field($_POST['favicon']),
					'meta_title' => sanitize_text_field($_POST['meta_title']),
					'meta_desc' => wp_kses_post($_POST['meta_desc']),
					'google_al' => wp_kses_post($_POST['google_al']),
				);
				
				update_option("wpsm_rcs_plugin_options_header", serialize($wpsm_rcs_plugin_options_header));
			
			}
				if($hook=="countdown"){	
			
				$wpsm_rcs_plugin_options_countdown = array( 
					'countdown_enable' =>sanitize_text_field($_POST['countdown_enable']),
					'countdown_date' => sanitize_text_field($_POST['countdown_date']),
					'countdown_time' => sanitize_text_field($_POST['countdown_time']),
					'days' => sanitize_text_field($_POST['days']),
					'hours' => sanitize_text_field($_POST['hours']),
					'minutes' => sanitize_text_field($_POST['minutes']),
					'seconds' => sanitize_text_field($_POST['seconds']),
				);
				
				update_option("wpsm_rcs_plugin_options_countdown", serialize($wpsm_rcs_plugin_options_countdown));		
			}
	
			if($hook=="background"){	
			
				$wpsm_rcs_plugin_options_background = array( 
					'select_background' => sanitize_text_field($_POST['select_background']),
					'background_color' => sanitize_text_field($_POST['background_color']),
					'bg_effect' => sanitize_text_field($_POST['bg_effect']),
					'background_color_overlay' => sanitize_text_field($_POST['background_color_overlay']),
					'background_image' => sanitize_text_field($_POST['background_image']),
					'bg_slideshow_no' => sanitize_text_field($_POST['bg_slideshow_no']),
					'background_slides_0' => sanitize_text_field($_POST['background_slides_0']),
					'background_slides_1' => sanitize_text_field($_POST['background_slides_1']),
					'background_slides_2' => sanitize_text_field($_POST['background_slides_2']),
					'background_slides_3' => sanitize_text_field($_POST['background_slides_3']),
					'background_slides_4' => sanitize_text_field($_POST['background_slides_4']),
				);
				
				update_option("wpsm_rcs_plugin_options_background", serialize($wpsm_rcs_plugin_options_background));		
			}
			if($hook=="text_and_color"){
			
				$wpsm_rcs_plugin_options_text_and_color = array( 
					'headeline_ft_clr' => sanitize_hex_color($_POST['headeline_ft_clr']),
					'desc_ft_clr' => sanitize_hex_color($_POST['desc_ft_clr']),
					'sb_btn_ft_clr' => sanitize_hex_color($_POST['sb_btn_ft_clr']),
					'sb_btn_bg_clr' => sanitize_hex_color($_POST['sb_btn_bg_clr']),
					'cnd_timer_clr' => sanitize_hex_color($_POST['cnd_timer_clr']),
					'social_icon_clr' => sanitize_hex_color($_POST['social_icon_clr']),
					'social_icon_bg_clr' => sanitize_hex_color($_POST['social_icon_bg_clr']),
					'ext_ft_clr' => sanitize_hex_color($_POST['ext_ft_clr']),
					'ext_bg_clr' => sanitize_hex_color($_POST['ext_bg_clr']),
					'headline_ft_size' => sanitize_text_field($_POST['headline_ft_size']),
					'desc_ft_size' => sanitize_text_field($_POST['desc_ft_size']),
					'headlines_ft_stl' => sanitize_text_field($_POST['headlines_ft_stl']),
					'desc_ft_stl' => sanitize_text_field($_POST['desc_ft_stl']),
					'other_ft_stl' => sanitize_text_field($_POST['other_ft_stl']),
				);
				
				update_option("wpsm_rcs_plugin_options_text_and_color", serialize($wpsm_rcs_plugin_options_text_and_color));	
			}
			
			if($hook=="custom_css"){	
				
				$wpsm_rcs_plugin_options_custom_css = array( 
					'custom_css' => wp_kses_post($_POST['custom_css']),
					
				);				
				update_option("wpsm_rcs_plugin_options_custom_css", serialize($wpsm_rcs_plugin_options_custom_css));
				
			}
			
		 	if($hook=="about_us")
			{	
				$wpsm_rcs_plugin_options_about_us = array( 
					'about_us_enable' => sanitize_text_field($_POST['about_us_enable']),
					'about_btn_label' => sanitize_text_field($_POST['about_btn_label']),
					'about_section_title' => wp_kses_post($_POST['about_section_title']),
					'about_section_desc' => wp_kses_post($_POST['about_section_desc']),
					
				);
				
				update_option("wpsm_rcs_plugin_options_about_us", serialize($wpsm_rcs_plugin_options_about_us));	
			
			} 
			if($hook=="contact_us"){	

				$wpsm_rcs_plugin_options_contact_us = array( 
					'contact_us_enable' => sanitize_text_field($_POST['contact_us_enable']),
					'contact_us_section_btn_label' => sanitize_text_field($_POST['contact_us_section_btn_label']),
					'contact_us_section_title' => sanitize_text_field($_POST['contact_us_section_title']),
					'contact_us_section_title_desc' => wp_kses_post($_POST['contact_us_section_title_desc']),
					'contact_info_address' => sanitize_text_field($_POST['contact_info_address']),
					'contact_info_number' => sanitize_text_field($_POST['contact_info_number']),
					'contact_info_email_address' => sanitize_email($_POST['contact_info_email_address']),
					
				);
				
				update_option("wpsm_rcs_plugin_options_contact_us", serialize($wpsm_rcs_plugin_options_contact_us));
			}
			
			if($hook=="newsletter"){	
		
				$wpsm_rcs_plugin_options_newsletter = array( 
					'wpsm_rcs_newsletter_dropdown' => sanitize_text_field($_POST['wpsm_rcs_newsletter_dropdown']),
					'to_subs_mail_sub' => sanitize_text_field($_POST['to_subs_mail_sub']),
					'to_subs_mail_msg' => wp_kses_post($_POST['to_subs_mail_msg']),
					'to_admin_mail_sub' =>sanitize_text_field($_POST['to_admin_mail_sub']),
					'to_admin_mail_msg' => wp_kses_post($_POST['to_admin_mail_msg']),
					'email_add_of_admin' => sanitize_email($_POST['email_add_of_admin']),				
					
				);
				
				update_option("wpsm_rcs_plugin_options_newsletter", serialize($wpsm_rcs_plugin_options_newsletter));
			
			}
			if($hook=="subscription_field"){
				$wpsm_rcs_plugin_options_subscription_field = array( 
					'subscription_field_link_button_label' => sanitize_text_field($_POST['subscription_field_link_button_label']),
					'subscription_field_section_title' => sanitize_text_field($_POST['subscription_field_section_title']),				
					'email_field_pl_hold_text' => sanitize_text_field($_POST['email_field_pl_hold_text']),
					'subs_me_button_label' => sanitize_text_field($_POST['subs_me_button_label']),
					'success_subs_notification_text' => sanitize_text_field($_POST['success_subs_notification_text']),
					'invalid_email_notification_text' => sanitize_text_field($_POST['invalid_email_notification_text']),					
					
				);
				
				update_option("wpsm_rcs_plugin_options_subscription_field", serialize($wpsm_rcs_plugin_options_subscription_field));

			}	
			
			if($hook=="social"){
				$saved_array = array();
				$social_array = $_POST['social'];				
				foreach($social_array as $val)	{
					$saved_array[] = esc_url($val);
				}
				$wpsm_rcs_plugin_options_social = array( 
					'social' => $saved_array,
					'social_icon' => array('fa-facebook','fa-twitter','fa-linkedin','fa-instagram','fa-youtube-play','fa-pinterest-p'),
					'social_name' => array('facebook','twitter','linkedin','instagram','youtube','pinterest'),
					
				);
					
				update_option("wpsm_rcs_plugin_options_social", serialize($wpsm_rcs_plugin_options_social));			
			}			
			
		}	
		
	}
}	
?>