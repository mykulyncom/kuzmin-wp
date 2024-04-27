<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

// Функція з номеру телефону залишає тільки цифри
if ( ! function_exists( 'mwf_phone' ) ) {
	function mwf_phone( $string ): array|string|null {
		return preg_replace( '~[^0-9]+~', '', $string );
	}
}

// var_dump
if ( ! function_exists( 'mwf_vd' ) ) {
	function mwf_vd(): void {
		echo '<pre>';
		array_map( function ( $value ) {
			var_dump( $value );
		}, func_get_args() );
		echo '</pre>';
	}
}

// Функція переформатовує в нижній регістр
if ( ! function_exists( 'mwf_lowercase' ) ) {
	function mwf_lowercase( $value ): string {
		return mb_strtolower( $value );
	}
}

if ( ! function_exists( 'mwf_webp' ) ) {
	function mwf_webp( $src ): string {
		return preg_replace( "/(.png)|(.jpg)|(.jpeg)/", ".webp", $src );
	}
}


// Отримуємо alt
function mwf_get_image_alt( $image_url ) {
	global $wpdb;

	$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

	$alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

	return $alt_text;
}

// SVG icons
function mwf_icon( $icon ): void {
	if ( empty( $icon ) ) {
		return;
	}

	$svg_file_path = MWF_PATH . '/source/icons/' . $icon . '.svg';

	if ( ! file_exists( $svg_file_path ) ) {
		return;
	}

	$svg_file = file_get_contents( $svg_file_path );

	$svg_dom = new DOMDocument();
	$svg_dom->loadXML( $svg_file );

	foreach ( $svg_dom->getElementsByTagName( 'path' ) as $path ) {
		$path->setAttribute( 'fill', '' );
		if ( str_contains( $path->getAttribute( 'style' ), 'stroke' ) ) {
			$path->setAttribute( 'style', '' );
		} else {
			$path->setAttribute( 'style', '' );
		}
	}
	$svg_file_new = $svg_dom->saveXML();
	echo "<span class='icon icon-$icon'>$svg_file_new</span>";
}

function mwf_heading( $title, $link = false): void { ?>
	<section class="mwf-heading">
		<div class="container mwf-heading__inner">
			<?php if ( ! $link ) : ?>
				<h2 class="mwf-heading__title"><?php echo __( $title, 'mwf' ); ?></h2>
			<?php else : ?>
				<h2 class="mwf-heading__title">
					<a href="<?php echo home_url(); ?>/<?php echo $link; ?>" class="mwf-heading__link"><?php echo __( $title, 'mwf' ); ?></a>
				</h2>
			<?php endif; ?>
		</div>
	</section>
<?php }

function mwf_get_menu_id( $location ): int|string {
	$locations = get_nav_menu_locations();
	$menu_id = $locations[ $location ];

	return ! empty( $menu_id ) ? $menu_id : '';
}

function mwf_get_child_menu_item( $menu_array, $paren_id ): array {
	$child_menu = [];
	if ( ! empty( $menu_array ) && is_array( $menu_array) ) {
		foreach ( $menu_array as $menu ) {
			if ( intval( $menu->menu_item_parent ) === $paren_id )  {
				array_push( $child_menu, $menu );
			}
		}
	}

	return $child_menu;
}

function mwf_custom_excerpt_length( $length ): int {
	return 38;
}
add_filter( 'excerpt_length', 'mwf_custom_excerpt_length', 999 );

function mwf_excerpt_more( $more ): string {
	return '';
}
add_filter('excerpt_more', 'mwf_excerpt_more');


function mwf_post_remove(): void {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php?post_type=acf-field-group' );
}

add_action( 'admin_menu', 'mwf_post_remove' );