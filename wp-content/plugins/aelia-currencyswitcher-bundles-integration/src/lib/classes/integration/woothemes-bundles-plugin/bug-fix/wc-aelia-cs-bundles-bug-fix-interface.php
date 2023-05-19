<?php
namespace Aelia\WC\CurrencySwitcher\Bundles\Bug_Fixes;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * Describes a bug fix class, which can be used to patch issues in the Bundles plugin.
 *
 * @since 1.3.2.2201011
 */
interface IBug_Fix {
	public function apply_bug_fix(): void;
}
