<?php
namespace Aelia\WC\CurrencySwitcher\Bundles\Bug_Fixes;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

use Aelia\WC\CurrencySwitcher\Bundles\Definitions;
use Aelia\WC\Traits\Singleton;
use InvalidArgumentException;

/**
 * Loads and manages the bug fixes that can be applied to different versions of
 * the target plugin.
 *
 * @since x.x
 */
class Bug_Fix_Manager {
	use Singleton;

	/**
	 * Keeps a list of the reg
	 *
	 * @var array
	 */
	protected $_bug_fixes = [];

	/**
	 * Initialisation function. Alias of Singleton::init(), used for
	 * better readability.
	 *
	 * @return Bug_Fix_Manager
	 */
	public static function init(): Bug_Fix_Manager {
		return static::instance();
	}

	/**
	 * Constructor.
	 */
	public function __construct()	{
		add_action('woocommerce_init', [$this, 'init_bug_fixes'], 0);
	}

	/**
	 * Initialises the bug fixes by loading each one.
	 *
	 * @return void
	 */
	public function init_bug_fixes(): void {
		$bug_fixes = [
			'Aelia\WC\CurrencySwitcher\Bundles\Bug_Fixes\Patches\Bug_Fix_3',
		];

		foreach($bug_fixes as $bug_fix_class){
			$bug_fix = new $bug_fix_class();
			// If the bug fix is valid, apply the fixes
			if($bug_fix instanceof IBug_Fix) {
				$this->_bug_fixes[get_class($bug_fix)] = $bug_fix;
				$bug_fix->apply_bug_fix();
			}
			else {
				trigger_error(sprintf(__('Class %1$s does not implement the IBug_Fix interface and it will be ignored.',
											Definitions::TEXT_DOMAIN), $bug_fix_class), E_USER_WARNING);
			}
		}
	}
}
