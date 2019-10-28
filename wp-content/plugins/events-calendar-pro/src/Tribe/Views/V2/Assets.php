<?php
/**
 * Handles registering all Assets for the Events Pro V2 Views
 *
 * To remove a Assets:
 * tribe( 'assets' )->remove( 'asset-name' );
 *
 * @since 4.7.5
 *
 * @package Tribe\Events\Pro\Views\V2
 */
namespace Tribe\Events\Pro\Views\V2;

use Tribe__Events__Pro__Main as Plugin;
use Tribe\Events\Views\V2\Template_Bootstrap;

/**
 * Register the Assets for Events Pro View V2.
 *
 * @since 4.7.5
 *
 * @package Tribe\Events\Pro\Views\V2
 */
class Assets extends \tad_DI52_ServiceProvider {

	/**
	 * Key for this group of assets.
	 *
	 * @since 4.7.5
	 *
	 * @var string
	 */
	public static $group_key = 'events-pro-views-v2';

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 4.7.5
	 */
	public function register() {
		$plugin = Plugin::instance();

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-full',
			'views-full.css',
			[ 'tribe-common-style', 'tribe-events-views-v2-full' ],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-nanoscroller',
			'vendor/nanoscroller/jquery.nanoscroller.js',
			[ 'jquery-ui-draggable' ],
			null
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-week-grid-scroller',
			'views/week-grid-scroller.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-pro-views-v2-nanoscroller',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-week-day-selector',
			'views/week-day-selector.js',
			[ 'tribe-events-views-v2-accordion' ],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-week-multiday-toggle',
			'views/week-multiday-toggle.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-views-v2-accordion',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-map-events-scroller',
			'views/map-events-scroller.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-pro-views-v2-nanoscroller',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-map-events',
			'views/map-events.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-pro-views-v2-map-provider-google-maps',
				'tribe-events-views-v2-accordion',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-map-provider-google-maps',
			'views/map-provider-google-maps.js',
			[
				'jquery',
				'tribe-common',
				'swiper',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'swiper',
			'vendor/swiper/dist/js/swiper.js',
			[],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-tooltip-pro',
			'views/tooltip-pro.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-views-v2-tooltip',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		tribe_asset(
			$plugin,
			'tribe-events-pro-views-v2-multiday-events-pro',
			'views/multiday-events-pro.js',
			[
				'jquery',
				'tribe-common',
				'tribe-events-views-v2-multiday-events',
			],
			'wp_enqueue_scripts',
			[
				'priority'     => 10,
				'conditionals' => [ $this, 'should_enqueue_frontend' ],
				'groups'       => [ static::$group_key ],
			]
		);

		add_action( 'wp_enqueue_scripts', [ $this, 'disable_v1' ], 200 );
	}

	/**
	 * Checks if we should enqueue frontend assets for the V2 views
	 *
	 * @since 4.7.5
	 *
	 * @return bool
	 */
	public function should_enqueue_frontend() {

		$should_enqueue = tribe( Template_Bootstrap::class )->should_load();

		/**
		 * Allow filtering of where the base Frontend Assets will be loaded
		 *
		 * @since 4.7.5
		 *
		 * @param bool $should_enqueue
		 */
		return apply_filters( 'tribe_events_pro_views_v2_assets_should_enqueue_frontend', $should_enqueue );
	}

	/**
	 * Removes assets from View V1 when V2 is loaded.
	 *
	 * @since 4.7.5
	 *
	 * @return void
	 */
	public function disable_v1() {
		$should_enqueue = tribe( Template_Bootstrap::class )->should_load();

		// Deactivate the old V1 assets.
		if ( ! $should_enqueue ) {
			return;
		}

		wp_deregister_script( 'tribe-events-pro-slimscroll' );
		wp_deregister_script( 'tribe-events-pro-geoloc' );
	}
}
