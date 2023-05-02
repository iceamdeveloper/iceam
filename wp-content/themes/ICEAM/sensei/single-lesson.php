<?php
/**
 * The Template for displaying all single lessons.
 *
 * Override this template by copying it to yourtheme/sensei/single-lesson.php
 *
 * @author      Automattic
 * @package     Sensei
 * @category    Templates
 * @version     1.12.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

get_sensei_header();

global $woothemes_sensei;
global $current_user;
global $woocommerce;
$user_ID = get_current_user_id();
$course_id = Sensei()->lesson->get_course_id( $post->ID );
$wc_post_id = get_post_meta( $course_id, '_course_woocommerce_product', true );
$need_to_resubscribe = wcs_user_has_subscription( $user_ID, $wc_post_id, 'active' ) == false;
// if it is a SHL course and the user has an active subscription to the SHL bundle 
// - next conditional is same logic for JYL
if( wcs_user_has_subscription( $user_ID, 9604, 'active' ) == true && has_term( 'shanghan-lun', 'product_cat', $wc_post_id ) ){
	$need_to_resubscribe = false;
} else if ( wcs_user_has_subscription( $user_ID, 9607, 'active' ) == true && has_term( 'jingui-yaolue', 'product_cat', $wc_post_id ) ){
	$need_to_resubscribe = false;
} else if ( wcs_user_has_subscription( $user_ID, 17192, 'active' ) == true ){
	$need_to_resubscribe = false;
}

if ( have_posts() ) {
	the_post();
}
?>

<article <?php post_class( array( 'lesson', 'post' ) ); ?>>

	<?php

		/**
		 * Hook inside the single lesson above the content
		 *
		 * @since 1.9.0
		 *
		 * @param integer $lesson_id
		 *
		 * @hooked deprecated_lesson_image_hook - 10
		 * @hooked Sensei_Lesson::lesson_image() -  17
		 * @hooked deprecate_lesson_single_main_content_hook - 20
		 */
		do_action( 'sensei_single_lesson_content_inside_before', get_the_ID() );

	?>

	<section class="entry fix">

		<?php

		if ( sensei_can_user_view_lesson() ) {

            if( $need_to_resubscribe ){ //leo's addition

                echo '<p><strong>You do not have access to this content</strong></p>';

            } else {

                if ( apply_filters( 'sensei_video_position', 'top', $post->ID ) == 'top' ) {
    
                        do_action( 'sensei_lesson_video', $post->ID );
    
                }
    
                the_content();

            }

		} else {
			?>

				<p>

					<?php echo wp_kses_post( get_the_excerpt() ); ?>

				</p>

			<?php
		}

		?>

	</section>

	<?php

		if( !$need_to_resubscribe ){

			/**
			 * Hook inside the single lesson template after the content
			 *
			 * @since 1.9.0
			 *
			 * @param integer $lesson_id
			 *
			 * @hooked Sensei()->frontend->sensei_breadcrumb   - 30
			 */
			do_action( 'sensei_single_lesson_content_inside_after', get_the_ID() );

		}

	?>

</article><!-- .post -->

<?php get_sensei_footer(); ?>
