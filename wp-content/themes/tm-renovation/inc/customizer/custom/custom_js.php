<?php
/**
 * Custom JS
 * ===================
 */
$section  = 'custom_js';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'toggle',
	'settings' => 'custom_js_enable',
	'label'    => esc_html__( 'Enable Custom JS', 'tm-renovation' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'code',
	'settings'        => 'custom_js',
	'label'           => esc_html__( 'Custom JS', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'choices'         => array(
		'label'    => esc_html__( 'Open Editor', 'tm-renovation' ),
		'language' => 'css',
		'theme'    => 'monokai',
	),
	'default'         => 'jQuery(document).ready(function(){/*Write your custom JS snippet here*/});',
	'active_callback' => array(
		array(
			'settings' => 'custom_js_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );