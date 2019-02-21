<?php

$panel    = 'woo';
$priority = 1;

// Add sections for woo panel
Kirki::add_section( 'woo_layout', array(
	'title'       => esc_html__( 'Layout', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++
) );

Kirki::add_section( 'woo_color', array(
	'title'       => esc_html__( 'Color', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++
) );

require_once get_template_directory() . '/inc/customizer/woo/woo_layout.php';
require_once get_template_directory() . '/inc/customizer/woo/woo_color.php';