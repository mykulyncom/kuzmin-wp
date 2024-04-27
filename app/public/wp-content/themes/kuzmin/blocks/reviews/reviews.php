<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$title     = get_field( 'title' );
$bg_url    = get_field( 'bg' );
$bg_alt    = mwf_get_image_alt( $bg_url );
$bg_webp   = mwf_webp( $bg_url );
$button    = get_field( 'button' );
$args      = [
	'post_type'     => 'reviews',
	'post_per_page' => - 1,
];
$the_query = new WP_Query( $args );
?>

<section class="reviews" id="reviews">
	<div class="container">
		<h2 class="mwf-title--line reviews__title">
			<?php echo $title; ?>
		</h2>
		<div class="swiper reviews__slider">
			<div class="swiper-wrapper">
				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :
					$the_query->the_post(); ?>
					<?php
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					$img_alt        = mwf_get_image_alt( $featured_image[0] );
					$img_webp       = mwf_webp( $featured_image[0] );
					$link = get_field( 'review-link', get_the_ID() );
					?>
					<a href="<?php echo esc_url($link); ?>" class="swiper-slide popup-youtube">
						<img
								src="<?php echo $img_webp; ?>"
								alt="<?php echo $img_alt; ?>"
								loading="lazy"
								width="430"
								height="200"
						>
					</a>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="swiper-button-prev">
				<?php mwf_icon('arrow'); ?>
			</div>
			<div class="swiper-button-next">
				<?php mwf_icon('arrow'); ?>
			</div>
		</div>
		<div class="swiper-pagination"></div>
		<div class="reviews__btn">
			<a
					href="<?php echo esc_url($button['button-link']); ?>"
					class="mwf-button mwf-button--scale"
					target="_blank"
			>
				<?php echo esc_html($button['button-text']); ?>
			</a>
		</div>
	</div>
	<div class="mwf-bg reviews__bg">
		<img src="<?php echo $bg_webp; ?>" alt="<?php echo $bg_alt; ?>" loading="lazy">
	</div>
</section>
