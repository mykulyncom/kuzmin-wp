<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$logo = get_field('logo');
$logo_webp = mwf_webp($logo);
$logo_alt = mwf_get_image_alt($logo);
$footer_bg  = get_field('footer_bg');
$bg_webp = mwf_webp($footer_bg);
$bg_alt = mwf_get_image_alt($footer_bg);

$fb_link = get_field('fb_link', 'option');

?>

<footer class="footer">
	<div class="container footer__inner">
		<a href="<?php echo site_url(); ?>" class="footer__logo">
			<img
				src="<?php echo $logo_webp; ?>"
				alt="<?php echo $logo_alt; ?>"
				loading="lazy"
				width="292"
				height="81"
			>
		</a>
		<div class="footer__center">
			<?php if (is_page( get_the_ID() === 2 )) { ?>
			<a href="#privacyua" class="footer__privacy open-popup">
				<?php echo __('Політика конфіденційності', 'mwf'); ?>
			</a>
			<?php } else { ?>
			<a href="#privacyru" class="footer__privacy open-popup">
				<?php echo __('Политика конфиденциальности', 'mwf'); ?>
			</a>
			<?php } ?>
			<div class="copyright">
				&copy; <?php echo date( 'Y' ); ?> | <?php echo __('All rights reserved', 'mwf'); ?>
			</div>
		</div>
		<div class="footer__social">
			<a href="<?php echo $fb_link; ?>" class="fb fb_link" target="_blank">
				<svg width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m512 256c0-141.4-114.6-256-256-256s-256 114.6-256 256 114.6 256 256 256c1.5 0 3 0 4.5-.1v-199.2h-55v-64.1h55v-47.2c0-54.7 33.4-84.5 82.2-84.5 23.4 0 43.5 1.7 49.3 2.5v57.2h-33.6c-26.5 0-31.7 12.6-31.7 31.1v40.8h63.5l-8.3 64.1h-55.2v189.5c107-30.7 185.3-129.2 185.3-246.1z" fill="#ffffff" data-original="#000000" style=""></path></g></svg>
			</a>
		</div>
	</div>
	<div class="footer__bg mwf-bg">
		<img src="<?php echo $bg_webp; ?>" alt="<?php echo $bg_alt; ?>" loading="lazy">
	</div>
</footer>