<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$tblock_text = get_field('tblock_text');
?>
<section class="tblock">
	<div class="container">
		<p class="tblock__text">
			<?php echo $tblock_text; ?>
		</p>
	</div>
</section>