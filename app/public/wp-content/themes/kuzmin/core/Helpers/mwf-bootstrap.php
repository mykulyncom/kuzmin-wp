<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

if ( ! file_exists( $composer = MWF_PATH . '/vendor/autoload.php' ) ) {
	wp_die( __( 'Error locating autoloader. Please run <code>composer install</code>', 'mwf' ) );
}

require $composer;

if ( ! function_exists( 'mwf_init' ) ) {
	function mwf_init(): void {
		MWF\Init::register_services();
	}
}
