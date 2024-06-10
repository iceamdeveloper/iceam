<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Widget_Show_Parents extends WP_Widget {

	private $default_vars = array(
		'title'     => '',
		'postlink'  => '',
		'child'     => '',
		'link'      => true,
		'excerpt'   => true,
		'thumbnail' => false
	);

	/**
	 * Constructor
	 */
	public function __construct() {
		// Parent construct
		parent::__construct(
			'pc_widget_show_parents',
			__( 'Post Connector - Show Parents', 'post-connector' ),
			array( 'description' => __( 'Display linked parents by a child or current post', 'post-connector' ) )
		);
	}

	/**
	 * The Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		// Setup widget vars
		$instance = array_merge( $this->default_vars, $instance );

		// Don't output anything if there's no postlink
		if ( '' == $instance['postlink'] ) {
			return;
		}

		// Don't output the widget on the frontpage if the frontpage show_on_front is posts
		if ( is_front_page() && false === is_page() ) {
			return;
		}

		// Use custom post of child is null
		if ( null === $instance['child'] ) {
			$instance['child'] = get_the_ID();
		}

		// Load the PTL
		$post_type_link_manager = new SP_Connection_Manager();
		$connection             = $post_type_link_manager->get_connection( $instance['postlink'] );

		// Return if there is no connection
		if ( null == $connection ) {
			return;
		}

		// Only display widget on pages where the post type is the $instance['child'] equals the Connection post type
		if ( $connection->get_child() != get_post_type( $instance['child'] ) ) {
			return;
		}

		// Setup the post link manager
		$post_link_manager = new SP_Premium_Post_Link_Manager();

		// Generate the widget content
		$widget_content = $post_link_manager->generate_parents_list( $connection->get_slug(), $instance['child'], $instance['link'], $instance['excerpt'], 'b', $instance['thumbnail'] );

		// Don't ouput the widget if there is no widget content
		if ( '' == $widget_content ) {
			return;
		}

		// Output the widget
		echo $args['before_widget'];
		echo $args['before_title'] . $instance['title'] . $args['after_title'] . "\n";
		echo $widget_content;
		echo $args['after_widget'];
	}

	/**
	 * Update the widget options
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['postlink']  = $new_instance['postlink'];
		$instance['child']     = ( $new_instance['child'] == 'current' ) ? null : $new_instance['child'];
		$instance['link']      = ( $new_instance['link'] == 'false' ) ? false : true;
		$instance['excerpt']   = ( $new_instance['excerpt'] == 'false' ) ? false : true;
		$instance['thumbnail'] = ( $new_instance['thumbnail'] == 'false' ) ? false : true;

		return $instance;
	}

	/**
	 * The Widget form
	 *
	 * @param array $instance
	 *
	 * @return string
	 */
	public function form( $instance ) {

		$instance = array_merge( $this->default_vars, $instance );

		$selected_link = null;

		echo "<div class='pc_ajax_parent'>\n";

		wp_nonce_field( 'sp_ajax_sc_gpp', 'sp_widget_child_nonce' );

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'title' ) . '">' . __( 'Title', 'post-connector' ) . ':</label>';
		echo '<input class="widefat" id="' . $this->get_field_id( 'title' ) . '" type="text" name="' . $this->get_field_name( 'title' ) . '" value="' . esc_attr( $instance['title'] ) . '" />';
		echo "</p>\n";

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'postlink' ) . '">' . __( 'Post Link', 'post-connector' ) . ':</label>';

		// Get the connections
		$connection_manager = new SP_Connection_Manager();
		$links              = $connection_manager->get_connections();

		echo '<select class="widefat postlink" name="' . $this->get_field_name( 'postlink' ) . '" id="' . $this->get_field_id( 'postlink' ) . '" >';
		echo '<option value="0">' . __( 'Select Post Link', 'post-connector' ) . '</option>';
		if ( count( $links ) > 0 ) {
			foreach ( $links as $link ) {
				echo '<option value="' . $link->get_id() . '"';
				if ( $link->get_id() == $instance['postlink'] ) {
					echo ' selected="selected"';
					$selected_link = $link;
				}
				echo '>' . $link->get_title() . '</option>';
			}
		}
		echo '</select>';
		echo "</p>\n";

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'child' ) . '">' . __( 'Child', 'post-connector' ) . ':</label>';

		echo '<select class="widefat parent" name="' . $this->get_field_name( 'child' ) . '" id="' . $this->get_field_id( 'child' ) . '" >';

		if ( $selected_link != null ) {
			$childs_posts = get_posts( array(
				'post_type'      => $selected_link->get_child(),
				'posts_per_page' => - 1,
				'orderby'        => 'title',
				'order'          => 'ASC'
			) );
			if ( count( $childs_posts ) > 0 ) {
				echo "<option value='current'>" . __( 'Current page', 'post-connector' ) . "</option>\n";
				foreach ( $childs_posts as $childs_post ) {
					echo "<option value='{$childs_post->ID}'";
					if ( $childs_post->ID == $instance['child'] ) {
						echo " selected='selected'";
					}
					echo ">{$childs_post->post_title}</option>\n";
				}
			}
		}

		echo '</select>';
		echo "</p>\n";

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'link' ) . '">' . __( 'Make children clickable', 'post-connector' ) . ':</label>';
		echo '<select class="widefat" name="' . $this->get_field_name( 'link' ) . '" id="' . $this->get_field_id( 'link' ) . '" >';
		echo '<option value="true"' . ( ( $instance['link'] == true ) ? ' selected="selected"' : '' ) . '>Yes</option>';
		echo '<option value="false"' . ( ( $instance['link'] == false ) ? ' selected="selected"' : '' ) . '>No</option>';
		echo '</select>';
		echo "</p>\n";

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'excerpt' ) . '">' . __( 'Display excerpt', 'post-connector' ) . ':</label>';
		echo '<select class="widefat" name="' . $this->get_field_name( 'excerpt' ) . '" id="' . $this->get_field_id( 'excerpt' ) . '" >';
		echo '<option value="true"' . ( ( $instance['excerpt'] == true ) ? ' selected="selected"' : '' ) . '>Yes</option>';
		echo '<option value="false"' . ( ( $instance['excerpt'] == false ) ? ' selected="selected"' : '' ) . '>No</option>';
		echo '</select>';
		echo "</p>\n";

		echo "<p>";
		echo '<label for="' . $this->get_field_id( 'thumbnail' ) . '">' . __( 'Display thumbnail', 'post-connector' ) . ':</label>';
		echo '<select class="widefat" name="' . $this->get_field_name( 'thumbnail' ) . '" id="' . $this->get_field_id( 'thumbnail' ) . '" >';
		echo '<option value="true"' . ( ( $instance['thumbnail'] == true ) ? ' selected="selected"' : '' ) . '>Yes</option>';
		echo '<option value="false"' . ( ( $instance['thumbnail'] == false ) ? ' selected="selected"' : '' ) . '>No</option>';
		echo '</select>';
		echo "</p>\n";

		echo "</div>\n";


	}

}