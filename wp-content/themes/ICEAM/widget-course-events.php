<?php
	defined( 'ABSPATH' ) or die( 'No!' );
	
	/**
	* Plugin Name: ICEAM Course Event Listings
	* Description: Displaying posts based on Post Connector connections between Courses & Events
	* Author: Jason Van Pelt for jvp.digital and Bent Media
	*/

	
	class Course_Events_Widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
			'iceam_course_posts_widget', // Base ID
			__( 'ICEAM Course Events', 'iceam' ), // Name
			array( 'description' => __( 'Display Brick and Mortar Events for Courses', 'iceam' ), ) // Args
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
        
        // wp_enqueue_style( 'widget-calendar-pro-style', TribeEventsPro::instance()->pluginUrl . 'src/resources/css/widget-calendar-full.css', array(), apply_filters( 'tribe_events_pro_css_version', TribeEventsPro::VERSION ) );
		
		$post_obj = $GLOBALS['post'];
        setup_postdata( $post_obj );
        
        // this is dependent on Post Connector
        $post_link_manager = new SP_Post_Link_Manager();
        
        // this gives a list of post connections where this post is the parent
        $connections = $post_link_manager->get_children( 'events-to-courses', $post_obj->ID);
        
        // use those connections to find the children the parent is connected to
        $childs = array();
        foreach($connections as $key => $value){
            if(get_post_meta($key,'sp_parent',true) == $post_obj->ID){
                $childs[] = get_post_meta($key,'sp_child',true);
            }
        }
        
        if(!$childs){
            return;
        }
        
        // create a query that pulls events contained in the array
        $args=array(
            'post_type' => 'tribe_events',
            'post_status' => 'publish',
            'posts_per_page'=>-1,
            'post__in' => $childs
        );
        $connection_query = new WP_Query( $args );
        
        if ($connection_query->have_posts()) {
            		
            if ( ! empty( $title ) ){
            ?>
                <h3><?php echo $title; ?></h3>
            <?php
            }
            
            while ($connection_query->have_posts()) {
                
                $connection_query->the_post();
        
                // this is dependent on Events Calendar Pro:
                $instance['cost'] = tribe_get_cost();
                $instance['venue'] = tribe_get_venue();
                tribe_get_template_part( 'pro/widgets/modules/single-event', null, $instance );
        
            } // end while
        } // end if
		wp_reset_query();
		
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
function iceam_course_events_widget() {
	register_widget( 'Course_Events_Widget' );
}
add_action( 'widgets_init', 'iceam_course_events_widget' );

?>