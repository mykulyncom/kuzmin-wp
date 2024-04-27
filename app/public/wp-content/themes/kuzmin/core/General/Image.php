<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\General;

class Image {
	public function __construct() {
	}

	static function show( $size = 'xxl' ): void {
		$post_id   = get_the_ID();
		$image_id  = get_post_thumbnail_id();
		$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		switch ( $size ) {
			case 'mobile':
				echo '<img src="' . mwf_webp( get_the_post_thumbnail_url( $post_id, 'mwf_size_mobile' ) ) . '" width="768" height="768" loading="lazy" decoding="async" alt="' . $image_alt . '" />';
				break;

			case 'tablet':
				echo '<picture';
				break;
		}
	}
}