<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$title = get_field('title');
$photo_url = get_field('photo');
$photo_alt = mwf_get_image_alt( $photo_url );
$webp = mwf_webp( $photo_url );
$process = get_field('process');
?>

<section class="process" id="process">
	<div class="container process__inner">
		<div class="process__left">
			<h2 class="mwf-title--line process__title">
				<?php echo $title; ?>
			</h2>
			<ul class="process__list">
				<?php foreach ($process as $item): ?>
					<li class="process__item"><?php echo $item['string']; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="process__right">
			<img
				src="<?php echo $webp; ?>"
				alt="<?php echo $photo_alt; ?>"
				loading="lazy"
				width="624"
				height="600"
			>
		</div>
	</div>
</section>
