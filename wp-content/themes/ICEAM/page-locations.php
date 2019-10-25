<?php
/*
Template Name: Locations
*/
?>


<?php get_header(); ?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article class="clearfix" role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<header>
					<div class="page-header"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
				</header> <!-- end article header -->
			
				<section itemprop="articleBody">
					<div class="container">
						<?php the_content(); ?>
					</div>
				</section> <!-- end article section -->
						
			</article> <!-- end article -->
			
			<?php endwhile; ?>
			
			<?php endif; ?>
			
			
			<section id="locations" itemprop="articleBody">
				<div class="container">
					<?php
					$posts_per = -1;
					$args=array(
						'post_type' => 'tribe_venue',
						'order' => 'ASC',
						'orderby' => 'title',
						'post_status' => 'publish',
						'posts_per_page'=>$posts_per,
					);
					$location_query = new WP_Query( $args );
					?>
					
					
					<div class="row">
					
					<?php if ($location_query->have_posts()) : while ($location_query->have_posts()) : $location_query->the_post(); ?>
							<div class="col-sm-4 post_content clearfix post<?php the_ID(); ?>">
								<div class="callout location" itemprop="articleBody" id="article<?php the_ID(); ?>">
								
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									
									<?php if ( tribe_embed_google_map() && tribe_address_exists() ) : ?>
										<!-- Venue Map -->
										<div class="tribe-events-map-wrap">
											<?php //echo tribe_get_embedded_map( $venue_id, '100%', '200px' ); ?>
										</div><!-- .tribe-events-map-wrap -->
									<?php endif; ?>
									
									<p><?php echo get_post_meta($post->ID, "_VenueAddress", true) ?></p>
									<p><?php echo get_post_meta($post->ID, "_VenueCity", true) ?>,
									<?php echo get_post_meta($post->ID, "_VenueStateProvince", true) ?>
									<?php echo get_post_meta($post->ID, "_VenueZip", true) ?></p>
									<p><?php echo get_post_meta($post->ID, "_VenueCountry", true) ?></p>
									<p><?php echo get_post_meta($post->ID, "_VenuePhone", true) ?></p>
									<p><a href="<?php the_permalink(); ?>">Read More</a></p>
								
								</div>
							</div>
					<?php endwhile; ?>
					
					</div> <!-- end .row -->
					
					<?php endif; ?>
					
					<?php wp_reset_query(); ?>
				</div>
			</section> <!-- end article section -->
			
<?php get_footer(); ?>