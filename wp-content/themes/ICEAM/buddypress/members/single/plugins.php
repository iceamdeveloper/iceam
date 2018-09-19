<?php
/**
 * BuddyPress - Users Plugins Template
 *
 * 3rd-party plugins should use this template to easily add template
 * support to their plugins for the members component.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

		/**
		 * Fires at the start of the member plugin template.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_plugin_template' ); ?>
		
		<div class='col-xs-12 profile md-pad'>

		<?php if ( has_action( 'bp_template_title' ) ) : ?>
			<h3><?php

			/**
			 * Fires inside the member plugin template <h3> tag.
			 *
			 * @since 1.0.0
			 */
			do_action( 'bp_template_title' ); ?></h3>

		<?php endif; ?>

		<?php

		/**
		 * Fires and displays the member plugin template content.
		 *
		 * @since 1.0.0
		 */
		do_action( 'bp_template_content' ); ?>

		<?php if ( ! bp_is_current_component_core() ) : ?>

		<div class="dropdown" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'buddypress' ); ?>" role="navigation">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style='margin-top:.5em;'>Other Forum Activity <span class="caret"></span></button>
			<ul class='dropdown-menu'>
				<?php bp_get_options_nav(); ?>

				<?php

				/**
				 * Fires inside the member plugin template nav <ul> tag.
				 *
				 * @since 1.2.2
				 */
				do_action( 'bp_member_plugin_options_nav' ); ?>
			</ul>
		</div><!-- .item-list-tabs -->
		<?php $displayed_user = get_user_by('ID',bp_displayed_user_id()); ?>
		<div class='clearfix'></div>
		<a href="<?php echo get_home_url().'/member-directory/'.$displayed_user->user_nicename ?>" class="btn btn-default" style='margin-top:.5em;'>&larr; View Profile</a>

		<?php endif; ?>

		<?php

		/**
		 * Fires at the end of the member plugin template.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_plugin_template' );

		?></div<?php
