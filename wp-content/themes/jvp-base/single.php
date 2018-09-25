<?php get_header(); ?>
			
			<div id="content" class="clearfix">
				<div class="container">
					<div class="row">
						<div id="main" class="col-sm-8 clearfix" role="main">
		
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<header>
								
									<?php the_post_thumbnail( 'full' ); ?>
									
									<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
									
									<p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '','', FALSE); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</p>
								
								</header> <!-- end article header -->
							
								<section class="post_content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
									
									<?php wp_link_pages(); ?>
							
								</section> <!-- end article section -->
							
							</article> <!-- end article -->
							
							<?php endwhile; ?>
							
							<?php endif; ?>
					
						</div> <!-- end #main -->
			
						<?php get_sidebar(); // sidebar 1 ?>
						
					</div>
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>