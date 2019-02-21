<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Renovation
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="shortcut icon" href="<?php echo Kirki::get_option( 'infinity', 'site_favicon' ); ?>">
		<link rel="apple-touch-icon" href="<?php echo Kirki::get_option( 'infinity', 'site_apple_touch_icon' ); ?>"/>
	<?php } ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php echo TM_Renovation_Templates::mobile_menu(); ?>

<div id="page" class="hfeed site">
	<?php
	$header_type = Kirki::get_option( 'infinity', 'header_type' );
	require_once get_template_directory() . '/template-parts/' . $header_type . '.php';
	?>

	<div id="content" class="site-content">
