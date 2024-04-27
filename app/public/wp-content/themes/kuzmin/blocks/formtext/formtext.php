<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$form = get_field('form');
$title = get_field('title');
$list = get_field('list');
?>

<section class="formtext">
	<div class="container formtext__inner">
		<div class="formtext__form">
			<h3 class="formtext__form-title"><?php echo $form['title']; ?></h3>
			<div class="formtext__form-descr"><?php echo $form['description']; ?></div>
			<div class="formtext__form-over"><?php echo $form['text-over-form']; ?></div>
			<div class="formtext__form-form">
				<?php echo do_shortcode($form['code']); ?>
			</div>
			<div class="formtext__form-under"><?php echo $form['text-under-form']; ?></div>
		</div>
		<div class="formtext__right">
			<h2 class="formtext__title"><?php echo $title; ?></h2>
			<ul class="formtext__list">
				<?php foreach ($list as $item) : ?>
					<li class="formtext__item">
						<?php echo $item['item']; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
