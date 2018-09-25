<!doctype html>  

<html <?php language_attributes(); ?>>
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
    
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic|Droid+Serif:400,700' rel='stylesheet' type='text/css'>
	</head>
	
	<body <?php body_class("stage"); ?> id="app-stage">
		<header role="banner">
				
			<div class="navbar navbar-default">
				<div class="container">
          
					<div class="navbar-header">
						<a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
						
						<!-- left shelf class="stage-toggle"; right shelf class="stage-toggle stage-toggle-right" -->
						<!-- left shelf data-distance="250" or leave it off; right shelf data-distance="-250" -->
						<a class="btn btn-link stage-toggle stage-toggle-right hidden visible-xs" data-target="#app-stage" data-toggle="stage" data-distance="-250">
							<span class="fa fa-bars"></span>
						</a>
						
						<!-- left shelf class="stage-shelf"; right shelf class="stage-shelf stage-shelf-right" -->
						<div class="stage-shelf stage-shelf-right clearfix">
							<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
						</div>
					</div>


				</div> <!-- end .container -->
				
				
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->

		<div id="page-wrapper">   