<?php

$panel    = 'page';
$priority = 1;

// Add sections for page panel
Kirki::add_section( 'page_layout', array(
	'title'    => esc_html__( 'Layout', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'page_title', array(
	'title'    => esc_html__( 'Page Title', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'page_border', array(
	'title'       => esc_html__( 'Border', 'tm-renovation' ),
	'description' => esc_html__( 'In this section you can control all border settings of pages', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/page/page_layout.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/page/page_title.php';