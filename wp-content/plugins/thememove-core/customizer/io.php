<?php
require_once( trailingslashit( dirname( __FILE__ ) ) . 'io-control.php' );
/**
 * ============================================================================
 * Register the control with the customizer
 * ============================================================================
 */
function thememove_register_io( $wp_customize ) {

	// Add the export/import section.
	$wp_customize->add_section( 'io_section', array(
		'title'       => __( 'Import / Export', 'tm-core' ),
		'priority'    => 15000
	) );

	// Add the export/import setting.
	$wp_customize->add_setting( 'io_setting', array(
		'default' => '',
		'type'    => 'none'
	) );

	// Add the export/import control.
	$wp_customize->add_control( new ThemeMove_IO_Control( $wp_customize,
		'io_setting',
		array(
			'section'  => 'io_section',
			'priority' => 1
		)
	) );
}

add_action( 'customize_register', 'thememove_register_io' );