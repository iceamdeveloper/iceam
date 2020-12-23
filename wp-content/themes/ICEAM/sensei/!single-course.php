<?php
/**
 * The Template for displaying all single courses.
 *
 * Override this template by copying it to yourtheme/sensei/single-course.php
 *
 * @author      Automattic
 * @package     Sensei
 * @category    Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_sensei_header();
?>

<article <?php post_class( array( 'course', 'post' ) ); ?>>

	<?php

    global $post;
    global $woothemes_sensei;
    global $current_user;
    global $woocommerce;
    $user_ID = get_current_user_id();
	$wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true );
    // $need_to_resubscribe = (wcs_user_has_subscription( $user_ID, $wc_post_id, 'active' ) == false ? true : false);
    $need_to_resubscribe = false;
    
	/**
	 * Hook inside the single course post above the content
	 *
	 * @since 1.9.0
	 *
	 * @param integer $course_id
	 *
	 * @hooked Sensei()->frontend->sensei_course_start     -  10
	 * @hooked Sensei_Course::the_title                    -  10
	 * @hooked Sensei()->course->course_image              -  20
	 * @hooked Sensei_Course::the_course_enrolment_actions -  30
	 * @hooked Sensei()->message->send_message_link        -  35
	 * @hooked Sensei_Course::the_course_video             -  40
	 */
	do_action( 'sensei_single_course_content_inside_before', get_the_ID() );

	?>

	<section class="entry fix">

		<?php
		while ( have_posts() ) {
			the_post();
			the_content();
		}
		?>

	</section>

	<?php

	/**
	 * Hook inside the single course post above the content
	 *
	 * @since 1.9.0
	 *
	 * @param integer $course_id
	 */
    if( $need_to_resubscribe ){
        echo "<style>.view-results {display:none!important;}</style>";
    } else {
        do_action( 'sensei_single_course_content_inside_after', get_the_ID() );
    }

	?>
</article><!-- .post .single-course -->

<?php

?>

<?php get_sensei_footer(); ?>
