<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$title = get_field('title');
$list = get_field('list');
$button = get_field('button');
?>

<section class="blist" id="services">
	<div class="container">
		<h2 class="mwf-title mwf-title--line blist__title">
			<?php echo $title; ?>
		</h2>
		<ul class="blist__list">
			<?php foreach ($list as $item): ?>
				<li class="blist__item"><?php echo $item['list-item']; ?></li>
			<?php endforeach; ?>
		</ul>
		<div class="blist__btn">
			<a href="<?php echo $button['button-link']; ?>" class="mwf-button open-popup mwf-button--scale">
				<?php echo $button['button-text']; ?>
			</a>
		</div>
	</div>
</section>
