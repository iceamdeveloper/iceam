<?php get_header(); ?>
			

			<?php
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args=array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page'=>9
				);
				$query = new WP_Query( $args );
			?>
			
			<header class="page-header container text-center">
				
				<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			
			</header> <!-- end article header -->
			
			
				<div class="container main-content">
					<div class="row">
						<div class="col-sm-12">
							<?php 

							$args = array(
								'type' => 'post',
								'child_of' => 0,
								'hide_empty' => 0,
								'hierarchical' => 0
							);
							
							$categories = get_categories( $args );
							
							if(count($categories) > 0){
							?>
								
							<div class="blog-categories btn-group btn-group-sm" role="group">
								<h3><a href="#"><span class="fa fa-caret-left"></span><span class="fa fa-caret-right"></span> Categories</a></h3>
								
								<?php
								foreach($categories as $category){
									if($category->cat_name == "Uncategorized") continue;
									echo ("<a href='/category/".$category->slug."' class='btn btn-default'>".$category->cat_name."</a>");
								}
								?>
							</div>
							
							<?php } ?>
							
						</div>
					</div>
					

						<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
						
						<?php if ($query->current_post % 3 == 0){
							echo "<div class='row'>";
						} ?>
						
							<div class="col-sm-4 post_content clearfix post<?php the_ID(); ?>">
								<div class="callout post"><!-- end article header -->
									<div class="img-container">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
										</a>
									</div>
									<header>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									</header>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink(); ?>" class="btn btn-default">Read More</a>
								</div>
							</div>
					
						<?php if (($query->current_post + 1) % 3 == 0 || ($query->current_post + 1) == $query->post_count){
							echo "</div> <!-- end .row -->";
						} ?>
						
						<?php endwhile; ?>

					<div class="pagenavi-wrapper">
						<?php wp_pagenavi(); ?>
					</div>
					
					<?php endif; ?>
				</div>
<?php get_footer(); ?>