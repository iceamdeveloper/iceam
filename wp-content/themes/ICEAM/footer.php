<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;

woo_footer_top();
woo_footer_before();
?>

	</div><!-- /#inner-wrapper -->

</div><!-- /#wrapper -->

		<footer id="footer" class="col-full">
			<div class="container">
				<div class="logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.gif" alt="" />
				</div>
				<div class="row">
					<div class="col-sm-8">
						<?php

						$defaults = array(
							'menu'            => 'footer-menu',
							'container'       => 'nav',
							'menu_class'      => 'menu',
							'menu_id'         => '',
						);
						
						wp_nav_menu( $defaults );
						
						?>
						
						<?php woo_footer_inside(); ?>
					</div>
					<div class="col-sm-4" id="copyright-social">
						
						<ul class="social clearfix">
							<li><a href="https://www.facebook.com/pages/Institute-of-Classics-in-East-Asian-Medicine/74677813226" class="fa fa-facebook">&nbsp;</a></li>
							<li><a href="https://www.youtube.com/channel/UC2hWLi969Co0BHtk67EuR5Q" class="fa fa-youtube">&nbsp;</a></li>
						</ul>
						<?php woo_footer_left(); ?>
					</div>
				</div>
			</div>
		</footer>
	
		<?php woo_footer_after(); ?>


<?php wp_footer(); ?>
<?php woo_foot(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78201332-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>