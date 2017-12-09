<?php
/**
 * BuddyPress - Users Settings
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class='col-xs-12 profile md-pad'>

	<h2 class='section-title'>Account Settings</h2>

<?php

switch ( bp_current_action() ) :
	case 'notifications'  :
		bp_get_template_part( 'members/single/settings/notifications'  );
		break;
	case 'capabilities'   :
		bp_get_template_part( 'members/single/settings/capabilities'   );
		break;
	case 'delete-account' :
		bp_get_template_part( 'members/single/settings/delete-account' );
		break;
	case 'general'        :
		bp_get_template_part( 'members/single/settings/general'        );
		break;
	case 'profile'        :
		bp_get_template_part( 'members/single/settings/profile'        );
		break;
	default:
		bp_get_template_part( 'members/single/plugins'                 );
		break;
endswitch; ?>

<div class="dropdown" id="subnav" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'buddypress' ); ?>" role="navigation">
	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style='margin-top:.5em;'>Account Settings <span class="caret"></span></button>
	<ul class='dropdown-menu'>
		<?php if ( bp_core_can_edit_settings() ) : ?>

			<?php if( bp_is_active( 'xprofile' ) ){

				bp_core_remove_subnav_item( 'settings', 'profile' );

				bp_core_remove_subnav_item( 'settings', 'capabilities' );

			} ?>

			<?php bp_get_options_nav(); ?>

		<?php endif; ?>
	</ul>
</div>

<?php $displayed_user = get_user_by('ID',bp_displayed_user_id()); ?>
<div class='clearfix'></div>
<a href="<?php echo get_home_url().'/member-directory/'.$displayed_user->user_nicename ?>" class="btn btn-default" style='margin-top:.5em;'>&larr; View Profile</a>

</div><?php
