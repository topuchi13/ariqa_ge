<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Renovation
 *
 * @since   3.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$sidebar_class = '';
$page_layout   = get_post_meta( get_the_ID(), 'infinity_page_layout_private', true );

if ( 'default' == $page_layout ) {
	$page_layout = Kirki::get_option( 'infinity', 'page_layout' );
}

if ( is_archive() || is_author() || is_category() || is_home() ) {
	$page_layout = Kirki::get_option( 'infinity', 'archive_layout' );
}

if ( is_search() ) {
	$page_layout = Kirki::get_option( 'infinity', 'search_layout' );
}

if ( is_singular( 'post' ) ) {
	$page_layout = Kirki::get_option( 'infinity', 'post_layout' );
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
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
</div>
