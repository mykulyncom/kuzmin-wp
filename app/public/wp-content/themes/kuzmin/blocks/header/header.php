<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

$logo = get_field('logo');
$logo_alt = mwf_get_image_alt($logo);
$logo_webp = mwf_webp($logo);

$phone = get_field('hd_phone', 'option');

$menu = get_field('menu');
// menu_link
// menu_title

?>

<header class="header">
	<div class="container header__inner">
		<a href="<?php echo site_url(); ?>" class="header__logo">
			<img
				src="<?php echo $logo_webp; ?>"
				alt="<?php echo $logo_alt; ?>"
				width="200"
				height="56"
			>
		</a>
		<nav class="menu">
			<ul class="menu__list" id="menu">
				<?php foreach ($menu as $item) : ?>
					<li class="menu__item">
						<a href="<?php echo $item['menu_link']; ?>" rel='m_PageScroll2id' class="menu__link">
							<?php echo $item['menu_title']; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<button class="header__burger"></button>

		<a href="<?php echo mwf_phone($phone); ?>" class="header__phone">
			<?php mwf_icon('phone'); ?>
			<span><?php echo $phone; ?></span>
		</a>

	</div>
</header>