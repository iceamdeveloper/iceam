<?php
/**
 * Loop - Archive - Testimonials
 */

 echo "<!-- loop archive testimonials -->";
 
 global $more; $more = 0;
 
woo_loop_before();
if (have_posts()) { $count = 0;

	$title_before = '<h1 class="archive_header">';
	$title_after = '</h1>';
	
	woo_archive_title( $title_before, $title_after );
	
	// Display the description for this archive, if it's available.
	woo_archive_description();
?>

<div class="fix"></div>

<?php
	while (have_posts()) { the_post(); $count++;

		woo_get_template_part( 'content', get_post_type() );

	} // End WHILE Loop
} else {
	get_template_part( 'content', 'noposts' );
} // End IF Statement

woo_loop_after();

woo_pagenav();
?>