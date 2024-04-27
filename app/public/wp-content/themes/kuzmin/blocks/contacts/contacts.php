<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$title = get_field('title');
$addr = get_field('addr');
$working = get_field('working');
$form = get_field('form');
?>

<section class="contacts">
	<div class="container">
		<h2 class="mwf-title--line contacts__title"><?php echo $title; ?></h2>
		<div class="contacts__inner">
			<div class="contacts__left">
				<h3 class="contacts__info-title">
					<?php echo $addr['title']; ?>
				</h3>
				<ul class="contacts__list">
					<li class="contacts__item">
						<?php mwf_icon('marker'); ?>
						<span><?php echo $addr['addr']; ?></span>
					</li>
					<li class="contacts__item">
						<?php mwf_icon('mail'); ?>
						<a href="mailto:<?php echo $addr['e-mail']; ?>"><?php echo $addr['e-mail'] ?></a>
					</li>
					<li class="contacts__item">
						<?php mwf_icon('phone'); ?>
						<a href="tel:<?php echo mwf_phone($addr['phone']); ?>"><?php echo $addr['phone'] ?></a>
					</li>
				</ul>
				<h3 class="contacts__info-title">
					<?php echo $working['title']; ?>
				</h3>
				<ul class="contacts__list">
					<li class="contacts__item">
						<?php mwf_icon('calendar-2'); ?>
						<span><?php echo $working['time']; ?></span>
					</li>
					<li class="contacts__item">
						<?php mwf_icon('calendar-3'); ?>
						<span><?php echo $working['weekend'] ?></span>
					</li>
				</ul>
			</div>
			<div class="contacts__right">
				<h3 class="contacts__form-title">
					<?php echo $form['title']; ?>
				</h3>
				<div class="contacts__form-descr">
					<?php echo $form['descr']; ?>
				</div>
				<div class="contacts__form">
					<?php echo do_shortcode($form['code']); ?>
				</div>
			</div>
		</div>
	</div>
</section>
