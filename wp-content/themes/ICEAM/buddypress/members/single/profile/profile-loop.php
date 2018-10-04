<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_before_profile_loop_content' ); ?>

<?php 
$membership_ID_1 = "8222"; 
$membership_ID_2 = "8218";
?>

<?php

// get the current user's info
$user_ID = get_current_user_id();
$member_info = get_userdata($user_ID);
$is_admin = $user_ID !=0 && in_array('administrator',$member_info->roles);

$profile_ID = bp_displayed_user_id();
$user_memberships = wc_memberships_get_user_memberships($profile_ID);
wc_memberships_is_user_active_member( $profile_ID , $membership_ID_1 ); 

//no membership
$mem_name = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'1' ) ); 
$mem_lisence_state = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'6' ) ); 
$mem_school_name = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'15' ) ); 
//silver
$mem_city = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'25' ) ); 
$mem_state = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'26' ) ); 
$mem_country = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'27' ) ); 
//gold
$mem_bio = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'28' ) ); 
$mem_edu = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'29' ) ); 
$mem_lisences = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'30' ) ); 
$mem_dipdate = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'31' ) ); 
$mem_email = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'32' ) ); 
//practice
$mem_prac_photo = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'33' ) ); 
$mem_prac_name = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'34' ) ); 
$mem_prac_ad1 = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'35' ) ); 
$mem_prac_ad2 = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'36' ) ); 
$mem_prac_city = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'37' ) ); 
$mem_prac_state = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'38' ) ); 
$mem_prac_zip = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'39' ) ); 
$mem_prac_country = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'41' ) ); 
$mem_prac_url = bp_get_profile_field_data( array('user_id'=>bp_get_member_user_id(),'field'=>'40' ) ); 

?>

<?php if ( bp_has_profile() ) : ?>

	<!-- Automatic Fields -->
	<h3 class='profile-subheader'><?php echo $mem_name; ?></h3>
	<?php if($mem_school_name!==''){ ?><p style='margin:0;'><strong>School Name: </strong><?php echo $mem_school_name; ?></p><?php } ?>
<!-- 	<?php if( $mem_lisence_state!=='' && !wc_memberships_is_user_active_member($profile_ID,$membership_ID_1) && !wc_memberships_is_user_active_member( $profile_ID , $membership_ID_2 ) ) { 
		?><p><strong>Lisence State: </strong><?php echo $mem_lisence_state; ?></p><?php 
	} ?> -->
	<!-- Silver Fields -->
	<?php if(wc_memberships_is_user_active_member($profile_ID,$membership_ID_1)||wc_memberships_is_user_active_member( $profile_ID , $membership_ID_2 )){
	$member_location_info = '';
		if($mem_city!==''){ 
			$member_location_info .= '<p>'.$mem_city.', ';
		}
		if($mem_state!==''){ 
			$member_location_info .= $mem_state.' '; 
		}
		if($mem_country!==''){ 
			$member_location_info .= $mem_country.'</p>'; 
		}
		echo $member_location_info;
	} ?>
	<!-- Gold Fields -->
	<?php if(wc_memberships_is_user_active_member( $profile_ID , $membership_ID_2 )){ ?>
		<?php if($mem_bio!==''){ ?><p><strong>Bio:</strong><br><?php echo $mem_bio; ?></p><?php } ?>
		<?php if($mem_edu!==''){ ?><p><strong>Education:</strong><br><?php echo $mem_edu; ?></p><?php } ?>
		<?php if($mem_lisences!==''){ ?><p><strong>Professional Lisences:</strong><br><?php echo $mem_lisences; ?></p><?php } ?>
		<?php if($mem_dipdate!==''){ ?><p><strong>Diplomate Date:</strong><br><?php echo $mem_dipdate; ?></p><?php } ?>
		<?php if($mem_email!==''){ ?><p><strong>Email:</strong><br><?php echo $mem_email; ?></p><?php } ?>

		<h2 class="section-title">Practice Information</h2>

		<?php if($mem_prac_photo!==''){ ?><?php echo $mem_prac_photo; ?><?php } ?>
		<?php if($mem_prac_name!==''){ ?><h3 class='profile-subheader'><?php echo $mem_prac_name; ?></h3><?php } ?>
		<?php $member_practice_location_info = '<p>';

			if($mem_prac_ad1!==''){
				$member_practice_location_info .= $mem_prac_ad1.'<br>';
			}
			if($mem_prac_ad2!==''){
				$member_practice_location_info .= $mem_prac_ad2.'<br>';
			}
			if($mem_prac_city!==''){ 
				$member_practice_location_info .= $mem_prac_city.', ';
			}
			if($mem_prac_state!==''){ 
				$member_practice_location_info .= $mem_prac_state.' '; 
			}
			if($mem_prac_zip!==''){ 
				$member_practice_location_info .= $mem_prac_zip.'<br>'; 
			}
			if($mem_prac_country!==''){ 
				$member_practice_location_info .= $mem_prac_country; 
			}
			$member_practice_location_info .= '</p>';

		echo $member_practice_location_info; ?>

		<?php if($mem_prac_url!==''){ ?><?php echo $mem_prac_url; ?><?php } ?>

	<?php } ?>

	<hr>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action( 'bp_after_profile_loop_content' );
