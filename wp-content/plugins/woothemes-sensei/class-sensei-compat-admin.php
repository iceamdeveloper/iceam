<?php
/**
 * File containing the class Sensei_Compat_Admin.
 *
 * @package sensei-compat
 * @since   1.0.0
 */

/**
 * Sensei_Compat_Admin class.
 */
class Sensei_Compat_Admin {
	/**
	 * Initialize admin actions and filters.
	 */
	public static function init() {
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 4 );
		add_filter( 'install_plugins_search', array( __CLASS__, 'load_plugin_information' ) );
		if ( SENSEI_COMPAT_LOADING_SENSEI ) {
			add_filter( 'site_transient_update_plugins', array( __CLASS__, 'add_sensei_translations' ) );
		}
	}

	/**
	 * Adds Sensei's language pack updates to the `update_plugins` transient.
	 *
	 * @access private
	 *
	 * @param \stdClass $value Current value of `update_plugins` transient.
	 * @return \stdClass
	 */
	public static function add_sensei_translations( $value ) {
		if ( empty( $value ) ) {
			return $value;
		}
		$translations_available = self::get_sensei_language_pack_updates();
		foreach ( $translations_available as $locale => $package ) {
			$value->translations[] = $package;
		}
		return $value;
	}

	/**
	 * Gets the available language package updates.
	 *
	 * @return array
	 */
	private static function get_sensei_language_pack_updates() {
		global $wp_version;

		static $plugin_translations;

		if ( isset( $plugin_translations ) ) {
			return $plugin_translations;
		}

		$plugin_translations        = array();
		$installed_translations_raw = wp_get_installed_translations( 'plugins' );
		$installed_translations     = array();

		// Only pass translations installed for Sensei.
		if ( isset( $installed_translations_raw['sensei-lms'] ) ) {
			$installed_translations['sensei-lms'] = $installed_translations_raw['sensei-lms'];
		}

		$to_send            = array();
		$to_send['plugins'] = array(
			'sensei-lms/sensei-lms.php' => array(
				'Name'       => 'Sensei LMS',
				'Title'      => 'Sensei LMS',
				'Version'    => Sensei()->version,
				'TextDomain' => 'sensei-lms',
			),
		);
		$to_send['active']  = array( 'sensei-lms/sensei-lms.php' );

		$locales = array_values( get_available_languages() );

		/** This action is documented in WordPress core's wp-includes/update.php */
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		$locales = apply_filters( 'plugins_update_check_locales', $locales );
		$locales = array_unique( $locales );

		$options = array(
			'timeout'    => 10,
			'body'       => array(
				'plugins'      => wp_json_encode( $to_send ),
				'translations' => wp_json_encode( $installed_translations ),
				'locale'       => wp_json_encode( $locales ),
				'all'          => wp_json_encode( true ),
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
		);

		$url = 'http://api.wordpress.org/plugins/update-check/1.1/';
		$ssl = wp_http_supports( array( 'ssl' ) );
		if ( $ssl ) {
			$url = set_url_scheme( $url, 'https' );
		}
		$raw_response = wp_remote_post( $url, $options );
		if ( is_wp_error( $raw_response ) || 200 !== intval( wp_remote_retrieve_response_code( $raw_response ) ) ) {
			return array();
		}

		$response = json_decode( wp_remote_retrieve_body( $raw_response ), true );
		if ( is_array( $response ) && ! empty( $response['translations'] ) ) {
			$plugin_translations = $response['translations'];
		}

		return $plugin_translations;
	}

	/**
	 * Adds details about the plugins packaged within this compatibility plugin.
	 *
	 * @param string[] $plugin_meta An array of the plugin's metadata,
	 *                              including the version, author,
	 *                              author URI, and plugin URI.
	 * @param string   $plugin_file Path to the plugin file relative to the plugins directory.
	 * @param array    $plugin_data An array of plugin data.
	 * @param string   $status      Status of the plugin. Defaults are 'All', 'Active',
	 *                              'Inactive', 'Recently Activated', 'Upgrade', 'Must-Use',
	 *                              'Drop-ins', 'Search'.
	 * @return string[]
	 */
	public static function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
		if ( ! in_array( $plugin_file, [ 'woothemes-sensei/woothemes-sensei.php', 'sensei/woothemes-sensei.php' ], true ) ) {
			return $plugin_meta;
		}

		if ( 'sensei-compat' !== $plugin_data['TextDomain'] ) {
			return $plugin_meta;
		}

		unset( $plugin_meta[0] );

		if ( SENSEI_COMPAT_LOADING_WC_PAID_COURSES && defined( 'SENSEI_WC_PAID_COURSES_VERSION' ) ) {
			// translators: placeholder is current version of WooCommerce Paid Courses.
			array_unshift( $plugin_meta, esc_html( sprintf( __( 'WooCommerce Paid Courses Version: %s', 'sensei-compat' ), SENSEI_WC_PAID_COURSES_VERSION ) ) );
		}

		if ( SENSEI_COMPAT_LOADING_SENSEI && function_exists( 'Sensei' ) ) {
			// translators: placeholder is current version of Sensei.
			array_unshift( $plugin_meta, esc_html( sprintf( __( 'Sensei LMS Version: %s', 'sensei-compat' ), Sensei()->version ) ) );
		}

		return $plugin_meta;
	}

	/**
	 * Manually load the plugin information on `plugin-install.php` page load.
	 */
	public static function load_plugin_information() {
		$plugins_handled = [
			'sensei-lms'  => 'Sensei LMS',
			'woocommerce' => 'WooCommerce',
		];
		// phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
		if ( empty( $_GET['plugin_details'] ) || ! isset( $plugins_handled[ $_GET['plugin_details'] ] ) ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
		$plugin_slug = sanitize_title( $_GET['plugin_details'] );
		$plugin_name = $plugins_handled[ $plugin_slug ];

		$details_link = self_admin_url(
			'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin_slug .
			'&amp;TB_iframe=true&amp;width=600&amp;height=550'
		);

		printf(
			'<a href="%1$s" style="display: none;" id="plugin-information-onload" class="thickbox open-plugin-details-modal" data-title="%2$s">%2$s</a>',
			esc_url( $details_link ),
			esc_attr( $plugin_name )
		);

		?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				setTimeout( function () {
					$('#plugin-information-onload').click();
				} );
			} );
		</script>
		<?php
	}
}
