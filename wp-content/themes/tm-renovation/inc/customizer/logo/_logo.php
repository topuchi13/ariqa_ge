<?php
$panel    = 'logo';
$priority = 1;

// Add sections for logo panel
Kirki::add_section( 'logo', array(
	'title'    => esc_html__( 'Logo', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'favicon', array(
	'title'    => esc_html__( 'Favicon', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

// Include setup
require_once get_template_directory() . '/inc/customizer/logo/logo_section.php';
require_once get_template_directory() . '/inc/customizer/logo/logo_favicon.php';
