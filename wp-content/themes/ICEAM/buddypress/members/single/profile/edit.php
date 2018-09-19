<?php do_action( 'bp_before_profile_edit_content' );


$membership_ID_1 = "8222"; 
$membership_ID_2 = "8218";


if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	while ( bp_profile_groups() ) : bp_the_profile_group();
    
    if (function_exists("wc_memberships_is_user_active_member")){
        echo "<!-- group: " . bp_get_current_profile_group_id() . " -->";
    }

    //only display profile fields groups that the user is subscribed to
    function filter_profile_tabs( $tabs, $groups, $group_name ){
            
        // get the current user's info
        $user_ID = get_current_user_id();
        $member_info = get_userdata($user_ID);

        unset($tabs);
        $tabs[] = '';

        if( wc_memberships_is_user_active_member( null ,$membership_ID_1) ){
            $active_diplomate = true;
        } else { $active_diplomate = false; }
        if( wc_memberships_is_user_active_member( null ,$membership_ID_2) ){
            $gold_diplomate = true;
        } else { $gold_diplomate = false; }
        if( in_array('administrator',$member_info->roles) ){
            $is_admin = true;
        } else { $is_admin = false; }

        for ( $i = 0, $count = count( $groups ); $i < $count; ++$i ) {

            $current_id = $groups[$i]->id;

            // Setup the selected class.
            $selected = '';
            if ( $group_name === $groups[ $i ]->name ) {
              $selected = ' class="current"';
            }

            // Skip if group has no fields.
            if ( empty( $groups[ $i ]->fields ) 
                || !$gold_diplomate && !$active_diplomate && $current_id == 3 && !$is_admin 
                || !$gold_diplomate && $current_id == 6 && !$is_admin 
                || !$gold_diplomate && $current_id == 7 && !$is_admin ) {
              continue;
            }

            // Build the profile field group link.
            $link   = trailingslashit( bp_displayed_user_domain() . bp_get_profile_slug() . '/edit/group/' . $groups[ $i ]->id );

            // Add tab to end of tabs array.
            $tabs[] = sprintf(
              '<li %1$s><a href="%2$s">%3$s</a></li>',
              $selected,
              esc_url( $link ),
              esc_html( apply_filters( 'bp_get_the_profile_group_name', $groups[ $i ]->name ) )
            );
          }

        return $tabs;
    }

?>

<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug(); ?>">

	<?php do_action( 'bp_before_profile_field_content' ); ?>

        <?php add_filter('xprofile_filter_profile_group_tabs','filter_profile_tabs', 10, 3 ); ?>

		<h4><?php printf( __( "Editing '%s' Profile Group", "buddypress" ), bp_get_the_profile_group_name() ); ?></h4>
        
        <?php 
            // get the current user's info
            $user_ID = get_current_user_id();
            $member_info = get_userdata($user_ID);
        ?>		

        <?php if( in_array('administrator',$member_info->roles) || wc_memberships_is_user_active_member(null,$membership_ID_1) || wc_memberships_is_user_active_member(null,$membership_ID_2) ): ?>
        <div class='dropdown'>
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Member Profile Fields <span class="caret"></span></button>	
			<ul class="dropdown-menu">
				<?php bp_profile_group_tabs(); ?>
			</ul>
		</div>
        <?php endif; ?>

		<div class="clear"></div>

        

            <?php 

            /*
            * if user is an admin,
            * or the field group is "Member Fields" (group ID 1)
            * or field group is the "active diplomate membership" (group ID 3)
            * or field group is the "gold diplomate membership" (group ID 6)
            */
            
            if (in_array('administrator',$member_info->roles) || bp_get_current_profile_group_id() == 1 || bp_get_current_profile_group_id() == 3 && wc_memberships_is_user_active_member(null,$membership_ID_1) || wc_memberships_is_user_active_member(null,$membership_ID_2) ): ?>
    
                <?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
        
                    <div<?php bp_field_css_class( 'editfield' ); ?>>
        
                        <?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>
        
                            <label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
                            <input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
        
                        <?php endif; ?>
        
                        <?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>
        
                            <label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
                            <textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
        
                        <?php endif; ?>
        
                        <?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>
        
                            <label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
                            <select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
                                <?php bp_the_profile_field_options(); ?>
                            </select>
        
                        <?php endif; ?>
        
                        <?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>
        
                            <label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
                            <select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" multiple="multiple" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
        
                                <?php bp_the_profile_field_options(); ?>
        
                            </select>
        
                            <?php if ( !bp_get_the_profile_field_is_required() ) : ?>
        
                                <a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name(); ?>' );"><?php _e( 'Clear', 'buddypress' ); ?></a>
        
                            <?php endif; ?>
        
                        <?php endif; ?>
        
                        <?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>
        
                            <div class="radio">
                                <span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>
        
                                <?php bp_the_profile_field_options(); ?>
        
                                <?php if ( !bp_get_the_profile_field_is_required() ) : ?>
        
                                    <a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name(); ?>' );"><?php _e( 'Clear', 'buddypress' ); ?></a>
        
                                <?php endif; ?>
                            </div>
        
                        <?php endif; ?>
        
                        <?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>
        
                            <div class="checkbox">
                                <span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>
        
                                <?php bp_the_profile_field_options(); ?>
                            </div>
        
                        <?php endif; ?>
        
                        <?php if ( 'image' == bp_get_the_profile_field_type() ) : ?>
        
							<?php
							if (class_exists('Bxcft_Field_Type_Image')){
								$profile_image = new Bxcft_Field_Type_Image();
								$profile_image->edit_field_html();
								echo "<hr>";
							}
							?>
        
                        <?php endif; ?>
        
                        <?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>
        
                            <div class="datebox">
                                <label for="<?php bp_the_profile_field_input_name(); ?>_day"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
        
                                <select name="<?php bp_the_profile_field_input_name(); ?>_day" id="<?php bp_the_profile_field_input_name(); ?>_day" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
        
                                    <?php bp_the_profile_field_options( 'type=day' ); ?>
        
                                </select>
        
                                <select name="<?php bp_the_profile_field_input_name(); ?>_month" id="<?php bp_the_profile_field_input_name(); ?>_month" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
        
                                    <?php bp_the_profile_field_options( 'type=month' ); ?>
        
                                </select>
        
                                <select name="<?php bp_the_profile_field_input_name(); ?>_year" id="<?php bp_the_profile_field_input_name(); ?>_year" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
        
                                    <?php bp_the_profile_field_options( 'type=year' ); ?>
        
                                </select>
                            </div>
        
                        <?php endif; ?>
        
                        <?php if ( 'url' == bp_get_the_profile_field_type() ) : ?>
        
                            <label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
                            <input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
        
                        <?php endif; ?>
        
                        <?php do_action( 'bp_custom_profile_edit_fields_pre_visibility' ); ?>
        
                        <?php if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
                            <p class="field-visibility-settings-toggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
                                <?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'buddypress' ), bp_get_the_profile_field_visibility_level_label() ) ?> <a href="#" class="visibility-toggle-link"><?php _e( 'Change', 'buddypress' ); ?></a>
                            </p>
        
                            <div class="field-visibility-settings" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">
                                <fieldset>
                                    <legend><?php _e( 'Who can see this field?', 'buddypress' ) ?></legend>
        
                                    <?php bp_profile_visibility_radio_buttons() ?>
        
                                </fieldset>
                                <a class="field-visibility-settings-close" href="#"><?php _e( 'Close', 'buddypress' ) ?></a>
                            </div>
                        <?php else : ?>
                            <div class="field-visibility-settings-notoggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
                                <?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'buddypress' ), bp_get_the_profile_field_visibility_level_label() ) ?>
                            </div>
                        <?php endif ?>
        
                        <?php do_action( 'bp_custom_profile_edit_fields' ); ?>
        
                        <p class="description"><?php bp_the_profile_field_description(); ?></p>
                    </div>
        
                <?php endwhile; ?>
                
            <?php else: ?>
                <p>&nbsp;</p>
                <p>These fields are only available to active members.</p>
            <?php endif; ?>

	<?php do_action( 'bp_after_profile_field_content' ); ?>

	<div class="submit">
		<input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

</form>

<?php endwhile; endif; ?>

<?php do_action( 'bp_after_profile_edit_content' ); ?>
