<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Frontend\Lessons.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses\Frontend;

use Sensei_Utils;
use Sensei_WC;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for admin functionality related to courses.
 *
 * @class Sensei_WC_Paid_Courses\Frontend\Lessons
 */
final class Lessons {
	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Lessons constructor. Prevents other instances from being created outside of `Lessons::instance()`.
	 */
	private function __construct() {}

	/**
	 * Initializes the class and adds all filters and actions related to the frontend.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_filter( 'sensei_lesson_show_course_signup_notice', [ $this, 'do_show_course_signup_notice' ], 10, 2 );
		add_filter( 'sensei_lesson_preview_title_text', [ $this, 'lesson_preview_title_text' ], 10, 2 );
	}

	/**
	 * Filter if we should show the course sign up notice on the lesson page.
	 *
	 * @param bool $show_course_signup_notice True if we should show the sign up notice.
	 * @param int  $course_id                 Post ID for the course.
	 * @return bool
	 */
	public function do_show_course_signup_notice( $show_course_signup_notice, $course_id ) {
		// If the course is not purchasable, just return the current value in the filter.
		if ( ! Sensei_WC::is_course_purchasable( $course_id ) ) {
			return $show_course_signup_notice;
		}

		// Show our notice if the user either isn't logged in or is but hasn't started course.
		if ( ! is_user_logged_in() || ! Sensei_Utils::user_started_course( $course_id, get_current_user_id() ) ) {
			add_filter( 'sensei_lesson_course_signup_notice_message', [ $this, 'course_signup_notice_message' ], 10, 3 );
			return true;
		}

		return false;
	}

	/**
	 * Filter the course sign up notice message on the lesson page.
	 *
	 * @param string $message     Message to show user.
	 * @param int    $course_id   Post ID for the course.
	 * @param string $course_link Generated HTML link to the course.
	 * @return string
	 */
	public function course_signup_notice_message( $message, $course_id, $course_link ) {
		// translators: Placeholder is a link to the Course.
		return sprintf( esc_html__( 'Please purchase the %1$s before starting the lesson.', 'sensei-wc-paid-courses' ), $course_link );
	}

	/**
	 * Filter the lesson preview title text and set to "Free Preview" for
	 * lessons in a paid course.
	 *
	 * @param string $preview_text The previous preview text.
	 * @param int    $course_id    Post ID for the course.
	 * @return string
	 */
	public function lesson_preview_title_text( $preview_text, $course_id ) {
		if ( Sensei_WC::is_course_purchasable( $course_id ) ) {
			$preview_text = __( 'Free Preview', 'sensei-wc-paid-courses' );
		}

		return $preview_text;
	}

	/**
	 * Fetches an instance of the class.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
