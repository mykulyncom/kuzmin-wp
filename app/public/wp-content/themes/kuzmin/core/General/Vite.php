<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\General;

// Define dist directory and base uri, and path
define('DIST_DIR', 'assets/build');
define('DIST_URI', MWF_URI . '/' . DIST_DIR);
define('DIST_PATH', MWF_PATH . '/' . DIST_DIR);

// Default server address and entry point
define('VITE_ENV', $_SERVER['VITE_ENV']);
define('VITE_SERVER', $_SERVER['VITE_SERVER']);
define('VITE_JS', '/assets/scripts/main.js');
define('VITE_MAIN_STYLES', '/assets/styles/main.scss');
define('VITE_EDITOR_STYLES', '/assets/styles/editor.scss');
define('VITE_ADMIN_STYLES', '/assets/styles/admin.scss');

class Vite {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'mwf_vite_hmr' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'mwf_vite_hmr_admin' ] );
		add_action( 'after_setup_theme', [ $this, 'mwf_vite_hmr_editor' ] );
	}

	// FrontEnd
	public function mwf_vite_head_front(): void {
		echo '<script type="module" src="' . VITE_SERVER . '/@vite/client"></script>';
		echo '<script type="module" src="' . VITE_SERVER . VITE_JS . '"></script>';
		echo '<script type="module" src="' . VITE_SERVER . VITE_MAIN_STYLES . '"></script>';
	}

	public function mwf_vite_hmr(): void {
		if ( VITE_ENV == 'development' ) {
			add_action( 'wp_head', [$this, 'mwf_vite_head_front'] );
		} else {
			// Production version
			$manifest = json_decode( file_get_contents( DIST_PATH . '/manifest.json' ), true );
			if ( is_array( $manifest ) ) {
				// Styles
				wp_enqueue_style( 'mwf-main', DIST_URI . '/' . $manifest['assets/styles/main.scss']['file'] );

				// Scripts
				wp_enqueue_script( 'mwf-main', DIST_URI . '/' . $manifest['assets/scripts/main.js']['file'], [], false, true );
			}
		}
	}

	// Admin
	public function mwf_vite_head_admin(): void {
		echo '<script type="module" src="' . VITE_SERVER . '/@vite/client"></script>';
		echo '<script type="module" src="' . VITE_SERVER . VITE_ADMIN_STYLES . '"></script>';
	}
	public function mwf_vite_hmr_admin(): void {
		if ( VITE_ENV == 'development' ) {
			add_action( 'admin_head', [$this, 'mwf_vite_head_admin'] );
		} else {
			// Production version
			$manifest = json_decode( file_get_contents( DIST_PATH . '/manifest.json' ), true );
			if ( is_array( $manifest ) ) {
				// Styles
				wp_enqueue_style( 'mwf-admin-styles', DIST_URI . '/' . $manifest['assets/styles/admin.scss']['file'] );
			}
		}
	}

	// Editor
	public function mwf_vite_head_editor(): void {
		echo '<script type="module" src="' . VITE_SERVER . VITE_EDITOR_STYLES . '"></script>';
	}

	public function mwf_vite_hmr_editor(): void {
		if ( VITE_ENV == 'development' ) {
			add_action( 'the_editor_content', [$this, 'mwf_vite_head_editor'] );
		} else {
			// Production version
			$manifest = json_decode( file_get_contents( DIST_PATH . '/manifest.json' ), true );
			if ( is_array( $manifest ) ) {
				// Path to our custom editor styles
				add_editor_style( DIST_URI . '/' . $manifest['assets/styles/editor.scss']['file'] );
			}
		}
	}


}
