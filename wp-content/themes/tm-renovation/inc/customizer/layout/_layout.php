<?php

$panel    = 'layout';
$priority = 1;

// Add sections for panel
Kirki::add_section( 'layout_mode', array(
	'title'    => esc_html__( 'Layout Mode', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'background_image', array(
	'title'    => esc_html__( 'Background Options', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

// Include setup
require_once get_template_directory() . '/inc/customizer/layout/layout_mode.php';
require_once get_template_directory() . '/inc/customizer/layout/layout_bg.php';