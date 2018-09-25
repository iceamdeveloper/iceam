<?php get_header(); ?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<header class="page-header container text-center">
					
					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
				
				</header> <!-- end article header -->
			
				<div id="content" class="clearfix">
					
					<div class="container">
						<div class="row">
							<div class="col-sm-8">

							<?php
								
								if($post->post_content != ""){
							?>
									<div class="container">
										<?php the_content(); ?>
									</div>
							<?php
								}
							?>
								
								<?php do_action('jvp_acf_display_content'); ?>
								
							</div>
							
							<?php get_sidebar(); // sidebar 1, col-sm-4 ?>
						</div>
					</div>

				</div> <!-- end #content -->
				
				
			<?php endwhile; ?>
				
			<?php endif; // have_posts() ?>
			
<?php get_footer(); ?>