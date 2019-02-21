<?php

$section  = 'site_features';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'site_general_boxed',
	'label'       => esc_html__( 'Boxed mode', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to enable box mode for content', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SITE_GENERAL_BOXED,
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'site_general_back_to_top',
	'label'       => __( 'Back to top', 'tm-renovation' ),
	'description' => __( 'Enabling this option will display a Back to Top button on every page', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SITE_GENERAL_BACK_TO_TOP,
) );