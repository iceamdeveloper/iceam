<?php
/**
 * BuddyPress - Members Home
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the display of member home content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_member_home_content' ); ?>

	<div id="item-header" role="complementary">

		<?php
		/**
		 * If the cover image feature is enabled, use a specific header
		 */
		if ( bp_displayed_user_use_cover_image_header() ) :
			bp_get_template_part( 'members/single/cover-image-header' );
		else :
			bp_get_template_part( 'members/single/member-header' );
		endif;
		?>

	</div><!-- #item-header -->

	<div id="item-nav">
		<div class="item-list-tabs no-ajax" id="object-nav" aria-label="<?php esc_attr_e( 'Member primary navigation', 'buddypress' ); ?>" role="navigation">
			<ul>

				<?php //bp_get_displayed_user_nav(); ?>

				<?php

				/**
				 * Fires after the display of member options navigation.
				 *
				 * @since 1.2.4
				 */
				do_action( 'bp_member_options_nav' ); ?>

			</ul>
		</div>
	</div><!-- #item-nav -->

	<div id="item-body">

		<?php

		/**
		 * Fires before the display of member body content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_body' );

		if ( bp_is_user_front() ) :
			bp_displayed_user_front_template_part();
			echo '<!--num1-->';

		elseif ( bp_is_user_activity() ) :
			bp_get_template_part( 'members/single/activity' );
			echo '<!--num2-->';

		elseif ( bp_is_user_blogs() ) :
			bp_get_template_part( 'members/single/blogs'    );
			echo '<!--num3-->';

		elseif ( bp_is_user_friends() ) :
			bp_get_template_part( 'members/single/friends'  );
			echo '<!--num4-->';

		elseif ( bp_is_user_groups() ) :
			bp_get_template_part( 'members/single/groups'   );
			echo '<!--num5-->';

		elseif ( bp_is_user_messages() ) :
			bp_get_template_part( 'members/single/messages' );
			echo '<!--num6-->';

		elseif ( bp_is_user_profile() ) :
			bp_get_template_part( 'members/single/profile'  );
			echo '<!--num7-->';

		elseif ( bp_is_user_forums() ) :
			bp_get_template_part( 'members/single/forums'   );
			echo '<!--num8-->';

		elseif ( bp_is_user_notifications() ) :
			bp_get_template_part( 'members/single/notifications' );
			echo '<!--num10-->';

		elseif ( bp_is_user_settings() ) :
			bp_get_template_part( 'members/single/settings' );
			echo '<!--num11-->';

		// If nothing sticks, load a generic template
		else :
			bp_get_template_part( 'members/single/plugins'  );
			echo '<!--num12-->';

		endif;

		/**
		 * Fires after the display of member body content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_body' ); ?>

		</div><!--end column-->

	</div><!-- #item-body -->

	<?php

	/**
	 * Fires after the display of member home content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_member_home_content' ); ?>

</div><!-- #buddypress -->
