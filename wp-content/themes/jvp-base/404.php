<?php get_header(); ?>
			
			<header class="page-header container text-center">
				
				<h1 class="page-title" itemprop="headline"><?php _e("Epic 404 - Article Not Found","wpbootstrap"); ?></h1>
			
			</header> <!-- end article header -->
			
			<div id="content" class="clearfix">
				
				<div class="container">
					<div class="row">
						
						<div id="main" class="col-sm-12" role="main">
		
							<article id="post-not-found" class="clearfix">
								
							
								<section class="post_content">
									
									<p><?php _e("Whatever you were looking for was not found, but maybe try looking again or search using the form below.","wpbootstrap"); ?></p>
		
									<div class="row">
										<div class="col col-lg-12">
											<?php get_search_form(); ?>
										</div>
									</div>
							
								</section> <!-- end article section -->
								
								<footer>
									
								</footer> <!-- end article footer -->
							
							</article> <!-- end article -->
					
						</div> <!-- end #main -->
						
					</div>
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>