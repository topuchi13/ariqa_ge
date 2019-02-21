<?php
/* Loads renovation Icon font. */

// Enqueue CSS
wp_enqueue_style( 'thememove-font-renovation-icon', TM_RENOVATION_URI . '/css/renovation.css');

add_filter( 'vc_iconpicker-type-renovation', 'vc_iconpicker_type_renovation' );

/**
 * renovation icons from thememove.com/
 *
 * @param $icons - taken from filter - vc_map param field settings['source'] provided icons (default empty array).
 * If array categorized it will auto-enable category dropdown
 *
 * @since 4.4
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
function vc_iconpicker_type_renovation( $icons ) {
	$renovation_icons = array(
		array( "rn-door"        => esc_html__( "door", 'tm-renovation' ) ),
		array( "rn-electrical"  => esc_html__( "electrical", 'tm-renovation' ) ),
		array( "rn-home"        => esc_html__( "home", 'tm-renovation' ) ),
		array( "rn-painting"    => esc_html__( "painting", 'tm-renovation' ) ),
		array( "rn-plumbing"    => esc_html__( "plumbing", 'tm-renovation' ) ),
		array( "rn-tools"       => esc_html__( "tools", 'tm-renovation' ) ),
		array( "rn-heating"     => esc_html__( "heating", 'tm-renovation' ) ),
		array( "rn-renovation"  => esc_html__( "renovation", 'tm-renovation' ) ),
		array( "rn-drywall"     => esc_html__( "drywall", 'tm-renovation' ) ),
		array( "rn-drill"       => esc_html__( "drill", 'tm-renovation' ) ),
		array( "rn-gear"        => esc_html__( "gear", 'tm-renovation' ) ),
		array( "rn-wall"        => esc_html__( "wall", 'tm-renovation' ) ),
		array( "rn-windows"     => esc_html__( "windows", 'tm-renovation' ) ),
	);

	return array_merge( $icons, $renovation_icons );
}