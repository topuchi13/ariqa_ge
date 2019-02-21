<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Renovation
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}


$sidebar_class = '';
$page_layout   = 'content-sidebar';

if ( is_post_type_archive( 'product' ) ) {
	$page_layout = Kirki::get_option( 'infinity', 'woo_layout_category' );
}

if ( is_singular( 'product' ) ) {
	$page_layout = Kirki::get_option( 'infinity', 'woo_layout_single_product' );
}


if ( 'sidebar-content' == $page_layout ) {
	$sidebar_class = 'first-md';
}

if ( 'full-width' == $page_layout ) {
	return;
}

?>
<div class="col-sm-4 col-md-3<?php echo ' ' . esc_attr( $sidebar_class ); ?>">
	<aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</aside>
</div>
