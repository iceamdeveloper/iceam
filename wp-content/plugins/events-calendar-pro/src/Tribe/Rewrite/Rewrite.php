<?php
/**
 * An extension of The Events Calendar rewrite handler to handle PRO rules.
 *
 * @since   4.7.5
 * @package Tribe\Events\Pro\Rewrite
 */

namespace Tribe\Events\Pro\Rewrite;

use Tribe__Events__Main as TEC;
use Tribe__Events__Organizer as Organizer;
use Tribe__Events__Venue as Venue;

/**
 * Class Rewrite
 *
 * @since   4.7.5
 * @package Tribe\Events\Pro\Rewrite
 */
class Rewrite extends \Tribe__Events__Rewrite {
	/**
	 * An override of the base class method to make sure we're taking Pro rewrite rules into account when parsing a URL.
	 *
	 * @since 4.7.5
	 *
	 * @param array $query_vars An array of query vars found in the current URL.
	 *
	 * @return array The dynamic matchers, modified if required.
	 */
	protected function get_dynamic_matchers( array $query_vars ) {
		$dynamic_matchers = parent::get_dynamic_matchers( $query_vars );
		$bases            = (array) $this->get_bases();

		if ( isset( $query_vars['tribe_recurrence_list'], $query_vars[ TEC::POSTTYPE ] ) ) {
			$all_regex = $bases['all'];
			preg_match( '/^\(\?:(?<slugs>[^\\)]+)\)/', $all_regex, $matches );
			if ( isset( $matches['slugs'] ) ) {
				$slugs = explode( '|', $matches['slugs'] );
				// The localized version is the last.
				$localized_slug                           = end( $slugs );
				$dynamic_matchers["([^/]+)/{$all_regex}"] = "{$query_vars[TEC::POSTTYPE]}/{$localized_slug}";
			}
		}

		if ( isset( $query_vars[ Venue::POSTTYPE ] ) ) {
			// Add the Venue slug as a dynamic matcher.
			$dynamic_matchers['([^/]+)'] = $query_vars[ Venue::POSTTYPE ];
		}

		if ( isset( $query_vars[ Organizer::POSTTYPE ] ) ) {
			// Add the Organizer slug as a dynamic matcher.
			$dynamic_matchers['([^/]+)'] = $query_vars[ Organizer::POSTTYPE ];
		}

		return $dynamic_matchers;
	}
}
