<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */


if ( has_nav_menu( 'global_menu' ) ) {
	wp_nav_menu( [
		'theme_location'   => 'global_menu',
		'container' => 'nav',
		'container_class' => 'navigation',
		'container_id'    => '',
		'menu_class' => 'navigation__list',
		'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		'walker' => new \MWF\General\WalkerNav()
	] );
}

?>
<button class="navigation-btn">
	<span class="navigation-btn__box">
		<span class="navigation-btn__inner"></span>
	</span>
</button>
