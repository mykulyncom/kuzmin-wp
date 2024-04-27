<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
namespace MWF\General;

use Walker_Nav_Menu;

class WalkerNav extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = NULL ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-navigation',
			( $display_depth >=2 ? 'sub-navigation--right' : '' )
		);
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// add main/sub classes to li's and links
	function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		global $wp_query;

		// Restores the more descriptive, specific name for use within this method.
		$item = $data_object;

		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'navigation__item' : 'sub-navigation__item' ),
			( $depth >= 2 ? 'sub-navigation__item' : '' ) // Changed here
		);

		// Check if item has children
		$has_children = ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes );

		if ( $depth == 0 && $has_children ) { // Only add 'has_children' class for main level items
			$depth_classes[] = 'navigation__dropdown';
		}

		if ( $depth >= 1 && $has_children ) { // Only add 'has_children' class for main level items
			$depth_classes[] = 'sub-navigation__dropdown';
		}

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="' . ( $depth > 0 ? 'sub-navigation__link' : 'navigation__link' ) . '"';

		// If item has children, add a button
		if ( $has_children ) {
			$item_output = sprintf(
				'%1$s<a%2$s><span>%3$s%4$s%5$s</span></a>%6$s<button class="nav-open-sub"></button>',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		} else {
			$item_output = sprintf(
				'%1$s<a%2$s><span>%3$s%4$s%5$s</span></a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}



}
