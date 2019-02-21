<?php
/**
 * Template Name: Maintenance Page
 *
 * @package Renovation
 * @since  Renovation 1.1
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
<body class="site-maintenance">
<div class="container">
	<div class="row center middle">
		<div class="col-xs-12">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
</div>
</body>
<?php wp_footer(); ?>
