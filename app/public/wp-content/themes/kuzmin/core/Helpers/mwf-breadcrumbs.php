<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
function mwf_breadcrumbs(): void {

	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = '&raquo;'; // delimiter between crumbs
	$home = 'Головна сторінка'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	global $post;
	$homeLink = get_bloginfo('url');

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

	} else {

		echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

		} elseif ( is_search() ) {
			echo $before . 'Search results for "' . get_search_query() . '"' . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif (is_singular( 'post' )) {
			echo '<a href="' . site_url() . '/about">' . __('Про нас', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/about/blog">' . __( 'Наш блог', 'mwf' ) .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		} elseif (is_singular( 'clinics' ) && get_the_ID() === 480 || is_singular( 'clinics' ) && get_the_ID() === 224 ) {
			echo '<a href="' . site_url() . '/medical-spa">' . __('Medical Spa', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		}  elseif (is_singular( 'offers' )) {
			$tax = get_the_terms(get_the_ID(), 'offers_type');
			echo '<a href="' . site_url() . '/offers">' . __('Пропозиції', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/offers/action">' . $tax[0]->name .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		} elseif (is_singular( 'services' )) {
			$tax = get_the_terms(get_the_ID(), 'services_cat');
			echo '<a href="' . site_url() . '/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/services/' . $tax[0]->slug . '">' . $tax[0]->name .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		} elseif (is_post_type_archive( 'services' ) ) {
			echo $before;
			echo  __('Послуги', 'mwf');
			echo $after;
		}
		// Східниця
		elseif (is_post_type_archive('shidnycia')) {
			echo '<a href="' . site_url() . '/medical-spa">' . __('Medical Spa', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia">' . __('Східниця', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before;
			echo  __('Послуги', 'mwf');
			echo $after;
		} elseif ( is_tax('sh_kat') ) {
			echo '<a href="' . site_url() . '/medical-spa">' . __('Medical Spa', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia">' . __('Східниця', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_archive_title() . $after;
		} elseif (is_singular( 'shidnycia' )) {
			$tax = get_the_terms(get_the_ID(), 'sh_kat');
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia">' . __('Східниця', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/skhidnytsia/services/' . $tax[0]->slug . '">' . $tax[0]->name .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		}
		// Косино
		elseif (is_post_type_archive('kosyno')) {
			echo '<a href="' . site_url() . '/medical-spa">' . __('Medical Spa', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/kosyno">' . __('Косино', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before;
			echo  __('Послуги', 'mwf');
			echo $after;
		} elseif ( is_tax('kos_kat') ) {
			echo '<a href="' . site_url() . '/medical-spa">' . __('Medical Spa', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/kosyno">' . __('Косино', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/kosyno/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_archive_title() . $after;
		} elseif (is_singular( 'kosyno' )) {
			$tax = get_the_terms(get_the_ID(), 'kos_kat');
			echo '<a href="' . site_url() . '/medical-spa/kosyno">' . __('Косино', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/kosyno/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo '<a href="' . site_url() . '/medical-spa/kosyno/services/' . $tax[0]->slug . '">' . $tax[0]->name .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_title() . $after;

		}

		elseif ( is_single() && !is_attachment() ) {
			$tax = get_the_terms(get_the_ID(), 'clinic_type');
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a>';
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( is_tax() ) {
			$tax = get_taxonomy(get_queried_object()->taxonomy);
			echo '<a href="' . site_url() . '/services">' . __('Послуги', 'mwf') .'</a> ';
			echo $delimiter . ' ';
			echo $before . the_archive_title() . $after;

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . 'Articles posted by ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			echo $before . 'Error 404' . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
//			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div>';

	}
}
