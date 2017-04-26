<?php
	defined( 'ABSPATH' ) or die( 'No!' );
	
	/**
	* Plugin Name: ICEAM Course Signup
	* Description: A widget for displaying course signup buttons in the right rail.
	* Author: Jason Van Pelt for jvp.digital
	*/

	
	class Course_Signup_Widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
			'iceam_course_signup_widget', // Base ID
			__( 'ICEAM Course Signup', 'iceam' ), // Name
			array( 'description' => __( 'Display Signup Button for Online Courses', 'iceam' ), ) // Args
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

        
        global $post;
        global $woothemes_sensei;
        global $current_user;
		global $woocommerce;

		$is_in_cart = false;
		
		// get the current user's info
		$user_ID = get_current_user_id();
		$member_info = get_userdata($user_ID);
		$show_purchase_btn = true;

		$title = apply_filters( 'widget_title', $instance['title'] );
		
        $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true );
        $product = $woothemes_sensei->sensei_get_woocommerce_product_object( $wc_post_id );
		
		$resubscribe_link = wcs_get_users_resubscribe_link_for_product( $wc_post_id );
		$can_resubscribe = (wcs_user_has_subscription( $user_ID, $wc_post_id, 'on-hold' ) == true || wcs_user_has_subscription( $user_ID, $wc_post_id, 'expired' ) == true ? true : false);
		//echo "<p>can resubscribe: ". ($can_resubscribe ? "true" : "false") . " - ". $product->id."</p>";
		
		// having trouble getting the resubscribe link
		// renewal order was on-hold for some reason
		// related files:
		//		woocommerce-subscriptions/includes/class-wc-subscription.php
		//		woocommerce-subscriptions/includes/wcs-resubscribe-functions.php
		// echo "resubscribe_link: $resubscribe_link";
		
		
        
		$terms = get_the_terms( $post->ID, 'course-category' );
		$term_names = array();
		if ( $terms && ! is_wp_error( $terms ) ) { 
			foreach ( $terms as $term ) {
				$term_names[] = $term->name;
			}
		}
		
		// if the product isn't identified at this point there is a problem
		if ( ! isset ( $product ) || ! is_object( $product ) ) return;
		
		// check to see if the user is currently a student in this course
		// if the user has not completed the course, don't show purchase btn
		if(Sensei_Utils::user_started_course($post->ID,$user_ID) && !Sensei_Utils::user_completed_course($post->ID,$user_ID)) return;
		
		
		// if this is an Advanced course, and the current user is not a diplomate or admin, do not show a purchase link
		if(in_array('Advanced',$term_names)){
			if ($user_ID != 0 && in_array('diplomate',$member_info->roles) || $user_ID != 0 && in_array('administrator',$member_info->roles) ) {
				$show_purchase_btn = true;
			} else {
				$show_purchase_btn = false;
			?>
				<div class="tribe-events-non-diplomate">
					<h3>We're Sorry</h3>
					<p>You must be a Diplomate to register for this course.</p>
					
					<p>Please
					<?php if ($user_ID == 0){ ?>
						<a href="/my-courses/">log in</a> or
					<?php } ?>
					view other <a href="/courses/">ICEAM Courses.</a></p>
				</div>
			<?
			}
		}
		
		
		// determine if the current product is in the cart (used below)
		foreach($woocommerce->cart->get_cart() as $key => $cart_item ) {
			$_product = $cart_item['data'];
	 
			if($wc_post_id == $_product->id ) {
				$is_in_cart = true;
				break;
			}
		}
		
		
		if ( 0 < $wc_post_id && $show_purchase_btn) {
			
			echo "<h3>$title</h3>";
			
			if($is_in_cart){
				echo "<p><a href='/checkout' class='btn btn-primary'>Item is in Cart &ndash; Checkout Now</a></p>";
			
			// customer has an inactive subscription, maybe offer the renewal button
			// can't get the resubscribe link for some reason. see above.
			} else if ( ! empty( $resubscribe_link ) && $can_resubscribe ) {
				$price = $product->subscription_sign_up_fee;
				echo "<p><a href='$resubscribe_link' class='btn btn-primary'>Subscription is Expired <br/>Renew Now for $$price</a></p>";
			
			} else if ($can_resubscribe){
				echo '<h4>Your subscription requires renewal.</h4>';
				echo '<p><a href="/my-account/subscriptions/" class="btn btn-primary">View Your Subscriptions</a></p>';
			
			// once all online courses are subscriptions this should be unnecessary
			// based on simple.php in WC templates/single-product/add-to-cart/
			} else if ( $product->is_purchasable() ) {
				
			?>
			
			<?php
				
				$the_price = $product->get_price();
				$the_signup_fee = wcs_get_price_excluding_tax( $product, array( "price" => WC_Subscriptions_Product::get_sign_up_fee( $product ) ) );
				$total_price = $the_price + $the_signup_fee;
				$the_period = WC_Subscriptions_Product::get_interval( $product ) . " " . WC_Subscriptions_Product::get_period( $product ) . "s";
				
				echo "<h4>Register for " . wc_price( $total_price ) . "</h4>";
				
				
			?>
				
				<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype="multipart/form-data">
					<input type="hidden" name="product_id" value="<?php echo esc_attr( $wc_post_id ); ?>" />
					<input type="hidden" name="quantity" value="1" />
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				</form>
				
            <?php
			
				echo "<p style='margin-top:15px'><strong>Optional course renewal for " . wc_price($the_price) . " <nobr>after $the_period</nobr></strong></p>";
			
			} // End If Statement ?>
			
			<h5 style='margin-top:15px'>* Read about <a href='/pricing'>online course pricing</a>.</h5>
			
		<?php
		
		} // End If Statement
		
		echo $args['after_widget'];
	}
	
	
	
	// Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'iceam' );
		}
	
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} 


// Register and load the widget
function iceam_course_signup_widget() {
	register_widget( 'Course_Signup_Widget' );
}
add_action( 'widgets_init', 'iceam_course_signup_widget' );

?>