<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Cron_Manager {

	const CRON_COUNT_WORDS = 'count_words';

	/**
	 * Remove a Post Connector Cron
	 *
	 * @param $cron
	 */
	public function remove_cron( $cron ) {
		wp_clear_scheduled_hook( 'pc_cron_' . $cron );
	}

	/**
	 * Setup a Post Connector Cron
	 *
	 * @param $cron
	 * @param $recurrence
	 */
	public function setup_cron( $cron, $recurrence='pc_quarter' ) {

		// Add the count words cronjob
		if ( ! wp_next_scheduled( 'pc_cron_' . $cron ) ) {
			wp_schedule_event( time(), $recurrence, 'pc_cron_' . $cron );
		}

	}

}