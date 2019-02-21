<?php

$panel    = 'top';
$priority = 1;

// Add sections for top area panel
Kirki::add_section( 'top_visibility', array(
	'title'    => esc_html__( 'Visibility', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'top_style', array(
	'title'    => esc_html__( 'Layout & Design', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'top_spacing', array(
	'title'    => esc_html__( 'Spacing', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'top_border', array(
	'title'    => esc_html__( 'Border', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/top/top_visibility.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/top/top_style.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/top/top_spacing.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/top/top_border.php';