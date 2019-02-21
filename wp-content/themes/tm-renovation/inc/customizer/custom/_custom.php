<?php

$panel    = 'custom';
$priority = 1;

// Add sections for custom code panel
Kirki::add_section( 'custom_css', array(
	'title'    => esc_html__( 'Custom CSS', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'custom_js', array(
	'title'    => esc_html__( 'Custom JS', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once get_template_directory() . '/inc/customizer/custom/custom_css.php';
require_once get_template_directory() . '/inc/customizer/custom/custom_js.php';