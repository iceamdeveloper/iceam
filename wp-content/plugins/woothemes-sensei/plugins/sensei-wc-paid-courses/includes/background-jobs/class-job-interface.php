<?php
/**
 * File containing the interface Sensei_WC_Paid_Courses\Background_Jobs\Job_Interface.
 *
 * @package sensei
 */

namespace Sensei_WC_Paid_Courses\Background_Jobs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Interface for background jobs.
 */
interface Job_Interface {
	/**
	 * Get the action name for the scheduled job.
	 *
	 * @return string
	 */
	public function get_name();

	/**
	 * Run the job.
	 */
	public function run();

	/**
	 * After the job runs, check to see if it needs to be re-queued for the next batch.
	 *
	 * @return bool
	 */
	public function is_complete();

	/**
	 * Get the arguments to run with the job.
	 *
	 * @return array
	 */
	public function get_args();

	/**
	 * Get the group name. No need to prefix with `sensei-wc-paid-courses`.
	 *
	 * @return string
	 */
	public function get_group();
}
