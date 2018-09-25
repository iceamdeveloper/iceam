<?php
/**
 * Template Name: Members
 *
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
?>
       
	<!-- #content Starts -->
	<?php woo_content_before(); ?>
	<div id="content" class="col-full">
		
		<!-- #main Starts -->
		<?php woo_main_before(); ?>
		<section id="main">                     
		<?php
			woo_loop_before();
			
			if (have_posts()) { $count = 0;
				while (have_posts()) { the_post(); $count++;
					woo_get_template_part( 'content', 'page-members' ); // Get the page content template file, contextually.
				}
			}
			
			woo_loop_after();
		?>     
		</section><!-- /#main -->
		<!-- ?php woo_main_after(); ?-->
	
	</div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>