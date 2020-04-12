<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Frontend\Quizzes.
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
 * Class for admin functionality related to quizzes.
 *
 * @class Sensei_WC_Paid_Courses\Frontend\Quizzes
 */
final class Quizzes {
	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Lessons constructor. Prevents other instances from being created outside of `Quizzes::instance()`.
	 */
	private function __construct() {}

	/**
	 * Initializes the class and adds all filters and actions related to the frontend.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_filter( 'sensei_quiz_course_signup_notice_message', [ $this, 'course_signup_notice_message' ], 10, 3 );
	}

	/**
	 * Filter the course sign up notice message on the quiz page.
	 *
	 * @param string $message     Message to show for the course sign up notice.
	 * @param int    $course_id   Post ID for the course.
	 * @param string $course_link Generated HTML link to the course.
	 * @return string
	 */
	public function course_signup_notice_message( $message, $course_id, $course_link ) {
		if ( Sensei_WC::is_course_purchasable( $course_id ) ) {
			// translators: Placeholder is a link to the course permalink.
			$message = sprintf( __( 'Please purchase the %1$s before taking this quiz.', 'sensei-wc-paid-courses' ), $course_link );
		}
		return $message;
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
