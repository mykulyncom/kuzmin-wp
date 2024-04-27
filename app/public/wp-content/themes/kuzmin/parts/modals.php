<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$fb_link = get_field( 'fb_link', 'option' );
$yt_link = get_field( 'yt_link', 'option' );
?>


<?php if ( is_page( get_the_ID() === 2 ) ) { ?>
	<div id="formua" class="mfp-hide white-popup mwf-popup">
		<h2 class="mwf-title mwf-popup__title">
			<?php echo __( 'Заповніть форму і я з вами зв\'яжуся.', 'mwf' ); ?>
		</h2>
		<div class="mwf-popup__descr">
			<?php echo __( 'Я гарантую повну конфіденційність в роботі, ваші дані не будуть передані третім особам', 'mwf' ); ?>
		</div>
		<div class="mwf-popup__form">
			<?php echo do_shortcode( '[contact-form-7 id="95026db" title="Консультация-UA"]' ); ?>
		</div>
		<div class="mwf-popup__after">
			<?php echo __( 'Поки ви очікуєте дзвінок, познайомтеся зі мною в Фейсбук і подивіться відгуки клієнтів', 'mwf' ); ?>
		</div>
		<div class="mwf-popup__socials">
			<a href="<?php echo $fb_link; ?>" target="_blank" class="mwf-popup__social">FACEBOOK</a>
			<a href="<?php echo $yt_link; ?>" target="_blank" class="mwf-popup__social">YOUTUBE</a>
		</div>
	</div>
	<div id="privacyua" class="mfp-hide white-popup popup_privacy">
		<?php $args = [
			'page_id'     => '249',
		];
		$the_query  = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :
			$the_query->the_post(); ?>
			<h3 class="mwf-title popup_privacy__title"><?php the_title(); ?></h3>
			<div class="popup_privacy__content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php } else { ?>
	<div id="formru" class="mfp-hide white-popup mwf-popup">
		<h2 class="mwf-title mwf-popup__title">
			<?php echo __( 'Заполните форму и я с вами свяжусь.', 'mwf' ); ?>
		</h2>
		<div class="mwf-popup__descr">
			<?php echo __( 'Я гарантирую полную конфиденциальность в работе, ваши данные не будут переданы третьим лицам', 'mwf' ); ?>
		</div>
		<div class="mwf-popup__form">
			<?php echo do_shortcode( '[contact-form-7 id="c98fa6a" title="Консультация-RU"]' ); ?>
		</div>
		<div class="mwf-popup__after">
			<?php echo __( 'Пока вы ожидаете звонок, познакомьтесь со мной в Фейсбук и посмотрите отзывы клиентов', 'mwf' ); ?>
		</div>
		<div class="mwf-popup__socials">
			<a href="<?php echo $fb_link; ?>" target="_blank" class="mwf-popup__social">FACEBOOK</a>
			<a href="<?php echo $yt_link; ?>" target="_blank" class="mwf-popup__social">YOUTUBE</a>
		</div>
	</div>
	<div id="privacyru" class="mfp-hide white-popup popup_privacy">
		<?php $args = [
			'page_id'     => '247',
		];
		$the_query  = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :
			$the_query->the_post(); ?>
			<h3 class="mwf-title popup_privacy__title"><?php the_title(); ?></h3>
			<div class="popup_privacy__content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php } ?>