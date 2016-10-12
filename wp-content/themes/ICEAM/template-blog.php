<?php
/**
 * Template Name: Blog
 *
 * The blog page template displays the "blog-style" template on a sub-page.
 *
 * @package WooFramework
 * @subpackage Template
 */

 get_header();
 global $woo_options;
?>
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">

    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>

            <section id="main" class="col-left">

						<?php
							if (have_posts()) {
								while (have_posts()) {
									the_post();
						?>
								<header>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p class="date"><?php the_date('F j, Y'); ?></p>
								</header>
							
								<article itemprop="articleBody" id="article<?php the_ID(); ?>">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
									} ?>
								
									<?php the_excerpt(); ?>
									
									<a href="<?php the_permalink(); ?>" class="btn btn-default">Read more</a>
								</article>
                                <hr/>
						<?php
								} // endwhile;
							} // endif;
						?>

            </section><!-- /#main -->
            <?php woo_main_after(); ?>

            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>