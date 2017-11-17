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

<div class="profile col-sm-6">

	<h2 class='section-title'>Profile</h2>

	<?php
		switch ( bp_current_action() ) :
		
			// Edit
			case 'edit'   :
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

	<div class='dropdown'>
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
  			<span class="caret"></span></button>
		<ul class='dropdown-menu'>
			<?php bp_get_options_nav(); ?>
		</ul>
	</div>

</div><!-- .profile -->

<div class='col-md-6'>
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


<?php

/**
 * Fires after the display of member profile content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_profile_content' );
