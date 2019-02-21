<?php

$section  = 'breadcrumb';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'site_general_breadcrumb_enable',
	'label'       => esc_html__( 'Breadcrumb', 'tm-renovation' ),
	'description' => esc_html__( 'Enabling this option will display breadcrumb on every page', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SITE_GENERAL_BREADCRUMB_ENABLE,
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'text',
	'settings'        => 'site_general_breadcrumb_home_text',
	'label'           => esc_html__( '"Home" text', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => SITE_GENERAL_BREADCRUMB_HOME_TEXT,
	'active_callback' => array(
		array(
			'settings' => 'site_general_breadcrumb_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'text',
	'settings'        => 'site_general_breadcrumb_you_are_here_text',
	'label'           => esc_html__( '"You are here" text', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => SITE_GENERAL_BREADCRUMB_YOU_ARE_HERE_TEXT,
	'active_callback' => array(
		array(
			'settings' => 'site_general_breadcrumb_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );