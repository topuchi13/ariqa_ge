<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions that act independently of the theme templates
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Extras' ) ) {

	class TM_Renovation_Extras {

		function __construct() {

			add_filter( 'body_class', array( $this, 'body_classes' ) );

			add_action( 'wp_head', array( $this, 'extra_info' ), 9999 );

		}

		/**
		 * Adds custom classes to the array of body classes.
		 * ================================================
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		function body_classes( $classes ) {

			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			global $infinity_custom_class;
			if ( $infinity_custom_class ) {
				$classes[] = $infinity_custom_class;
			}

			if ( Kirki::get_option( 'infinity', 'site_general_boxed' ) == 1 ) {
				$classes[] = 'boxed';
			}

			$classes[] = Kirki::get_option( 'infinity', 'header_type' );

			global $infinity_page_layout_private;
			if ( $infinity_page_layout_private != 'default' && class_exists( 'cmb2_bootstrap_205' ) ) {
				$layout = get_post_meta( get_the_ID(), "infinity_page_layout_private", true );
			} else {
				$layout = Kirki::get_option( 'infinity', 'page_layout' );
			}

			$classes[] = $layout;

			global $infinity_sticky_menu;
			if ( $infinity_sticky_menu == 'default' ) {
				$infinity_sticky_menu = Kirki::get_option( 'infinity', 'nav_sticky_enable' );
			}

			if ( ( $infinity_sticky_menu == 1 || $infinity_sticky_menu == 'enable' ) ) {
				$classes[] = 'sticky-menu';
			}

			if ( defined( 'TM_CORE_VERSION' ) ) {
				$classes[] = 'core_' . str_replace( ".", "", TM_CORE_VERSION );
			}

			return $classes;
		}

		/**
		 * Extra Info
		 * =============
		 */
		function extra_info() {
			global $wp_version, $woocommerce;
			$parent_theme       = wp_get_theme( TM_RENOVATION_THEME_SLUG );
			$child_theme        = wp_get_theme();
			$child_theme_in_use = false;
			if ( $parent_theme->name != $child_theme->name ) {
				$child_theme_in_use = true;
			}
			$vc_version = "Not activated";
			if ( defined( 'WPB_VC_VERSION' ) ) {
				$vc_version = "v" . WPB_VC_VERSION;
			}
			$tm_core_version = "Not activated";
			if ( defined( 'TM_CORE_VERSION' ) ) {
				$tm_core_version = "v" . TM_CORE_VERSION;
			}
			?>
			<!--
    * WordPress: v<?php echo $wp_version . "\n"; ?>
    * ThemMove Core: <?php echo $tm_core_version; ?><?php echo "\n"; ?>
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>* WooCommerce: v<?php echo $woocommerce->version . "\n"; ?><?php else : ?>* WooCommerce: Not Installed <?php echo "\n"; ?><?php endif; ?>
    * Visual Composer: <?php echo $vc_version; ?><?php echo "\n"; ?>
    * Theme: <?php echo $parent_theme->name; ?> v<?php echo $parent_theme->version; ?> by <?php echo $parent_theme->get( 'Author' ) . "\n"; ?>
    * Child Theme: <?php if ( $child_theme_in_use == true ) { ?>Activated<?php } else { ?>Not activated<?php } ?><?php echo "\n"; ?>
    -->
		<?php }
	}

	new TM_Renovation_Extras();
}