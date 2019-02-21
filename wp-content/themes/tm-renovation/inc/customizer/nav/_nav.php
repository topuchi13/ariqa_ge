<?php

$panel    = 'nav';
$priority = 1;

Kirki::add_section( 'nav_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'nav_desktop', array(
	'title'    => esc_html__( 'Desktop Menu', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/nav/nav_desktop.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/nav/nav_mobile.php';