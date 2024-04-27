<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\Custom;

class Menus {
	public function __construct() {
		// Реєструємо меню
		add_action( 'after_setup_theme', [ $this, 'mwf_register_menus' ] );

		// Видаляємо класи у li та a
		add_filter( 'nav_menu_css_class', [ $this, 'mwf_remove_class_menu_li' ], 100, 1 );
		add_filter( 'nav_menu_item_id', [ $this, 'mwf_remove_class_menu_li' ], 100, 1 );
		add_filter( 'page_css_class', [ $this, 'mwf_remove_class_menu_li' ], 100, 1 );

		// Додаємо клас до посилання меню
		add_filter( 'nav_menu_link_attributes', [ $this, 'mwf_add_class_to_menu_link' ], 1, 3 );

	}

	// Реєструємо меню
	public function mwf_register_menus(): void {
		add_theme_support( 'menus' );

		register_nav_menus( [
				'global_menu' => esc_html__( 'Основне меню', 'mwf' ),
				'footer_menu' => esc_html__( 'Меню в футері', 'mwf' ),
			]
		);
	}

	// Видаляємо класи у li та a
	public function mwf_remove_class_menu_li( $var ): array|string {
		return is_array( $var ) ? array_intersect( $var, [ 'current-menu-item' ] ) : '';
	}

	// Додаємо клас до посилання меню
	public function mwf_add_class_to_menu_link( $atts, $item, $args ) {
		if ( 'footer_menu' === $args->theme_location ) {
			$atts['class'] = 'footer-nav__link';
		}
		return $atts;
	}

}
