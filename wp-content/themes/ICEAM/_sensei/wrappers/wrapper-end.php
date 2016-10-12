<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$template = get_option('template');
echo "<!-- ICEAM TEMPLATE -->" . $template;

switch( $template ) {
	

	// IF Twenty Eleven
	case 'ICEAM' :
	?>
			</div>
		</div>
	<?php
	break;

	// Default
	default :
	?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php
	break;
}

?>