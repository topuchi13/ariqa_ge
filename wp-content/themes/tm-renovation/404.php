<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Renovation
 */

get_header(); ?>

<div class="not-found">
	<div class="container">
		<div class="row center middle">
			<div class="col-xs-12">
				<h2>404</h2>
				<h3><?php esc_html_e('Page not found', 'tm-renovation'); ?></h3>
				<p><?php esc_html_e('Whoops, sorry, this page does not exist.', 'tm-renovation'); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" rel="home"><?php esc_attr_e('Go back home', 'tm-renovation'); ?></a>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>