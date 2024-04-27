<?php
/**
 * Front page template
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;


class Blocks {
	public function __construct() {
		add_action( 'block_categories_all', [ $this, 'mwf_block_categories' ], 10, 2 );
		add_action( 'wp_enqueue_scripts', [ $this, 'mwf_remove_block_styles' ] );

		// Not inline style.
		add_filter( 'styles_inline_size_limit', '__return_zero' );
	}

	// Add new blocks category
	public function mwf_block_categories( $categories ) {
		$mwf_category = [
			'slug'  => 'mwf-blocks',
			'title' => __( 'Мои блоки', 'mwf' )
		];
		array_unshift( $categories, $mwf_category );

		return $categories;
	}

	// Delete blocks style
	public function mwf_remove_block_styles(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wp-block-style' ); // Remove WooCommerce block
		wp_dequeue_style( 'global-styles' ); // Remove global style
	}
}
