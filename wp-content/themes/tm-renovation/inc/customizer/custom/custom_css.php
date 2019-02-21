<?php
/**
 * Custom CSS
 * ==========
 */
$section  = 'custom_css';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'toggle',
	'settings' => 'custom_css_enable',
	'label'    => esc_html__( 'Enable Custom CSS', 'tm-renovation' ),
	'section'  => $section,
	'default'  => 1,
	'priority' => $priority ++,
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'code',
	'settings'        => 'custom_css',
	'label'           => esc_html__( 'Custom CSS', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'transport'       => 'postMessage',
	'choices'         => array(
		'language' => 'css',
		'theme'    => 'monokai',
	),
	'js_vars'         => array(
		array(
			'element'  => '#tm-renovation-inline-live-css',
			'function' => 'html',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'custom_css_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );