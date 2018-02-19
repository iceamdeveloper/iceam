<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

// $text_domain is loaded in the calling view

echo '<h3>';
echo __('Bundle prices in specific Currencies', $text_domain);
echo '</h3>';
echo '<div>';
echo '<span class="description">';
echo __('Here you can manually specify prices for specific currencies. If you do so, the prices ' .
				'entered will be used instead of converting the base price using exchange rates. To use ' .
				'exchange rates for one or more prices, simply leave the field empty (the "Auto" value will ' .
				'appear to indicate that price for that currency will be calculated automatically).',
			 $text_domain);
echo '</span>';
echo '</div>';
