<?php
/*
Plugin Name: ThemeMove Core
Description: Core functions for ThemeMove theme
Author: ThemeMove
Version: 1.3.8.2
Author URI: http://thememove.com
*/

/**
 * Current ThemeMove Core version
 */
if ( ! defined( 'TM_CORE_VERSION' ) ) {
	define( 'TM_CORE_VERSION', '1.3.8.2' );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

$theme = wp_get_theme();
if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}
define( 'TM_THEME_NAME', $theme['Name'] );
define( 'TM_THEME_SLUG', $theme['Template'] );
define( 'TM_THEME_VERSION', $theme['Version'] );
define( 'SITE_URI', site_url() );
define( 'API_SERVER', 'thememove.com' );

include_once( dirname( __FILE__ ) . '/compatibility.php' );
include_once( dirname( __FILE__ ) . '/tf.php' );

//include component
include_once( dirname( __FILE__ ) . '/mobile-detect.php' );
include_once( dirname( __FILE__ ) . '/mobble.php' );
include_once( dirname( __FILE__ ) . '/cmb2/init.php' );
include_once( dirname( __FILE__ ) . '/customizer/io.php' );
include_once( dirname( __FILE__ ) . '/shortcodes/init.php' );

// Mega Menu
include_once( dirname( __FILE__ ) . '/mega-menu/mega-menu.php' );
include_once( dirname( __FILE__ ) . '/popup/popup.php' );

// Customizer Import/Export
include_once( dirname( __FILE__ ) . '/customizer/import/import.php' );
include_once( dirname( __FILE__ ) . '/customizer/export/export.php' );

// One-click
include_once( dirname( __FILE__ ) . '/export/export.php' );
include_once( dirname( __FILE__ ) . '/import/import.php' );

// Others
include_once( dirname( __FILE__ ) . '/notices.php' );
include_once( dirname( __FILE__ ) . '/breadcrumb.php' );
include_once( dirname( __FILE__ ) . '/better-menu-widget.php' );

register_activation_hook( __FILE__, 'thememove_core_install' );
function thememove_core_install() {
	thememove_mega_menu_support_visual_composer();
	thememove_popup_support_visual_composer();
}

function thememove_mega_menu_support_visual_composer() {
	$pt_array = ( $pt_array = get_option( 'wpb_js_content_types' ) ) ? ( $pt_array ) : array( 'page' );

	if ( ! in_array( 'tm_mega_menu', $pt_array ) ) {
		$pt_array[] = 'tm_mega_menu';

		update_option( 'wpb_js_content_types', $pt_array );
	}
}

function thememove_popup_support_visual_composer() {
	$pt_array = ( $pt_array = get_option( 'wpb_js_content_types' ) ) ? ( $pt_array ) : array( 'page' );

	if ( ! in_array( 'tm_popup', $pt_array ) ) {
		$pt_array[] = 'tm_popup';

		update_option( 'wpb_js_content_types', $pt_array );
	}
}

/**
 * Remove Rev Slider Metabox
 */
if ( is_admin() ) {

	function thememove_remove_revolution_slider_meta_boxes() {
		remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'tm_popup', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'tm_mega_menu', 'normal' );
	}

	add_action( 'do_meta_boxes', 'thememove_remove_revolution_slider_meta_boxes' );

}