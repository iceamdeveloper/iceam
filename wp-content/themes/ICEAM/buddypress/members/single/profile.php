<?php
/**
 * BuddyPress - Users Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of member profile content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_profile_content' ); ?>
<div class='col-xs-12 profile no-pad'>

<div class="col-sm-<?php if( !is_user_logged_in() || bp_current_action() !== 'public' ){echo '8'; } else { echo '6'; } ?>">

	<?php
		switch ( bp_current_action() ) :
		
			// Edit
			case 'edit'   :
				echo "<h2 class='section-title'>Edit Profile</h2>";
				bp_get_template_part( 'members/single/profile/edit' );
				break;
		
			// Change Avatar
			case 'change-avatar' :
				bp_get_template_part( 'members/single/profile/change-avatar' );
				break;
		
			// Change Cover Image
			case 'change-cover-image' :
				bp_get_template_part( 'members/single/profile/change-cover-image' );
				break;
		
			// Compose
			case 'public' :

				echo "<h2 class='section-title'>Profile</h2>";
		
				// Display XProfile
				if ( bp_is_active( 'xprofile' ) )
					bp_get_template_part( 'members/single/profile/profile-loop' );
		
				// Display WordPress profile (fallback)
				else
					bp_get_template_part( 'members/single/profile/profile-wp' );
		
				break;
		
			// Any other
			default :
				bp_get_template_part( 'members/single/plugins' );
				break;
		endswitch;
	?>

	<?php if( bp_is_my_profile() || current_user_can('administrator') ): ?>
	
	<div class='dropdown'>
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style='margin-top:.5em;'>Manage my Profile
  			<span class="caret"></span></button>
		<ul class='dropdown-menu'>
			<?php bp_get_options_nav(); ?>
			<?php $displayed_user = get_user_by('ID',bp_displayed_user_id()); ?>
			<li><a href="<?php echo get_home_url().'/member-directory/'.$displayed_user->user_nicename.'/settings'?>">Account Settings</a></li>
		</ul>
	</div>
	
	<?php endif; ?>

</div><!-- .profile -->

<?php if( is_user_logged_in() && bp_current_action() == 'public' ): ?>

<div class='col-sm-6'>

	<h2 class='section-title'>Forum Activity</h2>
	
	<h3>Recent Topics</h3>
	
	<div id="bbpress-forums">
        <?php
			if ( bbp_get_user_topics_started() ) {
				bbp_get_template_part( 'loop', 'topics' );
			} else {
		?>
			<p><?php bbp_is_user_home() ? _e( 'You have not created any topics.', 'bbpress' ) : _e( 'This user has not created any topics.', 'bbpress' ); ?></p>
		<?php } ?>
    </div>
	
	<hr/>
	
	<h3>Recent Topic Replies</h3>
	
	<div id="bbpress-forums">
		<?php
			if ( bbp_get_user_replies_created() ) {
				bbp_get_template_part( 'loop', 'replies' );	
			} else {
		?>
			<p><?php bbp_is_user_home() ? _e( 'You have not replied to any topics.', 'bbpress' ) : _e( 'This user has not replied to any topics.', 'bbpress' ); ?></p>
		<?php } ?>
	</div>
	
	<p><a href="forums" class="btn btn-default">See All Forum Activity</a></p>
	
</div>

<?php endif; ?>

</div>


<?php

/**
 * Fires after the display of member profile content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_profile_content' );
