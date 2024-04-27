<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo( 'title' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="description" content="<?php bloginfo( 'description' ) ?>"/>
	<meta name="author" content="Serhii Mykulyn">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php
		$header_code = get_field('head_code', 'option');
		$favicon_dark = get_field('favicon-dark', 'option');
	?>
	<?php if ( $favicon_dark ) { ?>
		<link rel="icon" type="image/png" href="<?php echo $favicon_dark; ?>">
	<?php } else { ?>
		<link rel="icon" type="image/png" href="<?php echo MWF_URI . '/assets/images/mwf-favicon.png' ?>">
	<?php } ?>


	<?php echo $header_code; ?>
	<?php wp_head(); ?>

	<meta name="theme-color" content="#333a4d">
</head>
<body <?php body_class(); ?>>
