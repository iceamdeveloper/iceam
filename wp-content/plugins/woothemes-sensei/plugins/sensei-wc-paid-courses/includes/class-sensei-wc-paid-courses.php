<?php
/**
 * File containing the class \Sensei_WC_Paid_Courses\Sensei_WC_Paid_Courses.
 *
 * @package sensei-wc-paid-courses
 * @since   1.0.0
 */

namespace Sensei_WC_Paid_Courses;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Sensei_Templates;

/**
 * Main Sensei WooCommerce Paid Courses class.
 *
 * @class Sensei_WC_Paid_Courses
 */
final class Sensei_WC_Paid_Courses {
	const SCRIPT_ADMIN_COURSE_METADATA = 'sensei-wcpc-admin-course-metadata';

	/**
	 * Instance of class.
	 *
	 * @var Sensei_WC_Paid_Courses
	 */
	private static $instance;

	/**
	 * Plugin directory.
	 *
	 * @var string
	 */
	public $plugin_dir;

	/**
	 * Plugin URL.
	 *
	 * @var string
	 */
	public $plugin_url;

	/**
	 * Asset suffix.
	 *
	 * @var string
	 */
	protected $script_asset_suffix;

	/**
	 * Initialize the singleton instance.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		$this->script_asset_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$this->plugin_dir          = dirname( __DIR__ );
		$this->plugin_url          = untrailingslashit( plugins_url( '', SENSEI_WC_PAID_COURSES_PLUGIN_BASENAME ) );
	}

	/**
	 * Initializes the class and adds all filters and actions.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $init_all Pass in `true` to load and initialize both frontend and admin functionality. `false` by default.
	 */
	public static function init( $init_all = false ) {
		$instance = self::instance();

		add_action( 'init', [ $instance, 'load_plugin_textdomain' ], 0 );

		$skip_plugin_deps_check = defined( 'SENSEI_WC_PAID_COURSES_SKIP_DEPS_CHECK' ) && SENSEI_WC_PAID_COURSES_SKIP_DEPS_CHECK;
		if ( ! $skip_plugin_deps_check && ! \Sensei_WC_Paid_Courses_Dependency_Checker::are_plugin_dependencies_met() ) {
			return;
		}

		$instance->include_dependencies( $init_all );

		Deprecated_Hooks::init();
		Courses::instance()->init();
		Settings::instance()->init();
		Widgets::instance()->init();

		/**
		 * Hook in WooCommerce functionality.
		 */
		add_action( 'init', [ 'Sensei_WC', 'load_woocommerce_integration_hooks' ] );

		/**
		 * Hook in WooCommerce Memberships functionality.
		 */
		add_action( 'init', [ 'Sensei_WC_Memberships', 'load_wc_memberships_integration_hooks' ] );

		/**
		 * Hook in WooCommerce Subscriptions functionality.
		 */
		add_action( 'init', [ 'Sensei_WC_Subscriptions', 'load_wc_subscriptions_integration_hooks' ] );

		if ( $init_all || ! is_admin() ) {
			add_action( 'init', [ $instance, 'frontend_init' ] );
		}

		if ( $init_all ) {
			add_action( 'init', [ $instance, 'admin_init' ] );
		} else {
			add_action( 'admin_init', [ $instance, 'admin_init' ] );
		}

		add_action( 'admin_enqueue_scripts', [ $instance, 'register_admin_scripts' ], 9 );
		add_action( 'enqueue_block_editor_assets', [ $instance, 'enqueue_block_editor_assets' ] );

		// Filter base fields for event logging.
		add_filter( 'sensei_event_logging_base_fields', [ $instance, 'filter_event_logging_base_fields' ] );

		// Set up REST API endpoints.
		add_action( 'rest_api_init', [ $instance, 'init_rest_api_endpoints' ], 1 );
	}

	/**
	 * Initializes the frontend functionality.
	 *
	 * @since 1.0.0
	 */
	public function frontend_init() {
		Frontend\Courses::instance()->init();
		Frontend\Quizzes::instance()->init();
		Frontend\Lessons::instance()->init();
		Frontend\Shortcodes::instance()->init();
	}

	/**
	 * Initializes the admin functionality.
	 *
	 * @since 1.0.0
	 */
	public function admin_init() {
		Admin\Language_Packs::instance()->init();
		Admin\Courses::instance()->init();
	}

	/**
	 * Registers scripts used in admin.
	 */
	public function register_admin_scripts() {
		wp_register_script( self::SCRIPT_ADMIN_COURSE_METADATA, $this->plugin_url . '/assets/js/admin-course-metadata' . $this->script_asset_suffix . '.js', [ 'jquery' ], SENSEI_WC_PAID_COURSES_VERSION, true );
		wp_localize_script(
			self::SCRIPT_ADMIN_COURSE_METADATA,
			'sensei_admin_course_metadata',
			[
				'product_options_placeholder' => __( 'Select a product', 'sensei-wc-paid-courses' ),
			]
		);
	}

	/**
	 * Enqueue an asset for the block editor.
	 *
	 * @since 1.2.0
	 *
	 * @param string $script The built JS filename without the suffix.
	 */
	public function enqueue_block_editor_asset( $script ) {
		if ( ! $this->is_block_editor_supported() ) {
			return;
		}

		$handle = $this->block_editor_asset_handle( $script );
		$src    = $this->plugin_url . "/assets/block-editor/build/$script.js";

		// Load script dependencies.
		$deps_json_path = $this->plugin_dir . "/assets/block-editor/build/$script.deps.json";

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Safe local file.
		$deps = file_exists( $deps_json_path ) ? json_decode( file_get_contents( $deps_json_path ) ) : [];

		wp_enqueue_script( $handle, $src, $deps, SENSEI_WC_PAID_COURSES_VERSION, true );
	}

	/**
	 * Localize an asset for the block editor.
	 *
	 * @since 1.2.0
	 *
	 * @param string $script The built JS filename without the suffix.
	 * @param array  $data   The localization data.
	 */
	public function localize_block_editor_asset( $script, $data ) {
		if ( ! $this->is_block_editor_supported() ) {
			return;
		}

		$handle = $this->block_editor_asset_handle( $script );
		wp_localize_script( $handle, str_replace( '-', '_', $handle ), $data );
	}

	/**
	 * Enqueues assets for the block editor for the Course and Lesson editors.
	 *
	 * @access private
	 * @since 1.1.0
	 */
	public function enqueue_block_editor_assets() {
		$screen    = get_current_screen();
		$post_type = $screen->id;

		if ( ! $this->is_block_editor_supported() ) {
			return;
		}

		if ( in_array( $post_type, [ 'lesson', 'course' ], true ) ) {
			$this->enqueue_block_editor_asset( $post_type );
		}
	}

	/**
	 * Determine whether block editor customizations are supported.
	 *
	 * @return bool
	 */
	public function is_block_editor_supported() {
		global $woocommerce;

		$wc_version     = $woocommerce->version;
		$min_wc_version = '3.6';

		return version_compare( $min_wc_version, $wc_version, '<=' );
	}

	/**
	 * Get the handle for the given script.
	 *
	 * @access private
	 * @since 1.2.0
	 *
	 * @param string $script The built JS filename without the suffix.
	 * @return string
	 */
	private function block_editor_asset_handle( $script ) {
		return "sensei-wc-paid-courses-block-editor-$script";
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

	/**
	 * Include required files.
	 *
	 * @param bool $load_all Load all dependencies for frontend and admin.
	 */
	private function include_dependencies( $load_all = false ) {
		include_once $this->plugin_dir . '/includes/woocommerce-integrations/class-sensei-wc.php';
		include_once $this->plugin_dir . '/includes/woocommerce-integrations/class-sensei-wc-memberships.php';
		include_once $this->plugin_dir . '/includes/woocommerce-integrations/class-sensei-wc-subscriptions.php';
		include_once $this->plugin_dir . '/includes/woocommerce-integrations/class-sensei-wc-utils.php';

		include_once $this->plugin_dir . '/includes/class-deprecated-hooks.php';
		include_once $this->plugin_dir . '/includes/class-courses.php';
		include_once $this->plugin_dir . '/includes/class-settings.php';
		include_once $this->plugin_dir . '/includes/class-widgets.php';

		// Load admin dependencies.
		if ( $load_all || is_admin() ) {
			include_once $this->plugin_dir . '/includes/admin/class-language-packs.php';
			include_once $this->plugin_dir . '/includes/admin/class-courses.php';
		}

		// Load frontend dependencies.
		if ( $load_all || ! is_admin() ) {
			include_once $this->plugin_dir . '/includes/frontend/class-courses.php';
			include_once $this->plugin_dir . '/includes/frontend/class-quizzes.php';
			include_once $this->plugin_dir . '/includes/frontend/class-lessons.php';
			include_once $this->plugin_dir . '/includes/frontend/class-shortcodes.php';
		}
	}

	/**
	 * Loads textdomain for plugin.
	 */
	public function load_plugin_textdomain() {
		$domain = 'sensei-wc-paid-courses';
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Using commonly used core hook to fetch locales.
		$locale = apply_filters( 'plugin_locale', $locale, $domain );

		unload_textdomain( $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Filter the base fields for Sensei event logging.
	 *
	 * @since 1.0.1
	 * @access private
	 *
	 * @param array $base_fields The previous fields.
	 *
	 * @return array
	 */
	public function filter_event_logging_base_fields( $base_fields ) {
		$base_fields['paid'] = 1;
		return $base_fields;
	}

	/**
	 * Initialize REST API endpoints.
	 */
	public function init_rest_api_endpoints() {
		include_once $this->plugin_dir . '/includes/rest-api/controllers/class-course-products.php';
	}

	/**
	 * Get a template file.
	 *
	 * @since 1.1.0
	 *
	 * @param string $template_name Template name.
	 * @param array  $args          Optional. Arguments to pass to template. Default empty array.
	 */
	public static function get_template( $template_name, $args = [] ) {
		Sensei_Templates::get_template(
			$template_name,
			$args,
			'sensei-wc-paid-courses/',
			untrailingslashit( dirname( SENSEI_WC_PAID_COURSES_PLUGIN_FILE ) ) . '/templates/'
		);
	}

	/**
	 * Get a template part.
	 *
	 * The load order is:
	 *
	 * yourtheme/{$slug}-{$name}.php
	 * yourtheme/sensei-wc-paid-courses/{$slug}-{$name}.php
	 * plugins/sensei-wc-paid-courses/templates/{$slug}-{$name}.php
	 * yourtheme/{$slug}.php
	 * yourtheme/sensei-wc-paid-courses/{$slug}.php
	 *
	 * @since 1.1.0
	 *
	 * @param string $slug Template slug.
	 * @param string $name Optional. Template name. Default null.
	 * @param array  $args  Optional. Arguments to pass to template part. Default empty array.
	 */
	public static function get_template_part( $slug, $name = null, $args = [] ) {
		if ( $args && is_array( $args ) ) {
			extract( $args ); // @codingStandardsIgnoreLine
		}

		if ( $name ) {
			// First, look in yourtheme/{$slug}-{$name}.php and yourtheme/sensei-wc-paid-course/{$slug}-{$name}.php.
			$template = locate_template(
				[
					"{$slug}-{$name}.php",
					'sensei-wc-paid-courses/' . "{$slug}-{$name}.php",
				]
			);

			// If the template file was not found, look in plugins/sensei-wc-paid-courses/templates/{$slug}-{$name}.php.
			if ( ! $template ) {
				$fallback = dirname( SENSEI_WC_PAID_COURSES_PLUGIN_FILE ) . "/templates/{$slug}-{$name}.php";
				$template = file_exists( $fallback ) ? $fallback : '';
			}
		}

		// If the template file was still not found, look in yourtheme/{$slug}.php and yourtheme/sensei-wc-paid-course/{$slug}.php.
		if ( ! $template ) {
			$template = locate_template(
				[
					"{$slug}.php",
					'sensei-wc-paid-courses/' . "{$slug}.php",
				]
			);
		}

		/**
		 * Filter the template filename.
		 *
		 * @since 1.1.0
		 *
		 * @param string $template Template filename.
		 * @param string $slug     Template slug.
		 * @param string $name     Optional. Template name. Default null.
		 */
		$template = apply_filters( 'sensei_wc_paid_courses_get_template_part', $template, $slug, $name );

		if ( $template ) {
			include $template;
		}
	}
}
