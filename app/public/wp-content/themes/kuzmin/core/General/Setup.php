<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 */

namespace MWF\General;

class Setup {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'mwf_setup_theme' ) );

		// Adds support *.svg *.webp *.mp4
		add_filter( 'upload_mimes', array( $this, 'mwf_upload_mimes' ) );

		// Виводить *.svg у медіа
		add_filter( 'wp_prepare_attachment_for_js', array( $this, 'mwf_show_svg_in_media_library' ) );
		add_filter( 'file_is_displayable_image', array( $this, 'webp_is_displayable' ), 10, 2 );

		// Fix *.svg
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'mwf_correct_filetypes' ), 10, 5 );

		// Видаляємо стандартні розміри зображень.
		add_filter( 'intermediate_image_sizes_advanced', array( $this, 'mwf_remove_default_image_sizes' ) );

		// Додаємо мініатюри до постів і сторінок
		add_filter( 'manage_posts_columns', array( $this, 'mwf_add_post_admin_thumbnail_column' ), 2 );
		add_filter( 'manage_pages_columns', array( $this, 'mwf_add_post_admin_thumbnail_column' ), 2 );
		add_action( 'manage_posts_custom_column', array( $this, 'mwf_show_post_thumbnail_column' ), 5, 2 );
		add_action( 'manage_pages_custom_column', array( $this, 'mwf_show_post_thumbnail_column' ), 5, 2 );

		// Забороняємо відключати важливі плагіни
		add_filter( 'plugin_action_links', array( $this, 'mwf_disable_plugin_deactivation' ), 10, 4 );

		// Видалити події та новини WordPress з панелі адміністратора
		add_action( 'wp_dashboard_setup', array( $this, 'mwf_remove_dashboard_widgets' ) );

		// Додаємо favicon для адмін панелі
		// add_action( 'admin_head', [ $this, 'mwf_admin_favicon' ] );

		// Додаємо автора теми в Head
		add_action( 'wp_head', array( $this, 'mwf_add_dev' ), 1 );

		// Налаштовуємо title
		add_filter( 'get_the_archive_title', array( $this, 'mwf_rename_title' ) );
	}

	public function mwf_setup_theme(): void {
		// Adds support title
		add_theme_support( 'title-tag' );

		// Adds thumbnail supports
		add_theme_support( 'post-thumbnails' );

		// Adds supports refresh widgets
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Adding valid HTML5 for forms
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		// Include translation files
		load_theme_textdomain( 'mwf', MWF_PATH . '/languages' );

		// Registering new thumbnail sizes
		add_image_size( 'mwf_admin_thumb', 120, 120, false );
		add_image_size( 'mwf_size_desktop', 1920, 1920, false );
		add_image_size( 'mwf_size_tablet', 1024, 1024, false );
		add_image_size( 'mwf_size_mobile', 768, 768, false );
		add_image_size( 'mwf_size_speed', 370, 370, false );
		add_image_size( 'mwf_size_spec', 384, 533, false );
		add_image_size( 'mwf_size_clinic', 472, 520, true );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		// Load the editor styles in the Gutenberg editor
		add_theme_support( 'editor-styles' );

		// Remove the core block patterns
		remove_theme_support( 'core-block-patterns' );

		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}
	}

	// Adds support *.svg *.webp *.mp4
	public function mwf_upload_mimes( $mimes = array() ) {
		$mimes['svg']     = 'image/svg+xml';
		$mimes['webp']    = 'image/webp';
		$mimes['mp4|m4v'] = 'video/mp4';

		return $mimes;
	}

	// Виводить *.svg у медіа
	public function mwf_show_svg_in_media_library( $response ) {
		if ( $response['mime'] === 'image/svg+xml' ) {
			$response['sizes'] = array(
				'medium' => array(
					'url' => $response['url'],
				),
				'full'   => array(
					'url' => $response['url'],
				),
			);
		}

		return $response;
	}

	// Add preview to *.webp
	public function webp_is_displayable( $result, $path ) {
		if ( $result === false ) {
			$displayable_image_types = array( IMAGETYPE_WEBP );
			$info                    = @getimagesize( $path );

			if ( empty( $info ) ) {
				$result = false;
			} elseif ( ! in_array( $info[2], $displayable_image_types ) ) {
				$result = false;
			} else {
				$result = true;
			}
		}
		return $result;
	}

	// Fix *.svg
	function mwf_correct_filetypes( $data, $file, $filename, $mimes, $real_mime ) {
		if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
			return $data;
		}
		$wp_file_type = wp_check_filetype( $filename, $mimes );
		if ( 'svg' === $wp_file_type['ext'] ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		return $data;
	}

	// Видаляємо стандартні розміри зображень.
	public function mwf_remove_default_image_sizes( $sizes ) {
		unset( $sizes['thumbnail'] );
		unset( $sizes['medium'] );
		unset( $sizes['large'] );
		unset( $sizes['medium_large'] );
		unset( $sizes['1536x1536'] );
		unset( $sizes['2048x2048'] );

		return $sizes;
	}

	// Додаємо мініатюри до постів і сторінок
	function mwf_add_post_admin_thumbnail_column( $swf_columns ) {
		$swf_columns['mwf_thumb'] = __( 'Зображення', 'mwf' );

		return $swf_columns;
	}

	function mwf_show_post_thumbnail_column( $mwf_columns, $mwf_id ) {
		switch ( $mwf_columns ) {
			case 'mwf_thumb':
				if ( function_exists( 'the_post_thumbnail' ) ) {
					echo the_post_thumbnail( 'mwf_admin_thumb' );
				} else {
					echo __( 'hmm... your theme doesn\'t support featured image...', 'mwf' );
				}
				break;
		}
	}

	// Забороняємо відключати важливі плагіни
	public function mwf_disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
		if ( array_key_exists( 'edit', $actions ) ) {
			unset( $actions['edit'] );
		}
		$important_plugins = array(
			'webp-express/webp-express.php',
			'ukr-to-lat/ukr-to-lat.php',
			'permalink-manager-pto/permalink-manager.php',
		);
		if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, $important_plugins ) ) {
			unset( $actions['deactivate'] );
		}

		return $actions;
	}

	// Видалити події та новини WordPress з панелі адміністратора
	public function mwf_remove_dashboard_widgets() {
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	}

	// Додаємо favicon для адмін панелі
	public function mwf_admin_favicon(): void {
		$favicon = get_field( 'favicon', 'option' );
		if ( $favicon ) {
			echo '<link rel="icon" type="image/svg+xml" href="' . $favicon . '">';
		} else {
			echo '<link rel="icon" type="image/png" href="' . MWF_URI . '/assets/images/mwf-favicon.png" />';
		}
	}

	// Додаємо автора теми в Head
	public function mwf_add_dev(): void {
		echo '<meta name="author" content="Serhii Mykulyn">';
	}

	// Налаштовуємо title
	public function mwf_rename_title() {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { // for custom post types
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
}
