<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
$footer_code = get_field('footer_code', 'option');
?>



<?php get_template_part('./parts/modals'); ?>
<?php echo $footer_code; ?>
<?php wp_footer(); ?>
</body>
</html>
