<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

// Define path
if ( ! defined( 'MWF_PATH' ) ) {
	define( 'MWF_PATH', untrailingslashit( get_template_directory() ) );
}
if ( ! defined( 'MWF_URI' ) ) {
	define( 'MWF_URI', untrailingslashit( get_template_directory_uri() ) );
}

// Bootstrap
if ( file_exists( MWF_PATH . '/core/Helpers/mwf-bootstrap.php' ) ) {
	require_once MWF_PATH . '/core/Helpers/mwf-bootstrap.php';
}

// Init Classes
mwf_init();