<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\Plugins;

if ( ! defined( 'MWF_BLOCKS' ) ) {
	define( 'MWF_BLOCKS', MWF_PATH . '/blocks/' );
}

class CustomFields {
	public function __construct() {
		// Register blocks
		add_action( 'init', [ $this, 'mwf_register_acf_blocks' ] );

		// Upload default image
		add_action( 'acf/render_field_settings/type=image', [ $this, 'mwf_default_image_field' ] );

		// Disable update plugin
		add_filter( 'site_transient_update_plugins', [ $this, 'mwf_plugin_updates' ] );

		// Disable deactivation
		add_filter( 'plugin_action_links', [ $this, 'mwf_disable_acf_deactivation' ], 10, 4 );

		// Hide plugin
		add_filter( 'all_plugins', [ $this, 'mwf_hide_acf' ] );

		// Icon picker
		add_filter( 'acf_icon_path_suffix', [ $this, 'mwf_icon_path_suffix' ] );
		add_filter( 'acf_icon_path', [ $this, 'mwf_icon_path' ] );
		add_filter( 'acf_icon_url', [ $this, 'mwf_icon_url' ] );

	}

	// Register blocks
	public function mwf_register_acf_blocks(): void {
		if ( file_exists( MWF_BLOCKS ) ) {
			$block_json_files = glob( MWF_BLOCKS . '*/block.json' );
			foreach ( $block_json_files as $filename ) {
				$block_folder = dirname( $filename );
				register_block_type( $block_folder );
			};
		};
	}

	// Upload default image
	public function mwf_default_image_field( $field ): void {
		acf_render_field_setting( $field, [
			'label'        => __( 'Default Image', 'mwf' ),
			'instructions' => __( 'Appears when creating a new post', 'mwf' ),
			'type'         => 'image',
			'name'         => 'default_value',
		] );
	}

	// Disable update ACF
	public function mwf_plugin_updates( $value ) {
		unset( $value->response['advanced-custom-fields-pro/acf.php'] );
		unset( $value->response['permalink-manager-pto/permalink-manager.php'] );
		unset( $value->response['acf-icon-picker-1.9.1/acf-icon-picker.php'] );

		return $value;
	}

	// Disable deactivation ACF
	public function mwf_disable_acf_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
		if ( array_key_exists( 'edit', $actions ) ) {
			unset( $actions['edit'] );
		}
		$important_plugins = [
			'advanced-custom-fields-pro/acf.php',
			'acf-icon-picker-1.9.1/acf-icon-picker.php'
		];
		if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, $important_plugins ) ) {
			unset( $actions['deactivate'] );
		}

		return $actions;
	}

	// Hide ACF
	public function mwf_hide_acf( $plugins ) {
		if ( in_array( 'advanced-custom-fields-pro/acf.php', array_keys( $plugins ) ) ) {
			unset( $plugins['advanced-custom-fields-pro/acf.php'] );
			unset( $plugins['acf-icon-picker-1.9.1/acf-icon-picker.php'] );
		}

		return $plugins;
	}

	// Icon picker
	public function mwf_icon_path_suffix( $path_suffix ): string {
		return 'source/icons/';
	}
	public function mwf_icon_path( $path_suffix ): string {
		return MWF_PATH;
	}
	public function mwf_icon_url( $path_suffix ): string {
		return MWF_PATH;
	}
}
