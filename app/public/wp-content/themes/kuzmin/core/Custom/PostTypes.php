<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\Custom;

class PostTypes {

	public function register(): void {
		add_filter('post_link', [ $this, 'mwf_post_type_permalink' ], 20, 3);
		add_filter('post_type_link', [ $this, 'mwf_post_type_permalink' ], 20, 3);
		add_filter('request', [ $this, 'mwf_post_type_request' ], 1, 1 );
		add_action('template_redirect', [ $this, 'mwf_post_type_redirect' ]);
	}

	function mwf_post_type_permalink( $permalink, $post_id, $leavename ) {

		$post_type_name = 'services'; // название типа записи, вы можете найти его в админке или в функции register_post_type()
		$post_type_slug = 'services'; // часть URL товаров, не всегда совпадает с названием типа записи!
		$tax_name = 'services_cat'; // ну это понятно, название таксономии - категории товаров

		$post = get_post( $post_id ); // получаем объект поста по его ID

		if ( strpos( $permalink, $post_type_slug ) === FALSE || $post->post_type != $post_type_name ) // не делаем никаких изменений, если тип записи не соответствует или если URL не содержит ярлык tovar
			return $permalink;

		$termini = wp_get_object_terms( $post->ID, $tax_name ); // получаем все категории, к которым принадлежит данный товар


		if ( !is_wp_error( $termini ) && !empty( $termini ) && is_object( $termini[0] ) ) // и делаем перезапись ссылки, только, если товар находится хотя бы в одной категории, иначе возвращаем ссылку по умолчанию
			$permalink = str_replace( $post_type_slug, $termini[0]->slug, $permalink );

		return $permalink;
	}

	function mwf_post_type_request( $query ){
		global $wpdb; // нам немного придётся поработать с БД

		$post_type_name = 'services'; // указываем тут название типа записей товара
		$tax_name = 'services_cat'; // а также название таксономии - категории товаров

		$yarlik = $query['attachment']; // после того, как мы изменили ссылки товаров в предыдущей функции, WordPress начал принимать их за страницы вложений

		// а теперь давайте получим ID товара, ярлык которого соответствует запросу на странице
		$post_id = $wpdb->get_var(
			"
		SELECT ID
		FROM $wpdb->posts
		WHERE post_name = '$yarlik'
		AND post_type = '$post_type_name'
		"
		);

		$termini = wp_get_object_terms( $post_id, $tax_name ); // товар должен находиться в категории (одной или нескольких)


		if( isset( $yarlik ) && $post_id && !is_wp_error( $termini ) && !empty( $termini ) ) : // изменяем запрос, если всё ок

			unset( $query['attachment'] );
			$query[$post_type_name] = $yarlik;
			$query['post_type'] = $post_type_name;
			$query['name'] = $yarlik;

		endif;

		return $query; // возвращаем результат
	}

	function mwf_post_type_redirect() {

		$post_type_name = 'tovar'; // как и в первом шаге, указываем тут название типа записи
		$post_type_slug = 'tovar'; // тут ярлык, то есть то, что в URL
		$tax_name = 'tovar_kat'; // и название таксономии

		if( strpos( $_SERVER['REQUEST_URI'], $post_type_slug ) === FALSE) // выходим из функции ничего не делая, если URL не содержит ярлыка типа записи "tovar"
			return;

		if( is_singular( $post_type_name ) ) : // функцию выполняем только на страницах записей данного типа
			global $post, $wp_rewrite;

			$termini = wp_get_object_terms( $post->ID, $tax_name ); // опять проверяем товар на наличие категорий

			if ( !is_wp_error( $termini ) && !empty( $termini ) && is_object( $termini[0] ) ) :

				wp_redirect( site_url() . '/' . $wp_rewrite->front . '/' . $termini[0]->slug . '/' . $post->post_name, 301 );
				// wp_redirect( get_permalink( $post->ID ), 301 ); // можно использовать эту строчку, но строго обязательно должен быть установлен первый хук из этой статьи

				exit();
			endif;
		endif;

	}
}
