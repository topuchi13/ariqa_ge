<?php

$panel    = 'copyright';
$priority = 1;

// Add sections for copyright panel
Kirki::add_section( 'copyright_visibility', array(
	'title'    => esc_html__( 'Visibility', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'copyright_layout', array(
	'title'       => esc_html__( 'Layout', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++
) );

Kirki::add_section( 'copyright_color', array(
	'title'       => esc_html__( 'Color', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/copyright/copyright_visibility.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/copyright/copyright_layout.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/copyright/copyright_color.php';