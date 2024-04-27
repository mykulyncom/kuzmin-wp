<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$bg = get_field('bg');

$img_id = attachment_url_to_postid($bg);
$bg_mobile = wp_get_attachment_image_url($img_id, 'mwf_size_speed');
$bg_desktop = wp_get_attachment_image_url($img_id, 'mwf_size_tablet');
$bg_mobile_webp = mwf_webp($bg_mobile);
$bg_webp = mwf_webp($bg_desktop);

$bg_alt = mwf_get_image_alt( $bg );
$title = get_field('title');
$title_or = get_field('title_orange');
$list_title = get_field('title_list');

$list = get_field('list');

$badges = get_field('short_info');

$button1 = get_field('button_1');
$button2 = get_field('button_2');
$button3 = get_field('button_3');
?>

<section class="hero data-image">
	<div class="container">
		<div class="badge">
			<?php foreach ($badges as $item) : ?>
				<?php
					$icon = $item['icon'];
					$line_1 = $item['line-1'];
					$line_2 = $item['line-2'];
				?>
				<div class="badge__item">
					<?php mwf_icon($icon); ?>
					<span class="badge__item-text">
						<?php echo $line_1; ?>
						<span><?php echo $line_2; ?></span>
					</span>
				</div>
			<?php endforeach; ?>
		</div>
		<h1 class="hero__title">
			<?php echo $title; ?>
			<span><?php echo $title_or; ?></span>
		</h1>
		<h4 class="hero__list-title"><?php echo $list_title; ?> </h4>
		<ul class="hero__list">
			<?php foreach ($list as $item) : ?>
				<li class="hero__list-item"><?php echo $item['item']; ?></li>
			<?php endforeach; ?>
		</ul>

		<div class="hero__btns">
			<a href="<?php echo $button1['link']; ?>" class="mwf-button open-popup mwf-button--regular hero__consult mwf-popup">
				<?php echo $button1['text']; ?>
			</a>
			<a href="<?php echo $button2['link']; ?>" class="mwf-button open-popup mwf-button--outline hero__price mwf-popup">
				<?php echo $button2['text']; ?>
			</a>
			<a href="tel:<?php echo $button3['link']; ?>" class="mwf-button mwf-button--outline hero__call">
				<?php echo $button3['text']; ?>
			</a>
		</div>
	</div>
	<div class="hero__bg mwf-bg">
		<picture>
			<source media="(max-width: 400px)" srcset="<?php echo $bg_mobile_webp; ?>" type="image/webp">
			<source media="(min-width: 401px)" srcset="<?php echo $bg_webp; ?>" type="image/webp">
			<img
					src="<?php echo $bg_webp; ?>"
					alt="<?php echo $bg_alt; ?>"
					loading="lazy"
					type="image/webp"
			>
		</picture>
	</div>
</section>
