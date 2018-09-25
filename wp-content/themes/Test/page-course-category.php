<?php
/*
Template Name: Course Category
*/
?>


<?php get_header(); ?>


<div id="content" class="col-full">
	
	<div id="main-sidebar-container" class="clearfix">
		<section id="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<article class="clearfix" role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<header>
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					</header> <!-- end article header -->
				
					<section itemprop="articleBody">
						<?php the_content(); ?>
					</section> <!-- end article section -->
							
				</article> <!-- end article -->
				
				<?php endwhile; ?>
				
				<?php endif; ?>
				<hr/>
				<h1><?php echo types_render_field( "course-category-name", array( ) ); ?> Courses</h1>
				
				<div id="courses" itemprop="articleBody">
					<?php
					
					$course_categ = types_render_field( "course-category-slug", array( ) );
					$posts_per = -1;
					$args=array(
						'post_type' => 'course',
						'course-category'=> $course_categ,
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'=>$posts_per
					);
					$categ_query = new WP_Query( $args );
					?>
						
					<?php if ($categ_query->have_posts()) : while ($categ_query->have_posts()) : $categ_query->the_post(); ?>
					
					
							<article class="row callout course post">
								<div class="col-sm-8">
								
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php the_excerpt(); ?>
								</div>
								<div class="col-sm-3 col-sm-offset-1">
									<p>&nbsp;</p>
									<a href="<?php the_permalink(); ?>" class="btn btn-primary">View Course Details</a>
								</div>
							</article>
							
							
					<?php endwhile; ?>
				
					<?php endif; ?>
				
					<?php wp_reset_query(); ?>
						
				</div> <!-- end article section -->
				
				<hr/>
				
				<p>&nbsp;</p>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="callout">
							<h2>ICEAM Programs</h2>
							<p>ICEAM programs were developed to provide clinicians with the rare opportunity to access the classics, or canons, that form the foundation of East Asian medicine.</p>
							<p><a href="/about-iceam/how-the-program-works/" class="btn btn-default">Continue Reading</a></p>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="callout">
							<h2>Accreditations</h2>
							<p>Upon successful completion of a seminar, students receive a certificate of continuing education or professional development credits.</p>
							<p><a href="/about-iceam/accreditations/" class="btn btn-default">Continue Reading</a></p>
						</div>
					</div>
				</div>
		</section>
		<?php get_sidebar(); ?>
	</div>

</div>
			
			
			

			
<?php get_footer(); ?>