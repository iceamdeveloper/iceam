<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' ); ?>

<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

		<?php
            
            // get the current user's info
			$user_ID = get_current_user_id();
			$member_info = get_userdata($user_ID);
			$is_admin = $user_ID !=0 && in_array('administrator',$member_info->roles);

            $profile_ID = bp_displayed_user_id();
            $user_memberships = wc_memberships_get_user_memberships($profile_ID);
            wc_memberships_is_user_active_member( $profile_ID , "5288" );
            
            /*
            * if user is an admin,
            * or the field group is "Member Fields" (group ID 1)
            * or field group is the "active diplomate membership" (group ID 3 & members)
            * or field group is the "gold diplomate membership" (group ID 6)
            */
            
            if ( $is_admin || bp_get_the_profile_group_id() == 1 || bp_get_the_profile_group_id() == 3 && wc_memberships_is_user_active_member($profile_ID,"5288") || wc_memberships_is_user_active_member($profile_ID,"5315") ): ?>

				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
				do_action( 'bp_before_profile_field_content' ); ?>

				<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

					<h3><?php bp_the_profile_group_name(); ?></h3>

					<table class="profile-fields <?php echo $user_ID; ?>">

						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

							<?php if ( bp_field_has_data() ) : ?>

								<tr<?php bp_field_css_class(); ?>>

									<td class="label"><?php bp_the_profile_field_name(); ?></td>

									<td class="data"><?php bp_the_profile_field_value(); ?></td>

								</tr>

							<?php endif; ?>

							<?php

							/**
							 * Fires after the display of a field table row for profile data.
							 *
							 * @since 1.1.0
							 */
							do_action( 'bp_profile_field_item' ); ?>

						<?php endwhile; ?>

					</table>
				</div>

				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
				do_action( 'bp_after_profile_field_content' ); ?>

			<?php endif; ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' );
