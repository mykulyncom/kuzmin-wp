<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$title = get_field('title');
$text = get_field('text');
$button = get_field('button');
$bg_url = get_field('bg');
$bg_alt = mwf_get_image_alt( $bg_url );
$bg = mwf_webp( $bg_url );
?>

<div class="container">
	<section class="cta">
		<div class="cta__container">
			<div class="cta__content">
				<h2 class="cta__title"><?php echo $title; ?></h2>
				<p class="cta__text"><?php echo $text; ?></p>
			</div>
			<div class="cta__btn">
					<a href="<?php echo $button['button_link']; ?>" class="mwf-button open-popup mwf-button--regular">
						<?php echo $button['button_text']; ?>
					</a>
			</div>
		</div>
		<div class="cta__bg mwf-bg">
			<img src="<?php echo $bg; ?>" alt="<?php echo $bg_alt; ?>" loading="lazy">
		</div>
	</section>
</div>
