<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<meta name="sitelock-site-verification" content="7368" />
		
<meta property="og:site_name" content="Institute of Classics In East Asian Medicine" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://iceam.org/" />
<meta property="og:title" content="Home" />
<meta property="og:image" content="http://iceam.org/wp-content/uploads/2015/05/our-mission.jpg" />

<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />

<link href='<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css' rel='stylesheet' type='text/css'>

<link href='//fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
<?php woo_head(); ?>


<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/site.js?v=1"></script>

</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>

<header id="header" class="col-full">
	<div class="container">
		<?php woo_header_before(); ?>
		<?php woo_header_inside(); ?>
	</div>
</header>

		<?php woo_header_after(); ?>
<div id="wrapper">

	<div id="inner-wrapper">


	
	<!-- ICEAM -->