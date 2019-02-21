<?php

$panel    = 'site';
$priority = 1;

// Add sections for site panel
Kirki::add_section( 'site_preset', array(
	'title'    => esc_html__( 'Site Preset', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'site_front', array(
	'title'    => esc_html__( 'Static Front Page', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'site_features', array(
	'title'    => esc_html__( 'Theme Features', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/site/site_preset.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/site/site_features.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/site/site_front.php';