<?php

$section  = 'background_image';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'site_bg_color',
	'label'     => esc_html__( 'Background color', 'tm-renovation' ),
	'help'      => esc_html__( 'Setup background color for your header', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => SITE_BG_COLOR,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.boxed',
			'property' => 'background-color',
		),
	)
) );