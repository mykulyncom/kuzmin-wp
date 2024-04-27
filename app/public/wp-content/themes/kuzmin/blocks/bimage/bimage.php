<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$title = get_field('title');
$img_url = get_field('image');
$img_alt = mwf_get_image_alt( $img_url );
$webp = mwf_webp( $img_url );

?>

<section class="bimage">
	<div class="container">
		<h2 class="mef-title bimage__title">
			<?php echo $title; ?>
		</h2>
		<div class="bimage__img">
			<img
					src="<?php echo $webp; ?>"
					alt="<?php echo $img_alt; ?>"
					loading="lazy"
					width="760"
					height="510"
			>
		</div>
	</div>
</section>
