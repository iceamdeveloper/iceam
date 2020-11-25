<?php
/**
 * The Template for outputting Lists of any Sensei content type.
 *
 * This template expects the global wp_query to setup and ready for the loop
 *
 * @author      Automattic
 * @package     Sensei
 * @category    Templates
 * @version     1.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This runs before the the course loop items in the loop.php template. It runs
 * only only for the course post type. This loop will not run if the current wp_query
 * has no posts.
 *
 * @since 1.9.0
 */
do_action( 'sensei_loop_course_before' );
?>

<ul class="course-container columns-<?php sensei_courses_per_row(); ?>" >

	<?php
	/**
	 * This runs before the post type items in the loop.php template. It
	 * runs within the courses loop <ul> tag.
	 *
	 * @since 1.9.0
	 */
	do_action( 'sensei_loop_course_inside_before' );
	?>

	<?php
	/*
	 * Loop through all courses
	 */
	while ( have_posts() ) {
        the_post();
        
        global $post;
        global $woothemes_sensei;
        global $current_user;
        global $woocommerce;
        $user_ID = get_current_user_id();
        $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true );
        $need_to_resubscribe = (wcs_user_has_subscription( $user_ID, $wc_post_id, 'on-hold' ) == true || wcs_user_has_subscription( $user_ID, $wc_post_id, 'expired' ) == true ? true : false);

        if ( $need_to_resubscribe ){
            echo "<style>.post-".$post->ID.".course .view-results {display:none!important;}</style>";
        }

		sensei_load_template_part( 'content', 'course' );

	}
	?>

	<?php
	/**
	 * This runs after the post type items in the loop.php template. It runs
	 * only for the specified post type
	 *
	 * @since 1.9.0
	 */
	do_action( 'sensei_loop_course_inside_after' );
	?>

</ul>

<?php
/**
 * This runs after the post type items in the loop.php template. It runs
 * only for the specified post type
 *
 * @since 1.9.0
 */
do_action( 'sensei_loop_course_after' );
?>
