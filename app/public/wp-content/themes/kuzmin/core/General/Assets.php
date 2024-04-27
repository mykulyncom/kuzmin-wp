<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\General;

class Assets {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'mwf_register_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'mwf_register_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'mwf_enqueue_admin_styles' ] );
		add_action( 'after_setup_theme', [ $this, 'mwf_editor_style' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'mwf_editor_scripts' ] );
	}

	public function mwf_register_scripts(): void {
		// Register scripts
		wp_register_script( 'mwf-bundle', MWF_URI . '/assets/scripts/bundle.js', [], filemtime( MWF_PATH . '/assets/scripts/bundle.js' ), [
			'strategy' => 'defer'
		] );

		// Enqueue scripts
		wp_enqueue_script( 'mwf-bundle' );

		// Deregister jQuery
		wp_deregister_script( 'jquery' );
	}

	public function mwf_register_styles(): void {
		// Register styles
		wp_register_style( 'mwf-styles', MWF_URI . '/assets/styles/main.min.css', [], filemtime( MWF_PATH . '/assets/styles/main.min.css' ) );

		// Enqueue styles
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
		wp_enqueue_style( 'mwf-styles' );
	}

	public function mwf_enqueue_admin_styles(): void {
		wp_enqueue_style( 'mwf-admin-styles', MWF_URI . '/assets/styles/admin.min.css', [], filemtime( MWF_PATH . '/assets/styles/admin.min.css' ) );
	}

	public function mwf_editor_scripts(): void {
		// Register scripts
		wp_register_script( 'mwf-editor-bundle', MWF_URI . '/assets/scripts/editor-bundle.js', [], filemtime( MWF_PATH . '/assets/scripts/editor-bundle.js' ) );

		// Enqueue scripts
		wp_enqueue_script( 'mwf-editor-bundle' );
	}

	public function mwf_editor_style(): void {
		// Path to our custom editor styles
		add_editor_style( 'assets/styles/editor.min.css' );
	}


}
