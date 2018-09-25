<?php

/************************************************************
*
*	FUNCTIONS LIFTED FROM BONES WORDPRESS-BOOTSTRAP-MASTER
*
************************************************************/

// add ability to upload svg and vcf files
function add_mime_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'add_mime_types', 1, 1);


// enqueue styles

function jvp_base_theme_styles() {
	// bootstrap 'toolkit' css (from Marketing Minimal theme)
	wp_register_style( 'toolkit', get_template_directory_uri() . '/css/bootstrap/toolkit-minimal.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'toolkit' );
	
	// parent style from wordpress-bootstrap-master
	wp_register_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'parent-style' );
	
	// font awesome icon set
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'font-awesome' );
	
	// child theme styles
	$rand = rand(1000, 10000);
	wp_register_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', array(), $rndm, 'all' );
	wp_enqueue_style( 'theme-style' );
}

add_action( 'wp_enqueue_scripts', 'jvp_base_theme_styles' );


// enqueue javascript
function jvp_base_theme_js(){
	
	if ( !is_admin() ){
	  if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1) ) {
		//wp_enqueue_script( 'comment-reply' );
	  }
	}
	
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', 
	  get_template_directory_uri() . '/js/com/jquery/jquery-2.1.4.min.js',
	  //array('jquery'), 
	  '2.1.4' );
	
	wp_register_script( 'jquey-validate', 
	  get_template_directory_uri() . '/js/com/jquery/jquery.validate.min.js',
	  //array('jquery'), 
	  '1.2' );

	// This is the full Bootstrap js distribution file. If you only use a few components that require the js files consider loading them individually instead
	wp_register_script( 'bootstrap-toolkit', 
	  get_template_directory_uri() . '/js/com/bootstrap/toolkit.js', 
	  //array('jquery'), 
	  '1.2' );
  
	wp_register_script( 'modernizr', 
	  get_template_directory_uri() . '/js/com/modernizer/modernizr.js', 
	  //array('jquery'), 
	  '1.2' );
	
	wp_register_script( 'site-main', 
	  get_stylesheet_directory_uri() . '/site.js', 
	  //array('jquery'), 
	  '1.2' );
	
	wp_register_script( 'masonry', 
	  get_template_directory_uri() . '/js/com/desandro/masonry.pkgd.min.js', 
	  //array('jquery'), 
	  '1.2' );
  
	wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'jquery-validate' );
	wp_enqueue_script( 'bootstrap-toolkit' );
	//wp_enqueue_script( 'modernizr' );
	//wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'site-main' );
}
add_action( 'wp_enqueue_scripts', 'jvp_base_theme_js' );


// really wordpress, emoji?
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


function SearchFilter($query) {
    // If 's' request variable is set but empty
    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
        $query->is_search = true;
        $query->is_home = false;
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');


// child theme formats
add_action( 'after_setup_theme', 'childtheme_formats', 20 );
function childtheme_formats(){
	add_theme_support( 'post-formats', array( ) );
}

/*
// remove lead paragraph class
function magic_remove_lead_paragraph($content) {
	global $post;
	return preg_replace('/<p([^>]+)?>/', '<p$1 class="">', $content, 1);
}
add_filter('the_content', 'magic_remove_lead_paragraph');
*/

// clean up pagenavi, bootstrap style
function bs_pagination($html) {
	$out = '';
	
	//wrap a's and span's in li's
	$out = str_replace("<div","",$html);
	$out = str_replace("class='wp-pagenavi'>","",$out);
	$out = str_replace("<a","<li><a",$out);
	$out = str_replace("</a>","</a></li>",$out);
	$out = str_replace("<span","<li><span",$out);  
	$out = str_replace("</span>","</span></li>",$out);
	$out = str_replace("</div>","",$out);
	
	return '<ul class="pagination pagination-centered">'.$out.'</ul>';
}
add_filter( 'wp_pagenavi', 'bs_pagination', 10, 2 );


// reduce excerpt length
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


function modify_read_more_link() {
	return '';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


// remove Types' "Front-end Display" box in admin pages
function remove_types_info_box() {
    return false;
}
add_filter( 'types_information_table', 'remove_types_info_box' );


//----------------------------------------------------------/
//  responsive images - add img-responsive class 
//----------------------------------------------------------/

function image_class_filter($classes) {
    $classes .= " img-responsive";
	
	//remove size (e.g. "size-full")
	$size_pos = strpos($classes, "size-");
	$blank_pos = strpos($classes, " ", $size_pos);
	$length = $blank_pos - $size_pos;
	$classes = substr_replace($classes, '', $size_pos, $length+1);
	
	//remove img id (e.g. "wp-image-1234")
	$wp_pos = strpos($classes, "wp-image-");
	$blank_pos = strpos($classes, " ", $wp_pos);
	$length = $blank_pos - $wp_pos;
	$classes = substr_replace($classes, '', $wp_pos, $length+1);
	
	return $classes;
}
add_filter("get_image_tag_class","image_class_filter",10);




/************************************************************
*
*	FUNCTIONS LIFTED FROM BONES WORDPRESS-BOOTSTRAP-MASTER
*
************************************************************/


// Clean up the WordPress Head
if( !function_exists( "wp_bootstrap_head_cleanup" ) ) {  
  function wp_bootstrap_head_cleanup() {
    // remove header links
    remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
    remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
    remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
    remove_action( 'wp_head', 'index_rel_link' );                         // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
    remove_action( 'wp_head', 'wp_generator' );                           // WP version
  }
}
// Launch operation cleanup
add_action( 'init', 'wp_bootstrap_head_cleanup' );


// remove WP version from RSS
if( !function_exists( "wp_bootstrap_rss_version" ) ) {  
  function wp_bootstrap_rss_version() { return ''; }
}
add_filter( 'the_generator', 'wp_bootstrap_rss_version' );


// Remove the [É] in a Read More link
if( !function_exists( "wp_bootstrap_excerpt_more" ) ) {  
  function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
  }
}
add_filter('excerpt_more', 'wp_bootstrap_excerpt_more');



function wp_bootstrap_main_nav() {
  // Display the WordPress menu if available
  wp_nav_menu( 
    array( 
      'menu' => 'main_nav', /* menu name */
      'menu_class' => 'nav navbar-nav',
      'theme_location' => 'main_nav', /* where in the theme it's assigned */
      'container' => 'false', /* container class */
      'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
      'walker' => new Bootstrap_walker()
    )
  );
}


function wp_bootstrap_footer_links() { 
  // Display the WordPress menu if available
  wp_nav_menu(
    array(
      'menu' => 'footer_links', /* menu name */
      'theme_location' => 'footer_links', /* where in the theme it's assigned */
      'container_class' => 'footer-links clearfix', /* container class */
      'fallback_cb' => 'wp_bootstrap_footer_links_fallback' /* menu fallback */
    )
  );
}


// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );


// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );

function wp_bootstrap_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


// Disable jump in 'read more' link
function wp_bootstrap_remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'wp_bootstrap_remove_more_jump_link' );


// Add thumbnail class to thumbnail links
function wp_bootstrap_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'wp_bootstrap_add_class_attachment_link', 10, 1 );


// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
function wp_bootstrap_add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}
add_filter('nav_menu_css_class', 'wp_bootstrap_add_active_class', 10, 2 );


// Remove <p> tags from around images
function wp_bootstrap_filter_ptags_on_images( $content ){
  return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content', 'wp_bootstrap_filter_ptags_on_images' );


// Get <head> <title> to behave like other themes
function wp_bootstrap_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'wpbootstrap' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'wp_bootstrap_wp_title', 10, 2 );


// Add WP 3+ Functions & Theme Support
if( !function_exists( "wp_bootstrap_theme_support" ) ) {  
  function wp_bootstrap_theme_support() {
    add_theme_support( 'post-thumbnails' );      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size( 125, 125, true );   // default thumb size
    //add_theme_support( 'custom-background' );  // wp custom background
    add_theme_support( 'automatic-feed-links' ); // rss

    // Add post format support - if these are not needed, comment them out
    /*
	add_theme_support( 'post-formats',      // post formats
      array( 
        'aside',   // title less blurb
        'gallery', // gallery of images
        'link',    // quick link to other site
        'image',   // an image
        'quote',   // a quick quote
        'status',  // a Facebook like status update
        'video',   // video 
        'audio',   // audio
        'chat'     // chat transcript 
      )
    );
    */

    add_theme_support( 'menus' );            // wp menus
    
    register_nav_menus(                      // wp3+ menus
      array( 
        'main_nav' => 'The Main Menu',   // main nav in header
        'footer_links' => 'Footer Links' // secondary nav in footer
      )
    );  
  }
}
// launching this stuff after theme setup
add_action( 'after_setup_theme','wp_bootstrap_theme_support' );




/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wp_bootstrap_register_sidebars() {
  register_sidebar(array(
  	'id' => 'sidebar1',
  	'name' => 'Main Sidebar',
  	'description' => 'Used on every page BUT the homepage page template.',
  	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	'after_widget' => '</div>',
  	'before_title' => '<h3 class="widgettitle">',
  	'after_title' => '</h3>',
  ));
    
  /* 
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call 
  your new sidebar just use the following code:
  
  Just change the name to whatever your new
  sidebar's id is, for example:
  
  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php
  
  */
}
add_action( 'widgets_init', 'wp_bootstrap_register_sidebars' );

/************* COMMENT LAYOUT *********************/



// Numeric Page Navi (built into the theme by default)
function wp_bootstrap_page_navi($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 7;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }
    
  echo $before.'<ul class="pagination">'."";
  if ($paged > 1) {
    $first_page_text = "&laquo";
    echo '<li class="prev"><a href="'.get_pagenum_link().'" title="' . __('First','wpbootstrap') . '">'.$first_page_text.'</a></li>';
  }
    
  $prevposts = get_previous_posts_link( __('&larr; Previous','wpbootstrap') );
  if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
  else { echo '<li class="disabled"><a href="#">' . __('&larr; Previous','wpbootstrap') . '</a></li>'; }
  
  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="active"><a href="#">'.$i.'</a></li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="">';
  next_posts_link( __('Next &rarr;','wpbootstrap') );
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "&raquo;";
    echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last','wpbootstrap') . '">'.$last_page_text.'</a></li>';
  }
  echo '</ul>'.$after."";
}


// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	if ( $args->has_children ) {
		  $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}


////////////////////////////////////////////////////////////////////////////////////////////////////////


?>