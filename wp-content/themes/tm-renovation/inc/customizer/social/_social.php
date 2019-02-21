<?php

$panel    = 'social';
$priority = 1;

Kirki::add_section( 'social', array(
	'title'    => esc_html__( 'Social Links', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'social_footer', array(
	'title'    => esc_html__( 'Footer Social Links', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );


Kirki::add_section( 'social_mobile', array(
	'title'    => esc_html__( 'Mobile Social Links', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once get_template_directory() . '/inc/customizer/social/social.php';
require_once get_template_directory() . '/inc/customizer/social/social_footer.php';
require_once get_template_directory() . '/inc/customizer/social/social_mobile.php';
