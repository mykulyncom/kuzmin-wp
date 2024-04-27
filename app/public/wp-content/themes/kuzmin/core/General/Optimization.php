<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 */

namespace MWF\General;

class Optimization {
	public function __construct() {
		// Adding the theme author to the admin panel
		add_filter( 'admin_footer_text', array( $this, 'mwf_admin_footer_link' ) );

		// Not showing WordPress version
		remove_action( 'wp_head', 'wp_generator' );

		// Removes code related to emoji support
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Remove RDS links
		remove_action( 'wp_head', 'rsd_link' );

		// Disables editing theme or plugin files through the admin panel
		define( 'DISALLOW_FILE_EDIT', true );

		// Disable xmlrpc.php publications
		add_filter( 'xmlrpc_enabled', '__return_false' );

		// Increase the duration of the cookie
		add_filter( 'auth_cookie_expiration', array( $this, 'mwf_cookie_expiration_new' ), 20, 3 );

		// Disable admin bar
		// add_action( 'init', [ $this, 'mwf_admin_bar' ], 50 );
	}

	// Adding the theme author to the admin panel
	public function mwf_admin_footer_link(): void {
		echo __( 'Theme developer: <a href="https://mykulyn.com" target="_blank">Serhii Mykulyn (mykulyn.com)</a>. Powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.', 'mwf' );
	}

	// // Increase the duration of the cookie
	public function mwf_cookie_expiration_new( $expiration, $user_id, $remember ): float|int {
		if ( $remember && user_can( $user_id, 'manage_options' ) ) {
			if ( $remember === true ) {
				return 20 * DAY_IN_SECONDS;
			}

			return 5 * DAY_IN_SECONDS;
		}
		if ( $remember ) {
			return 360 * DAY_IN_SECONDS;
		}

		return 180 * DAY_IN_SECONDS;
	}

	// Disable admin bar
	public function mwf_admin_bar(): void {
		if ( ! get_field( 'show_admin_bar', 'option' ) ) {
			show_admin_bar( false );
		}
	}
}
