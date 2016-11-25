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
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

        
        global $post;
        global $woothemes_sensei;
        global $current_user;
        
        $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true );
        
		$terms = get_the_terms( $post->ID, 'course-category' );
		$term_names = array();
		
		if ( $terms && ! is_wp_error( $terms ) ) { 
			foreach ( $terms as $term ) {
				$term_names[] = $term->name;
			}
		}
		
		// get the current user's info
		$user_ID = get_current_user_id();
		$member_info = get_userdata($user_ID);
		$show_purchase_btn = true;
		
		
		if(in_array('Advanced',$term_names)){
			if ($user_ID != 0 && in_array('diplomate',$member_info->roles) || $user_ID != 0 && in_array('administrator',$member_info->roles) || $user_ID != 0 && in_array('administrator',$member_info->roles)) {
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

        // based on simple.php in WC templates/single-product/add-to-cart/
        if ( 0 < $wc_post_id && $show_purchase_btn) {
            // Get the product
            $product = $woothemes_sensei->sensei_get_woocommerce_product_object( $wc_post_id );
            if ( ! isset ( $product ) || ! is_object( $product ) ) exit;
            if ( $product->is_purchasable() ) {
                // Check Product Availability
                $availability = $product->get_availability();
                if ($availability['availability']) {
                    echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );
                } // End If Statement
                // Check for stock
                if ( $product->is_in_stock() ) { ?>
                    <?php if (! sensei_check_if_product_is_in_cart( $wc_post_id ) ) { ?>
                        <h3><?php echo $title; ?></h3>
                        <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>" />
                            <input type="hidden" name="quantity" value="1" />
                            <?php if ( isset( $product->variation_id ) && 0 < intval( $product->variation_id ) ) { ?>
                                <input type="hidden" name="variation_id" value="<?php echo $product->variation_id; ?>" />
                                <?php if( isset( $product->variation_data ) && is_array( $product->variation_data ) && count( $product->variation_data ) > 0 ) { ?>
                                    <?php foreach( $product->variation_data as $att => $val ) { ?>
                                        <input type="hidden" name="<?php echo esc_attr( $att ); ?>" id="<?php echo esc_attr( str_replace( 'attribute_', '', $att ) ); ?>" value="<?php echo esc_attr( $val ); ?>" />
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->get_price_html(); ?><br/><?php echo apply_filters('single_add_to_cart_text', __('<nobr>Purchase this Course</nobr>', 'woothemes-sensei'), $product->product_type); ?></button>
                        </form>
                    <?php } // End If Statement
					echo "<h5 style='margin-top:15px'>* Read about <a href='/pricing'>online course pricing</a>.</h5>";
                  } // End If Statement
            } // End If Statement
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