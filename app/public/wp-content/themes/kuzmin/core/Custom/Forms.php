<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\Custom;


class Forms {
	public function __construct() {
		add_action( 'wpcf7_init', [$this, 'mwf_add_form_tag_posts'] );

	}

	public function mwf_add_form_tag_posts(): void {
		wpcf7_add_form_tag( 'posts', [$this, 'mwf_posts_form_tag_handler' ] );
	}

	public function mwf_posts_form_tag_handler( $tag ): string {

		$vacancies = get_field( 'vacancy', get_the_ID() );

		$res = "";
		$index = 0;
		if ( $vacancies ) {

			foreach ( $vacancies as $row ) {
				$index++;
				$res .= "<div class='vacancy-sel'>";
				$res .= '<label for="' . esc_html( $index ) . '">' . esc_html( $row['title'] ) . '</label>';
				$res .= '<input type="checkbox" name="vacancy[]" value="' . esc_html( $row['title'] ) . '" id="' . esc_html( $index ) . '" />';
				$res .= "</div>";
			}

		}

		return $res;
	}
}
