<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

get_header(); ?>
<main class="page">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		the_content();
	endwhile;
	endif;
	?>
</main>
<?php get_footer(); ?>
