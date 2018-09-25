		</div> <!-- end #page-wrapper -->

		<footer role="contentinfo">
		
			<div id="inner-footer" class="container clearfix">
				
				<div id="widget-footer" class="clearfix row">
				  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
				  <?php endif; ?>
				  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
				  <?php endif; ?>
				  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
				  <?php endif; ?>
				</div>
				
				<nav class="clearfix">
					<?php // wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
				</nav>
		
				<p class="attribution">&copy;<?php echo date("Y"); ?> <?php bloginfo('name'); ?></p>
			
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/tracking.js"></script>
	</body>

</html>