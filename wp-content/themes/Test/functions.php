<?php

/*
*
*
*	Known Issues:
*
*
 */


 

/***********************************************************************
 *
 *	ENQUEUE STYLESHEET(S)
 *
 **********************************************************************/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css?v=1' );
    
    // load the theme stylesheet here instead of in parent theme
    wp_deregister_style('theme-stylesheet');
	wp_dequeue_style( 'theme-stylesheet' );

	$rand = rand( 0, 999999999999 );
    wp_register_style( 'theme-stylesheet', get_stylesheet_uri(), array(), $rand, 'all' );
	wp_enqueue_style( 'theme-stylesheet');
}



 
/***********************************************************************
 *
 *	ADD COLOR TO THE ADMIN LEFT NAV FOR SCANNABILITY
 *
 **********************************************************************/
 
function admin_style() {
	wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


/***********************************************************************
 *
 *	LOAD WIDGETS
 *
 **********************************************************************/

locate_template( 'widget-course-events.php', TRUE, TRUE );
locate_template( 'widget-course-signup.php', TRUE, TRUE );


/***********************************************************************
 *
 *	REMOVE WORDPRESS EMOJI
 *
 **********************************************************************/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );



/***********************************************************************
 *
 *	CHANGE EXCERPT LENGTH
 *
 **********************************************************************/

function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/***********************************************************************
 *
 *	DON'T ALLOW USERS TO SIGN UP FOR COURSES THAT DO NOT
 *	HAVE A WOOCOMMERCE PRODUCT ASSOCIATED WITH THEM
 *
 **********************************************************************/

add_filter( 'sensei_display_start_course_form', __return_false);



 

/***********************************************************************
 *
 *	FILTER HOW MANY FORUM TOPICS AND REPLIES DISPLAY ON USER PROFILE PAGES
 *
 **********************************************************************/

function filter_bbp_get_topics_per_page( $retval, $default ) {
    if (bbp_is_single_user()){
        return 5;
    }
    
    return $retval;
}; 
add_filter( 'bbp_get_topics_per_page', 'filter_bbp_get_topics_per_page', 100, 2 );

function filter_bbp_get_replies_per_page( $retval, $default ) {
    if (bbp_is_single_user()){
        return 5;
    }
    
    return $retval;
}; 
add_filter( 'bbp_get_replies_per_page', 'filter_bbp_get_replies_per_page', 100, 2 );





/***********************************************************************
 *
 *	ENSURE THAT ADAPTIVE PAYMENT RECIPIENTS ARE INCLUDED ON
 *	NEW ORDER EMAILS WITH ORDER DETAILS
 *
 **********************************************************************/

function add_adaptive_recipients($recipient, $order){
	// for some reason this filter is run on the WooCommerce > Emails settings page.
	// However, in this context, the order object for the email is not set
	// so detect if this is an admin page and, if so, kill the operation
	$page = $_GET['page'] = isset( $_GET['page'] ) ? $_GET['page'] : '';
	if ( 'wc-settings' === $page ) {
		return $recipient; 
	}
	
	if ( sizeof( $order->get_items() ) > 0 ) {
		foreach ( $order->get_items() as $item ) {
			if ( $item['qty'] ) {
				$product_id        = $item['product_id'];
				$product_receivers = get_post_meta( $product_id, '_paypal_adaptive_receivers', true );
				$product_receivers = array_filter( explode( PHP_EOL, $product_receivers ) );

				if ( ! is_array( $product_receivers ) || empty( $product_receivers ) ) {
					continue;
				}
				

				foreach ( $product_receivers as $receiver ) {
					$receiver = array_map( 'sanitize_text_field', array_filter( explode( '|', $receiver ) ) );
					if ( ! is_array( $receiver ) || empty( $receiver ) ) {
						continue;
					}
					
					$recipient .= ', ' . $receiver[0];
				}
			}
		}
	}
	
	return $recipient;
}
add_filter("woocommerce_email_recipient_new_order","add_adaptive_recipients",20,2);



/**
* Disables the public attendee lists on all events
*
* Removes the tribe_events_single_event_after_the_meta action that injects the attendee
* list that was introduced with the initial 4.1 release of Event Tickets Plus
*/

add_filter( 'tribe_tickets_plus_hide_attendees_list', '__return_true' );



 
/***********************************************************************
 *
 *	SHOW ONLY DIPLOMATES IN PRACTITIONERS DIRECTORY
 *
 **********************************************************************/

 
add_action('bp_ajax_querystring','member_dir_exclude_users',20,2);
function member_dir_exclude_users($qs=false,$object=false){
    //list of users to exclude
     
    if($object!='members')//hide for members only
        return $qs;
        
    $excluded_user=join(',',filter_buddypress_user_ids());//comma separated ids of users whom you want to exclude
    
    $args=wp_parse_args($qs);
    
    //check if we are searching for friends list etc?, do not exclude in this case
    if(!empty($args['user_id']))
        return $qs;
        
    if(!empty($args['exclude']))
        $args['exclude']=$args['exclude'].','.$excluded_user;
    else 
        $args['exclude']=$excluded_user;
        
    $qs=build_query($args);
      
	return $qs;
    
}

function filter_buddypress_user_ids(){
	$non_diplomates = array();
	//if(!get_current_user_id()){
		$non_diplomates = get_users( array( 'role__in' => ['customer', 'practitioner'], 'fields' => 'ID' ) );
	//}
	
	// primarily for hiding admin / dev / qa user accounts
	$hidden = get_users(array('meta_key'=>'wpcf-hide-in-members', 'meta_value'=>'1', 'fields' => 'ID' ) );
	
	$excluded = array_merge($non_diplomates, $hidden);

	return $excluded;
}




/***********************************************************************
 *
 *	COLLAPSE COURSE DESCRIPTION DISPLAY FOR USERS WITH AN ACTIVE SUBSCRIPTION
 *
 *	Why disabled?
 *
 **********************************************************************/
 


//add_action('the_content','maybe_collapse_course_content');
function maybe_collapse_course_content(){
	global $product;
	$user_ID = get_current_user_id();
	
	if($user_ID==0 || !$product) return;
	
	if (wcs_user_has_subscription($user_ID, $product->id, 'active')){
		add_action( 'sensei_single_course_content_inside_before', 'maybe_make_course_contents_collapse_before', 100, 1);
		function course_contents_collapse_before($the_id){
			echo "<hr/>";
			echo "<div class='collapse' id='courseDescription'>";
		}
		
		 
		add_action( 'sensei_single_course_content_inside_after', 'maybe_make_course_contents_collapse_after', 0, 1);
		function course_contents_collapse_after($the_id){
			echo "</div>";
			echo "<p><a href='#courseDescription' class='btn btn-default' data-toggle='collapse'>Course Description <span class='fa fa-plus'></span></a></p>";
			echo "<hr/>";
		}
	}
}




/***********************************************************************
 *
 *	DISABLE SUBSCRIPTIONS FROM CHANGING USER ROLES
 *
 **********************************************************************/
 
add_filter( 'woocommerce_subscriptions_update_users_role', '__return_false', 100 );

 
 
/***********************************************************************
 *
 *	AUTOMATICALLY APPLY COUPON TO SUBSCRIPTION SIGNUP PRODUCT
 *
 *	Dynamic Pricing discounts apply to the recurring fee on a subscription product,
 *	but not the signup fee. This function looks for subscription products in the cart
 *	and, if it finds them, applies a coupon that reduces the signup fee cost.
 *
 **********************************************************************/
 
add_action( 'woocommerce_before_cart', 'apply_signup_coupons' );
add_action( 'woocommerce_before_checkout_form', 'apply_signup_coupons' );

function apply_signup_coupons() {
    global $woocommerce;
	
	// if there is no subscription product in the cart, stop
	$has_subscription = WC_Subscriptions_Cart::cart_contains_subscription();
	if(!$has_subscription) return;
	
	// if there is a subscription, find out if it has student discount or diplomate discount category
	$apply_coupon = false;
    $items = $woocommerce->cart->get_cart();
    $total = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
    echo "<p>total: $total</p>";
    
    
	foreach($items as $item => $values) {
		if($values['data']->is_type( 'subscription' )){
			$_product = $values['data']->post;
			$_ID = $_product->ID;
			$terms = get_the_terms($_ID, "product_cat");
			foreach ( $terms as $term ) {
				if($term->name == "Diplomate Discount" || $term->name == "Student Discount"){
					$apply_coupon = true;
				}
			}
		}
	}
	
	// if none of the subscription items have the categories, don't apply the coupon
	if(!$apply_coupon) return;

	// get the current user's info
	$user_ID = get_current_user_id();
	$member_info = get_userdata($user_ID);
	
	// apply the correct coupon, based on role or cart total
	// remember that in the system a 'student' (role) is a 'customer'
	$coupon_code = "";
	if ($user_ID != 0 && in_array('customer',$member_info->roles)){
		$coupon_code = 'studentonlinesignup';
        
	} else if ($user_ID != 0 && in_array('diplomate',$member_info->roles) || $user_ID != 0 && in_array('administrator',$member_info->roles) ){
		$coupon_code = 'diplomateonlinesignup';
        
	} else if ($total > 1000 && $total < 2000){
		$coupon_code = 'bulksignupdiscount5';
        
	} else if ($total > 2000 && $total < 3000){
        $coupon_code = 'bulksignupdiscount10';
        
    } else if ($total > 3000){
        $coupon_code = 'bulksignupdiscount15';
    }
    
	// if no coupon, or this coupon is already applied, stop
    if ( $coupon_code == "" || $woocommerce->cart->has_discount( $coupon_code ) ) return;

    // if you get this far, apply the coupon
    $woocommerce->cart->add_discount( $coupon_code );
}

 

/***********************************************************************
 *
 * Events Tickets Plus - WooCommerce Tickets - Prevent Ticket Email from being sent.
 * @ Version 4.0
 *
 **********************************************************************/

add_action( 'init', 'wootickets_stop_sending_email' );
function wootickets_stop_sending_email() {
	if ( class_exists( 'Tribe__Tickets_Plus__Commerce__WooCommerce__Main' ) ) {
		$woo = Tribe__Tickets_Plus__Commerce__WooCommerce__Main::get_instance();
		remove_filter( 'woocommerce_email_classes', array( $woo, 'add_email_class_to_woocommerce' ) );
		add_action( 'woocommerce_email_after_order_table', array( $woo, 'add_tickets_msg_to_email' ) );
	}
}

/*
* Events Tickets Plus - WooCommerce Tickets - Hide You'll receive your tickets in another email.
* @ Version 4.0
*/
add_filter( 'wootickets_email_message', 'woo_tickets_filter_completed_order', 10 );
function woo_tickets_filter_completed_order( $text ) {
	$text = "";

	return $text;
}


/***********************************************************************
 *
 *	HIDE EVENT COST (WHICH PAGE IS THIS UTILIZED ON?)
 *
 **********************************************************************/

function hide_tribe_get_cost( $cost, $postId, $withCurrencySymbol ) {
	return '';
}
add_filter( 'tribe_get_cost', 'hide_tribe_get_cost', 10, 3 );


/***********************************************************************
 *
 *	FIX "PURCHASE THIS COURSE" BUTTON ON SUBSCRIPTION COURSES
 *
 **********************************************************************/

function fix_course_purchase_label( $subscription_string, $product ) {
	$subscription_price = $product->get_price();
	$sign_up_fee = wcs_get_price_excluding_tax( $product, array( "qty" => '1', "price" => WC_Subscriptions_Product::get_sign_up_fee( $product ) ) );
	
	$price = $subscription_price + $sign_up_fee;
	
	return "Sign Up Now for $" . $price . "*";
}
//add_filter( 'woocommerce_product_single_add_to_cart_text', 'fix_course_purchase_label', 999, 3 );



/***********************************************************************
 *
 *	FIX "Quiz Quiz" IN QUIZ TITLES
 *
 *	example: /quiz/the-diseases-of-the-jingui-yaolue-final-quiz/
 *	(visible when disabled)
 *
 **********************************************************************/

function replace_quiz_quiz($title,$post){
	return str_replace("Quiz Quiz", "Quiz", $title);
}
add_filter( 'sensei_single_title', 'replace_quiz_quiz', 10, 2 );



/***********************************************************************
 *
 *	REMOVE TOP NAV FROM WOO_TOP,
 *	CREATE IT MANAULLY SO THAT WE CAN INSERT CURRENCY SELECTOR
 *
 **********************************************************************/

add_action( 'init', 'remove_canvas_top_navigation', 10 );
function remove_canvas_top_navigation () {
 // Remove top nav from the woo_top hook
 remove_action( 'woo_top', 'woo_top_navigation', 10 );
}

function create_top_nav(){
?>
	<div id="top">
		<div class="col-full">
			<div id="currency-selector">
				<?php echo do_shortcode('[aelia_currency_selector_widget title="" widget_type="buttons"]'); ?>
			</div>
			<?php
				$args = array(
					'menu' => 'utility-nav',
					'container' => '',
					'container_class' => '',
					'menu_class' => 'nav top-navigation fl',
					'menu_id' => 'top-nav',
					'depth' => ( is_user_logged_in() ? 0 : 1),
				);
				wp_nav_menu( $args );
			?>
		</div>
	</div>
<?php	
}
add_action("woo_top","create_top_nav",10);



/****************************************************************************
 *
 *	REMOVE "Private: Private:" FROM FORUM TITLES (WHY IT'S DUPLICATED?)
 *
 ***************************************************************************/

add_filter('protected_title_format', 'remove_protected_title');
add_filter('private_title_format', 'remove_private_title');

//removes 'private' and protected prefix for forums
function remove_private_title($title) {
	return '%s';
}

function remove_protected_title($title) {
	return '%s';
}


/***********************************************************************
 *
 *	FROM "PootlePress" CANVAS CHILD THEME TO FIX BBPRESS ISSUES
 *
 **********************************************************************/

add_filter( 'template_include', 'woo_custom_maybe_load_bbpress_tpl', 99 );
 
function woo_custom_maybe_load_bbpress_tpl ( $tpl ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		$tpl = locate_template( 'bbpress.php' );
	}
	return $tpl;
} // End woo_custom_maybe_load_bbpress_tpl()
 
add_filter( 'bbp_get_template_stack', 'woo_custom_deregister_bbpress_template_stack' );
 
function woo_custom_deregister_bbpress_template_stack ( $stack ) {
	if ( 0 < count( $stack ) ) {
		$stylesheet_dir = get_stylesheet_directory();
		$template_dir = get_template_directory();
		foreach ( $stack as $k => $v ) {
			if ( $stylesheet_dir == $v || $template_dir == $v ) {
				unset( $stack[$k] );
			}
		}
	}
	return $stack;
} // End woo_custom_deregister_bbpress_template_stack()




/***********************************************************************
 *
 *	NOT CURRENTLY IN USE ??
 *
 **********************************************************************/

global $woothemes_sensei;
//remove_action( 'sensei_login_form', array( $woothemes_sensei->frontend, 'sensei_login_form' ), 10 );

//add_action( 'sensei_login_form', 'custom_sensei_login_form' , 10 );

function custom_sensei_login_form() {
	global $woothemes_sensei;

	?>
	<div id="my-courses">
	    <?php $woothemes_sensei->notices->maybe_print_notices(); ?>
	    <?php
		// output the actul form markup
		$woothemes_sensei->frontend->sensei_get_template( 'user/login-form.php');
	    ?>
	</div>
	
	<?php
} // End custom_sensei_login_form()


/***********************************************************************
 *
 *	HIDE DIPLOMATES TAB IF USER IS NOT A DIPLOMATE OR ADMIN
 *	
 *	example: /practitioner-directory/jvpstudent/profile/edit/group/1/
 *	Profile > Edit
 *
 **********************************************************************/

function hide_diplomates_tab($tabs,$groups, $group_name){
    $member_info = get_userdata(bp_displayed_user_id());
    $new_array = array();
    
    foreach ( (array) $tabs as $key=>$tab ){
	if($groups[$key]->name == "Diplomate Fields"){
		if(in_array('diplomate',$member_info->roles) || in_array('administrator',$member_info->roles)){
			$new_array[] = $tab;
		}
	} else {
		$new_array[] = $tab;
	}
    }
    return $new_array;
}
add_filter('xprofile_filter_profile_group_tabs','hide_diplomates_tab',10,3);


/***********************************************************************
 *
 *	
 *
 **********************************************************************/

function woo_custom_move_navigation () {
    // Remove main nav from the woo_header_after hook
    remove_action( 'woo_header_after','woo_nav', 10 );
    // Add main nav to the woo_header_inside hook
    add_action( 'woo_header_inside','woo_nav', 10 );
}
add_action( 'init', 'woo_custom_move_navigation', 10 );


/***********************************************************************
 *
 *	CHANGE THE THANK YOU MSG DISPLAYED ON ORDER CONFIRMATION PAGE
 *
 **********************************************************************/

function rewrite_thankyou() {
	$thanks_str = "Thank you. Your order has been received. </p><p>If you have not already, please complete your profile!</p><p><a href='" . bp_loggedin_user_domain() . "/profile/edit/group/1/' class='btn btn-primary'>Update My Profile Now</a>";
	
	return $thanks_str;
}
add_filter('woocommerce_thankyou_order_received_text', 'rewrite_thankyou', 10, 1);




/***********************************************************************
 *
 *	DISPLAY SUBSCRIPTION TITLES IN 'MY SUBSCRIPTIONS'
 *
 **********************************************************************/


function display_subscription_title($subscription){
    foreach ( $subscription->get_items() as $item_id => $item ) {
        $_product  = apply_filters( 'woocommerce_subscriptions_order_item_product', $subscription->get_product_from_item( $item ), $item );
		
        if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
            echo "<p>";
			echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item['name'], $item ) );
			echo "</p>";
        }
    }
}
add_action('woocommerce_my_subscriptions_after_subscription_id','display_subscription_title',10);




/***********************************************************************
 *
 *	SET DEFAULT USER TO PRACTITIONER
 *
 **********************************************************************/

function do_this($customer_data){
	if($_POST['user_type_select'] == "Student"){
		$customer_data['role'] = "customer";
	} else {
		$customer_data['role'] = "practitioner";
	}
	
	return $customer_data;
}
add_action('woocommerce_new_customer_data','do_this',10,1);




/***********************************************************************
 *
 *	ADD STUDENT / PRACTITIONER FIELDS TO THE CHECKOUT PROCESS UNDER ORDER NOTES
 *
 **********************************************************************/

add_action( 'woocommerce_after_order_notes', 'add_custom_checkout_fields' );

function add_custom_checkout_fields( $checkout ) {
	$user_id = get_current_user_id();
	$current_status = xprofile_get_field_data('Current Status', $user_id);

	echo '<div id="iceam_user_info"><h3>' . __('Additional Information') . '</h3>';
	echo "<!-- current status: $current_status -->";

	woocommerce_form_field( 'user_type_select', array(
		'type'          => 'select',
		'class'         => array('iceam-user-type-select form-row form-row-first'),
		'label'         => __('Current Status'),
		'options'     => array(
			'Practitioner' => __('Practitioner', 'woocommerce' ),
			'Student' => __('Student', 'woocommerce' )
	        ),
		'default'	=> $current_status
	), $checkout->get_value( 'user_type_select' ));

		$showhide = ($current_status == "Practitioner" || $current_status == "" ? "visible" : "hidden" );
		echo "<div id='iceam-practitioner' class='$showhide clearfix'>";
		
		woocommerce_form_field( 'license_number', array(
			'type'          => 'text',
			'class'         => array('form-row form-row-wide'),
			'label'         => __('Practitioner License Number'),
			'default'	=> xprofile_get_field_data('Practitioner License Number', $user_id)
		), $checkout->get_value( 'license_number' ));
		
		
		woocommerce_form_field( 'license_state', array(
			'type'          => 'text',
			'class'         => array('form-row form-row-wide'),
			'label'         => __('Licensing State'),
			'default'	=> xprofile_get_field_data('Licensing State', $user_id),
		), $checkout->get_value( 'license_state' ));
		
	
		echo '</div>'; // end iceam-practitioner
		
		
		/********************/
		
		$showhide = ($current_status == "Student" ? "visible" : "hidden" );
		echo "<div id='iceam-student' class='$showhide clearfix'>";
	
		woocommerce_form_field( 'student_id', array(
			'type'          => 'text',
			'class'         => array('form-row form-row-wide'),
			'label'         => __('Student ID Number'),
			'default'	=> xprofile_get_field_data('Student ID Number', $user_id)
		), $checkout->get_value( 'student_id' ));
		
		
		woocommerce_form_field( 'student_university', array(
			'type'          => 'text',
			'class'         => array('form-row form-row-wide'),
			'label'         => __('School Name'),
			'default'	=> xprofile_get_field_data('School Name', $user_id)
		), $checkout->get_value( 'student_university' ));
		
	
		echo '</div>'; // end iceam-student

	echo '</div>';
}



/**
 * Update the order meta with field values
 */
add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta' );

function custom_checkout_field_update_order_meta( $order_id ) {
	
	if ( !empty( $_POST['user_type_select'] ) ) {
		update_post_meta( $order_id, 'Current Status', sanitize_text_field( $_POST['user_type_select'] ) );
	}
	
	if ( !empty( $_POST['license_number'] ) ) {
		update_post_meta( $order_id, 'Practitioner License Number', sanitize_text_field( $_POST['license_number'] ) );
	}
	
	if ( !empty( $_POST['license_state'] ) ) {
		update_post_meta( $order_id, 'Licensing State', sanitize_text_field( $_POST['license_state'] ) );
	}
	
	if ( !empty( $_POST['student_id'] ) ) {
		update_post_meta( $order_id, 'Student ID Number', sanitize_text_field( $_POST['student_id'] ) );
	}
	
	if ( !empty( $_POST['student_university'] ) ) {
		update_post_meta( $order_id, 'School Name', sanitize_text_field( $_POST['student_university'] ) );
	}
}


/**
 * Update the user meta with field values
 */

add_action( 'woocommerce_checkout_update_user_meta', 'custom_checkout_update_order_meta',1 );

function custom_checkout_update_order_meta(){
	do_action('bp_init');
	$user_id = get_current_user_id();
	
	xprofile_set_field_data('Current Status', $user_id, sanitize_text_field( $_POST['user_type_select'] ));
	
	xprofile_set_field_data('Practitioner License Number', $user_id, sanitize_text_field( $_POST['license_number'] ));
	
	xprofile_set_field_data('Licensing State', $user_id, sanitize_text_field( $_POST['license_state'] ));
	
	xprofile_set_field_data('Student ID Number', $user_id, sanitize_text_field( $_POST['student_id'] ));
	
	xprofile_set_field_data('School Name', $user_id, sanitize_text_field( $_POST['student_university'] ));
	
	$userdata = get_userdata($user_id);
	$roles = ($userdata->roles ? $userdata->roles : []);
	
	if($_POST['user_type_select'] == "Practitioner" && !in_array('administrator',$roles) && !in_array('diplomate',$roles)){
		wp_update_user( array( 'ID' => $user_id, 'role' => strtolower($_POST['user_type_select']) ) );
	} else if($_POST['user_type_select'] == "Student" && !in_array('administrator',$roles) && !in_array('diplomate',$roles)){
		wp_update_user( array( 'ID' => $user_id, 'role' => 'customer' ) );
	}
}


/**
 * Display field values on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_checkout_field_display_admin_order_meta', 10, 1 );

function custom_checkout_field_display_admin_order_meta($order){
	$status = get_post_meta( $order->id, 'Current Status', true );
	echo '<p><strong>'.__('Current Status').':</strong>'.$status.'</p>';
	
	if($status == 'practitioner'){
		echo '<p><strong>'.__('Practitioner License Number').':</strong> ' . get_post_meta( $order->id, 'Practitioner License Number', true ) . '</p>';
	
		echo '<p><strong>'.__('Licensing State').':</strong> ' . get_post_meta( $order->id, 'Licensing State', true ) . '</p>';
	} else if ($status == 'student'){
		echo '<p><strong>'.__('Student ID Number').':</strong> ' . get_post_meta( $order->id, 'Student ID Number', true ) . '</p>';
		
		echo '<p><strong>'.__('School Name').':</strong> ' . get_post_meta( $order->id, 'School Name', true ) . '</p>';
	}
}



/***********************************************************************
 *
 *	ADD LEGAL DISCLAIMER TO LESSON PAGES, REQUIRE SIGNATURE
 *
 **********************************************************************/

add_action( 'loop_end', 'add_disclaimer_to_single_lessons' );
function add_disclaimer_to_single_lessons() {
	$signature = get_user_meta(get_current_user_id(), 'wpcf-disclaimer-signature', true);
	
	if ( is_singular('lesson') && $signature == '' ) {
?>

<div class="modal fade" id="signature-form" tabindex="-1" role="dialog" aria-labelledby="signatureForm">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Online Course Terms & Conditions</h2>
			</div>
			<div class="modal-body">
				
				<h3>Proprietary Information</h3>
				
				<p>Participant acknowledges that all information provided during this continuing education course training series is proprietary information and shall continue to be the exclusive property of Dr. Arnaud Versluys and ICEAM, LLC. </p>
				
				<p>Participant agrees not to disclose the proprietary information, directly or indirectly, under any circumstances or by any means, to any third person without the express written consent of Dr. Arnaud Versluys. </p>
				
				<p>Participant may use the proprietary information for their own personal practice, but shall not copy, transmit, teach, reproduce, summarize, quote, or make any commercial use whatsoever of proprietary information, with or without financial gain, without the express written consent of Dr. Arnaud Versluys.</p>
				
				<hr/>
				
				<p>To accept these terms please provide your digital signature by typing in your full name below. The name we have on file is: <strong><?php echo get_user_meta(get_current_user_id(), "billing_first_name", true) . " " . get_user_meta(get_current_user_id(), "billing_last_name", true); ?></strong>. (You will only need to do this once.)</p>
				
				<form>
					<p>
						<label for="signature">Full Name</label>
						<input type="text" name="signature" id="signature" />
						<input type="hidden" name="name-on-file" id="name-on-file" value="<?php echo get_user_meta(get_current_user_id(), "billing_first_name", true) . " " . get_user_meta(get_current_user_id(), "billing_last_name", true); ?>" />
					</p>
					<p>
						<input type="button" value="Cancel" class="btn-primary" id="signature-cancel" />
						<input type="button" value="Accept" class="btn-default" id="signature-accept" />
					</p>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery(window).load(function(){
		var form = jQuery( "#signature-form form" );
		form.validate({
			rules: {
				signature: {
					required: true,
					equalTo: "#name-on-file"
				}
			},
			messages: {
				signature: {
					required: "This field is required",
					equalTo: "Your name should match the name we have on file"
				}
			}
		});
		
		
		jQuery('#signature-form').modal({backdrop:'static', keyboard:false,show:true});
		
		jQuery("#signature-cancel").on('click', function(){
			jQuery(this).addClass('disabled');
			jQuery("#signature-accept").addClass('disabled');
			
			window.location.href = "/terms-conditions";
		});
		
		jQuery("#signature-accept").on('click', function(){
			if (form.valid()) {
				jQuery(this).addClass('disabled');
				jQuery("#signature-cancel").addClass('disabled');
				
				var val = jQuery("#signature").val();
				<?php
				echo "var uid = " . get_current_user_id() . ",";
				echo "ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "';";
				?>
				
				data =  {uid:uid, signature: val, action:'disclaimer_signature'};
				jQuery.post(ajaxurl, data, function (response) {
					console.log (response);
					jQuery(".modal-body").html(response);
					
					setTimeout(function(){
						jQuery("#signature-form").modal('hide');
					}, 2000);
				});
			}
		});
	});
</script>

<?php
	}
}


add_action( 'wp_ajax_disclaimer_signature', 'disclaimer_signature_callback' );

function disclaimer_signature_callback() {
	global $wpdb; // this is how you get access to the database

	if (isset($_POST['uid']) && isset($_POST['signature'])) {
	    add_user_meta( $_POST['uid'], 'wpcf-disclaimer-signature', $_POST['signature']);
	}
	
	echo "<h2>Thank you " . $_POST['signature'] . "!</h2>";

	die(); // this is required to terminate immediately and return a proper response
}


/***********************************************************************
 *
 *	DON'T DISPLAY MEDIA ATTACHMENTS OR COURSE LIST ON COURSE PAGE
 *	IF USER HASN'T SIGNED UP FOR THE COURSE
 *
 **********************************************************************/

add_action('sensei_single_course_content_inside_after','display_course_media_to_registered_students', 1);
function display_course_media_to_registered_students(){
	global $post, $current_user, $sensei_media_attachments;
	
	$member_info = get_userdata($current_user->ID);
	
	$started_course = WooThemes_Sensei_Utils::user_started_course( $post->ID, $current_user->ID );
	$roles = ($member_info->roles ? $member_info->roles : []);
	
	if(!in_array('administrator',$roles)){
		if(!$started_course){
			remove_action( 'sensei_course_single_lessons', array($sensei_media_attachments, 'display_attached_media' ), 9);
			//add_filter("sensei_single_course_lessons_before",'remove_unregistered_course_lessons',10);
			
			remove_action( 'sensei_single_course_content_inside_after' , array( 'Sensei_Course','the_course_lessons_title'), 9 );
			remove_action( 'sensei_single_course_content_inside_after', 'course_single_lessons', 10 );
			
		}
	}
}


function remove_unregistered_course_lessons(){
	echo "<!-- now i'm in here -->";
	// replaces $lessons array with empty array
	return [];
}



/***********************************************************************
 *
 *	Obscure the Course & Lesson videos in View Source
 *
 **********************************************************************/

add_action( 'sensei_single_course_content_inside_after', 'add_base64_youtube_uri' );
add_action( 'sensei_single_lesson_content_inside_after', 'add_base64_youtube_uri' );
function add_base64_youtube_uri() {
	global $post;
	
	$yturi = get_post_meta($post->ID, "wpcf-video-uri-base-64", true);
	
	if ( is_singular('course') && $yturi || is_singular('lesson') && $yturi) {	
?>
		<div class="hidden" id="ytv" data-yturi="<?php echo $yturi ?>"></div>
		<script>var ytv = eval(atob("YXRvYg=="));</script>
<?php	
	}
}



/***********************************************************************
 *
 *	AUTOMATICALLY UPDATE VIRTUAL ORDERS FROM PROCESSING TO COMPLETE
 *
 *	This circumvents requiring an admin
 *	to complete online course orders manually.
 *
 **********************************************************************/

add_filter( 'woocommerce_payment_complete_order_status', 'virtual_order_payment_complete_order_status', 10, 2 );
 
function virtual_order_payment_complete_order_status( $order_status, $order_id ) {
	$order = new WC_Order( $order_id );
 
	if ( 'processing' == $order_status && ( 'on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status ) ) {
 
		$virtual_order = null;
 
		if ( count( $order->get_items() ) > 0 ) {
 
			foreach( $order->get_items() as $item ) {
 
				if ( 'line_item' == $item['type'] ) {
 
					$_product = $order->get_product_from_item( $item );
 
					if ( ! $_product->is_virtual() ) {
						// once we've found one non-virtual product we know we're done, break out of the loop
						$virtual_order = false;
						break;
					} else {
						$virtual_order = true;
					}
				}
			}
		}
 
		// virtual order, mark as completed
		if ( $virtual_order ) {
			return 'completed';
		}
	}
 
	// non-virtual order, return original status
	return $order_status;
}


function change_btn_text($text){
	echo $text;
	return $text;
}
add_filter('sensei_wc_single_add_to_cart_button_text','change_btn_text',9999,1);


/***********************************************************************
 *
 *	THE END
 *
 **********************************************************************/