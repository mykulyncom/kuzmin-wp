<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$title       = get_field( 'title' );
$info        = get_field( 'info' );
$advant      = get_field( 'advant' );
$photo_url   = get_field( 'photo' );
$photo_alt   = mwf_get_image_alt( $photo_url );
$webp        = mwf_webp( $photo_url );
$photo_descr = get_field( 'photo_descr' );
$title_video = get_field( 'title_video' );
$video       = get_field( 'video' );
?>
<section class="about" id="about">
	<div class="container about__inner">
		<div class="about__left">
			<h2 class="mwf-title about__title">
				<?php echo $title; ?>
			</h2>
			<div class="about__info">
				<?php echo $info; ?>
			</div>
			<ul class="advantages">
				<?php foreach ( $advant as $advant_item ): ?>
					<li class="advantages__item">
						<span><?php echo $advant_item['number']; ?></span>
						<?php echo $advant_item['descr']; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="about__right">
			<figure class="about__photo">
				<picture>
					<img
							src="<?php echo $webp; ?>"
							alt="<?php echo $photo_alt; ?>"
							loading="lazy"
							width="617"
							height="617"
					>
				</picture>
				<figcaption class="about__photo-descr">
					<?php echo $photo_descr; ?>
				</figcaption>
			</figure>
		</div>
	</div>
	<div class="container video__wrap">
		<h3 class="about__video-title">
			<?php echo $title_video; ?>
		</h3>
		<ul class="about__videos">
			<?php foreach ( $video as $video_item ): ?>
				<li class="about__video">
					<?php
					$link    = $video_item['video_link'];
					$img_url = $video_item['preview'];
					$img_alt = mwf_get_image_alt( $img_url );
					$preview = mwf_webp( $img_url );
					?>
					<a href="<?php echo $link; ?>" class="about__video-link">
						<img
								src="<?php echo $preview; ?>"
								alt="<?php echo $img_alt; ?>"
								loading="lazy"
								width="407"
								height="253"
						>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
