<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

get_header();
$description = get_field('description', 'option');
$bg = get_field('image', 'option');
$bg_alt = mwf_get_image_alt( $bg );
?>

<section class="not_found">
	<div class="container not_found__inner">
		<div class="not_found__title"></div>
		<div class="not_found__descr"><?php echo $description; ?></div>
		<a href="<?php echo home_url(); ?>" class="button button--neon"><?php echo __( 'На головну сторінку', 'mwf' ); ?></a>
	</div>
	<div class="not_found__bg">
		<img src="<?php echo mwf_webp( $bg ); ?>" alt="<?php echo $bg_alt; ?>">
	</div>
</section>

<?php get_footer(); ?>
