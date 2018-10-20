<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 * This template override shifts the layout to a two column layout.
 * This site uses the Wootickets plugin, which is added to the page via
 * the tribe_events_single_event_after_the_meta action (now in the right sidebar).
 *
 * I am wrapping the Tickets section in code that detects if the user is an admin, teacher, or diplomate.
 * If this event is an Advanced Course, only those users should be able to purchast tickets.
 *
 * I also remove navigation to prev | next events, and comments.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>


<div id="content" class="col-full">
	
	<div id="main-sidebar-container" class="clearfix">
		<section id="main">
			
			<div id="tribe-events-content" class="tribe-events-single vevent hentry">
			
				<p class="tribe-events-back">
					<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( __( '&laquo; All %s', 'tribe-events-calendar' ), $events_label_plural ); ?></a>
				</p>
			
				<!-- Notices -->
				<?php tribe_events_the_notices() ?>
			
				<?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>
			
				<div class="tribe-events-schedule updated published tribe-clearfix">
					<?php echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?>
					<?php if ( tribe_get_cost() ) : ?>
						<span class="tribe-events-divider">|</span>
						<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
					<?php endif; ?>
				</div>
			
				<?php while ( have_posts() ) :  the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<!-- Event featured image, but exclude link -->
						<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
			
						<!-- Event content -->
						<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
						<div class="tribe-events-single-event-description tribe-events-content entry-content description">
							<?php the_content(); ?>
						</div>
						<!-- .tribe-events-single-event-description -->
						<?php
							// embed add to calendar button? nah
							//do_action( 'tribe_events_single_event_after_the_content' )
						?>
			
						<!-- Event meta -->
						<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
						<?php
						/**
						 * The tribe_events_single_event_meta() function has been deprecated and has been
						 * left in place only to help customers with existing meta factory customizations
						 * to transition: if you are one of those users, please review the new meta templates
						 * and make the switch!
						 */
						if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
							tribe_get_template_part( 'modules/meta' );
						} else {
							echo tribe_events_single_event_meta();
						}
						?>
					</div> <!-- #post-x -->
				<?php endwhile; ?>
			
			</div><!-- #tribe-events-content -->
		</section>
		
		<aside id="sidebar">
			<h2>Live Course Registration</h2>
			<?php
				// create an array of event category names for this event
				
				$register_offsite = types_render_field( "register-offsite", array( 'raw'=>true ) );
				
				$terms = get_the_terms( get_the_ID(), 'tribe_events_cat' );
				$term_names = array();
				if ( $terms && ! is_wp_error( $terms ) ) { 
					foreach ( $terms as $term ) {
						$term_names[] = $term->name;
					}
				}
				$eventId = get_the_ID();
				$singleSignupRestricted = array(8390,8356);
				
				// get the current user's info
				$user_ID = get_current_user_id();
				$member_info = get_userdata($user_ID);
				
				if ($register_offsite == 1){
					$venue_ID = get_post_meta(get_the_ID(), "_EventVenueID", true );
				?>
					<div class="register-offsite">
						<p>Please contact the venue for registration information for this course.</p>
						<a href="<?php echo get_permalink( $venue_ID ); ?>" class="btn btn-primary">Contact Venue</a>
					</div>
					
				<?php	
				// if this is an Advanced course
				} else if( $user_ID != 0 && !in_array('diplomate',$member_info->roles ) && in_array($eventId,$singleSignupRestricted)){ ?>
						<div class="tribe-events-non-diplomate">
							<h3>We're Sorry</h3>
							<p>You must be a Diplomate to register for this course outside of a training module.</p>
							
							<p>Please
							<?php if ($user_ID == 0){ ?>
								<a href="/my-courses/">login</a> or
							<?php } ?>
							view our <a href="/venue/iceam-portland/">Portland ICEAM Course Modules.</a></p>
						</div>
				<?php } else if(in_array('Advanced',$term_names)){
					// if the user is logged in as a diplomate or administrator or teacher
					// show the purchase tickets module
					if ($user_ID != 0 && in_array('diplomate',$member_info->roles) || $user_ID != 0 && in_array('administrator',$member_info->roles) || $user_ID != 0 && in_array('teacher',$member_info->roles)) {
						do_action( 'tribe_events_single_event_after_the_meta' );
						
						// Display the currency selector widget with currencies as buttons
						echo do_shortcode('[aelia_currency_selector_widget title="Change Currency" widget_type="buttons"]');
					
					// else tell the user he/she is inelligible
					} else {
			?>
						<div class="tribe-events-non-diplomate">
							<h3>We're Sorry</h3>
							<p>You must be a Diplomate to register for this course.</p>
							
							<p>Please
							<?php if ($user_ID == 0){ ?>
								<a href="/my-courses/">login</a> or
							<?php } ?>
							view other <a href="/courses/">ICEAM Courses.</a></p>
						</div>
			<?
					}
				} else {
					// if it's not an Advanced course, show the tickets module
					do_action( 'tribe_events_single_event_after_the_meta' );

			
					// Display the currency selector widget with currencies as buttons
					echo do_shortcode('[aelia_currency_selector_widget title="Change Currency" widget_type="buttons"]');

				}
			?>
		</aside>
	</div>
</div>
