<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Background_Jobs\Scheduler.
 *
 * @package sensei-wc-paid-courses
 * @since   2.0.0
 */

namespace Sensei_WC_Paid_Courses\Background_Jobs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Handles scheduling of background jobs.
 *
 * @since 2.0.0
 */
class Scheduler {
	const ACTION_SCHEDULER_GROUP_PREFIX = 'sensei-wc-paid-courses-';

	/**
	 * Singleton instance.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Provides singleton instance.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Class constructor. Private so it can only be initialized internally.
	 */
	private function __construct() {}

	/**
	 * Handle the scheduling of a job that might need to be rescheduled after a run.
	 *
	 * @param Job_Interface $job                 Job object.
	 * @param callable|null $completion_callback Optional callback to call upon completion of a job.
	 */
	public function handle_self_scheduling_job( Job_Interface $job, $completion_callback = null ) {
		// Ensure the job is still scheduled.
		$this->schedule_single_job( $job, true );

		$job->run();

		$is_complete = $job->is_complete();
		if ( $is_complete ) {
			$this->cancel_scheduled_job( $job );

			if ( is_callable( $completion_callback ) ) {
				call_user_func( $completion_callback );
			}
		}
	}

	/**
	 * Schedule a single job to run as soon as possible.
	 *
	 * @param Job_Interface $job                Job to schedule.
	 * @param bool          $reschedule_running If true, reschedule if it is currently running.
	 */
	public function schedule_single_job( Job_Interface $job, $reschedule_running = false ) {
		$name  = $job->get_name();
		$args  = [ $job->get_args() ];
		$group = $this->get_job_group( $job );

		$next_scheduled_action = \as_next_scheduled_action( $name, $args, $group );

		if (
			! $next_scheduled_action // Not scheduled.
			|| ( // Currently running.
				$reschedule_running
				&& true === $next_scheduled_action
			)
		) {
			\as_schedule_single_action( time(), $name, $args, $group );
		}
	}

	/**
	 * An abstraction for the `as_unschedule_all_actions` function.
	 *
	 * @param string $hook  The hook that the job will trigger.
	 * @param array  $args  Args that would have been passed to the job.
	 * @param string $group Group name (without the prefix).
	 */
	public function unschedule_all_actions( $hook, $args, $group ) {
		\as_unschedule_all_actions( $hook, $args, $this->get_group_full_name( $group ) );
	}

	/**
	 * Cancel a scheduled job.
	 *
	 * @param Job_Interface $job Job to schedule.
	 */
	public function cancel_scheduled_job( Job_Interface $job ) {
		$name = $job->get_name();
		$args = [ $job->get_args() ];

		$this->unschedule_all_actions( $name, $args, $job->get_group() );
	}

	/**
	 * Stops all jobs that this class is responsible for.
	 */
	public function cancel_all_jobs() {
		$pending_actions = $this->get_pending_actions();
		foreach ( $pending_actions as $action ) {
			$this->unschedule_all_actions( $action->get_hook(), $action->get_args(), $action->get_group() );
		}
	}

	/**
	 * Get the pending ActionScheduler actions for this plugin.
	 *
	 * @param array $args Query args to pass along to \as_get_scheduled_actions.
	 *
	 * @return \ActionScheduler_Action[]
	 */
	public function get_pending_actions( $args = [] ) {
		$args['status']   = \ActionScheduler_Store::STATUS_PENDING;
		$args['per_page'] = -1;

		if ( isset( $args['group'] ) ) {
			$args['group'] = $this->get_group_full_name( $args['group'] );
		}

		/**
		 * Pending job actions.
		 *
		 * @var \ActionScheduler_Action[] $pending_actions
		 */
		$pending_actions = \as_get_scheduled_actions( $args );
		$group_prefix    = self::ACTION_SCHEDULER_GROUP_PREFIX;
		foreach ( $pending_actions as $index => $action ) {
			if ( 0 !== strpos( $action->get_group(), $group_prefix ) ) {
				unset( $pending_actions[ $index ] );
			}
		}

		return array_values( $pending_actions );
	}

	/**
	 * Get the prefixed job group.
	 *
	 * @param Job_Interface $job Job object.
	 *
	 * @return string
	 */
	private function get_job_group( Job_Interface $job ) {
		return $this->get_group_full_name( $job->get_group() );
	}

	/**
	 * Generate the full group name.
	 *
	 * @param string $group Group name.
	 *
	 * @return string
	 */
	private function get_group_full_name( $group ) {
		if ( 0 === strpos( $group, self::ACTION_SCHEDULER_GROUP_PREFIX ) ) {
			return $group;
		}

		return self::ACTION_SCHEDULER_GROUP_PREFIX . $group;
	}
}
