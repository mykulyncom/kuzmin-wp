<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$bg_url = get_field('danger_bg');
$bg_alt = mwf_get_image_alt($bg_url);
$bg = mwf_webp($bg_url);

$title = get_field('danger_title');
$first_p = get_field('danger_first_p');
$list_title = get_field('danger_list_title');
$list = get_field('danger_list');
//list_item
$two_p = get_field('danger_two_p');
?>

<section class="danger">
	<div class="container danger__inner">
		<div class="danger__left">
			<h2 class="mwf-title danger__title">
				<?php echo $title; ?>
			</h2>
		</div>
		<div class="danger__right">
			<div class="danger__first">
				<?php echo $first_p; ?>
			</div>
			<h3 class="danger__list-title"><?php echo $list_title; ?></h3>
			<ul class="danger__list">
				<?php foreach ($list as $item) : ?>
					<li class="danger__list-item"><?php echo $item['danger_list_item']; ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="danger__second">
				<?php echo $two_p; ?>
			</div>
		</div>
	</div>
	<div class="danger__bg mwf-bg">
		<img src="<?php echo $bg; ?>" alt="<?php echo $bg_alt; ?>" loading="lazy">
	</div>
</section>
