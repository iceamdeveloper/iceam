<?php
/**
 * Template Name: Home
 *
 */

get_header();
?>
       
    <!-- #content Starts -->
    <div id="content" class="col-full">
    
            <section id="main">                     
				<?php
					
					if (have_posts()) {
						while (have_posts()) {
                            the_post();
				?>
                
                <div class="container">
                            <?php the_content(); ?>
                </div>
                
                <?php
						}
					}
				?>
            </section><!-- /#main -->
			
			<?php
				if(types_render_field( "promo-announcement", array( "raw"=>true ) )){
			?>
			
			<section id="promo-announcement">
				<div class="container">
						<?php echo types_render_field( "promo-announcement", array( ) ); ?>
				</div>
			</section>
			
			<?php
				} // end if
			?>
            
            <section id="our-mission">
                <div class="container">
					<?php echo types_render_field( "our-mission", array( ) ); ?>
				</div>
            </section>


            <section id="testimonials">
						<?php
						$posts_per = 4;
						$args=array(
							'post_type' => 'testimonials',
							'post_status' => 'publish',
							'posts_per_page'=>$posts_per,
                            'meta_key' => 'wpcf-featured-testimonial',
                            'meta_value' => 1
						);
						$testimonial_query = new WP_Query( $args );
						?>
						
						
						<?php
							if ($testimonial_query->have_posts()) {
                        ?>
                                <div class="container">
                                    <h3>Testimonials</h3>
                                    <h2>What Others Are Saying</h2>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <ul class="nav nav-tabs" role="tablist">
                                                
						<?php
                        		while ($testimonial_query->have_posts()) {
									$testimonial_query->the_post();
                                    $extra_classes = ($testimonial_query->current_post == 0 ? "in active" : "");
						?>
                                                <li class="<?php echo $extra_classes; ?>"><a href="#testimonial-<?php the_ID(); ?>" data-toggle="tab">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail( 'full', array( 'width' => '64', 'height' => '64' ) );
                                                        } else {
                                                            echo "<img src='/wp-content/uploads/2015/05/placeholder-portrait.jpg' width='64' height='64' alt='placeholder portait' />";
                                                        }
                                                    ?>
                                                </a></li>  
                                    
						<?php
								} // endwhile;
                        ?>                  </ul>
                                            
                        <?php
                            } // endif;
                            
                                rewind_posts();
                                
                            if ($testimonial_query->have_posts()) {
                        ?>
                                            <div class="tab-content">
                                    <?php
                                            while ($testimonial_query->have_posts()) {
                                                $testimonial_query->the_post();
                                                $extra_classes = ($testimonial_query->current_post == 0 ? "in active" : "");
                                    ?>
                                                    <div class="tab-pane fade <?php echo $extra_classes; ?>" id="testimonial-<?php the_ID(); ?>">
                                                        <?php the_excerpt(); ?>
                                                        <em>
                                                            <?php the_title(); ?><br/>
                                                            <?php echo types_render_field( "byline", array( ) ); ?>
                                                        </em>
                                                    </div>
                                                
                                    <?php
                                            } // endwhile;
                                    ?>       
                                            </div>
                                
                                        
                                        </div>
                                        
                                        <div class="col-sm-10 col-sm-offset-1">
											<a href="/testimonials" class="btn btn-primary">View All Testimonials</a>
										</div>
                                    </div>
                                </div>
                        <?php
							} // endif;
							wp_reset_query();
						?>
                        
            </section>



            <section id="how-the-program-works">
                <div class="container">
					<?php echo types_render_field( "how-the-program-works", array( ) ); ?>
				</div>
            </section>

        
            <?php
                $posts_per = 3;
                $args=array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page'=>$posts_per,
                );
                $wp_query = new WP_Query( $args );
        
                if ($wp_query->have_posts()) {
            ?>
                    <!-- FEATURED BLOG POSTS -->
                    <div class="container">
                        <div class="row">
                            <h2 style="text-align: center;">Featured Blog Posts</h2>
            <?
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
            ?>
                            <div class="col-sm-4">
                                <div class="callout post">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <p><a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
                                        </a></p>
                                    <?php } ?>
                                    <?php echo get_the_date('F,j,Y', $post->ID); ?>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                            </div>
            <?php
                        } // endwhile
            ?>
                        </div>
						<p style="text-align: center;"><a href="/blog" class="btn btn-primary">View All Blog Posts</a></p>
                    </div>
            <?php
                } //endif
                wp_reset_query();
            ?>

		</div>

    </div><!-- /#content -->

<?php get_footer(); ?>