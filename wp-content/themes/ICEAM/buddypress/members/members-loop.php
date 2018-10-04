<!-- ICEAM members loop -->

<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>



<?php do_action( 'bp_before_members_loop' ); ?>

<?php
    // force alphabetical sort by default
    if(bp_ajax_querystring( 'members' ) != "" && strrpos( bp_ajax_querystring( 'members' ), "type") === false){
        $queryString = bp_ajax_querystring( 'members' ) . "&type=alphabetical";
    } else {
        $queryString = bp_ajax_querystring( 'members' );
    }
?>

<?php if ( bp_has_members( $queryString ) ) : ?>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

	<div id="members-list" class="row" role="main">

	<?php while ( bp_members() ) : bp_the_member(); ?>

		<?php 
			// $diplomate = false;
			// $user_ID = bp_get_member_user_id();
			// $user_data = get_userdata( $user_ID );

			// if(!empty( $user_data->roles )){
			// 	foreach ($user_data->roles as $role) {
			// 		if($role == 'diplomate'){ $diplomate = true; }
			// 	}
				
			// }

			// if($diplomate):

		?>
	
		<div class="col-xs-6 col-sm-3">
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=600&height=600'); ?></a>
			</div>
	
			<div class="item">
				<div class="item-title">
					<p><a href="<?php bp_member_permalink(); ?>"><?php echo bp_members_get_user_nicename(bp_get_member_user_id()); ?></a></p>
					
					<?php
						$location = "";
						
						if ($city = xprofile_get_field_data( 'Practice Location: City', bp_get_member_user_id() )){
							$location .= $city;
						}
						if ($state = xprofile_get_field_data( 'Practice Location: State', bp_get_member_user_id() )){
							if($city){
								$location .= ", ";
							}
							$location .= $state;
						}
						
						if($location != ""){
					?>
						<div class="profile_fields"><?php echo $location; ?></div>
					<?php } ?>
					
					
					
					<?php if ( bp_get_member_latest_update() ) : ?>
	
						<span class="update"> <?php bp_member_latest_update(); ?></span>
	
					<?php endif; ?>
	
				</div>
	
				<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>
	
				<?php do_action( 'bp_directory_members_item' ); ?>
	
				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				?>
			</div>
	
			<div class="action">
	
				<?php do_action( 'bp_directory_members_actions' ); ?>
	
			</div>
	
			<div class="clear"></div>
		</div>

	<?php //endif; ?>

	<?php endwhile; ?>

	</div> <!-- #members-list -->

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found. Please be patient as we learn about our site members!", 'buddypress' ); ?>
        <?php
            $current_user = wp_get_current_user();
            $name = $current_user->user_login;
        ?>
        <br/><br/>Haven't completed <em>your</em> profile yet? We'd love for you to <a href="<?php echo "/practitioner-directory/$name/profile/edit/" ?>">fill it out now</a>!
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>
