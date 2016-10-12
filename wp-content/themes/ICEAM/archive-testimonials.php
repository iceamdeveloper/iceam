<?php
/**
 * Archive Template
 *
 * The archive template is a placeholder for archives that don't have a template file. 
 * Ideally, all archives would be handled by a more appropriate template according to the
 * current page context (for example, `tag.php` for a `post_tag` archive).
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;
 get_header();
?>      
    <!-- #content Starts -->
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    
		
            <!-- #main Starts -->
            <section id="main" class="col-left testimonials">
            	
                <?php
                /*******************************************************************/
                
                 echo "<!-- loop archive testimonials -->";
                 
                 global $more;
                 $more = 0;
                 
                query_posts('post_type=testimonials&showposts=-1&orderby=date&order=ASC');
                 
                woo_loop_before();
                if (have_posts()) {
                ?>
                    <h1>Testimonials</h1>
                <?php
                    while (have_posts()) {
                        the_post();
                    
                    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
                ?>
                        <article <?php post_class('clearfix'); ?>>
                        <?php
                        woo_post_inside_before();
                        ?>
                            
                            <section class="entry">
                                <?php the_content(); ?>
								
								<div class="thumb">
								<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'thumb', array( 'width' => '64', 'height' => '64' ) );
									} 
								?>
								</div>
                            
                                <header class="byline">
                                <h2><?php the_title( ); ?></h2>
                                <?php echo types_render_field("byline", array( )) ?>
                                </header>
                            </section><!-- /.entry -->
                        <?php
                        woo_post_inside_after();
                        ?>
                        </article>
                    
                <?php    
                    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
                
                        
                
                    } // End WHILE Loop
                } // End IF Statement
                
                woo_loop_after();
                
                woo_pagenav();
                
                /*******************************************************************/
                
                ?>
                    
            </section><!-- /#main -->
    
            <?php get_sidebar(); ?>
    
		</div><!-- /#main-sidebar-container -->

    </div><!-- /#content -->
		
<?php get_footer(); ?>