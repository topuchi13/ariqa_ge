<?php

$section  = 'logo';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'image',
	'settings'     => 'site_logo',
	'description' => esc_html__( 'Choose a default logo image to display', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SITE_LOGO
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'spacing',
	'label'       => esc_html__( 'Logo Padding', 'tm-renovation' ),
	'description' => esc_html__( 'Set up padding for your logo', 'tm-renovation' ),
	'settings'     => 'site_logo_padding',
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'top'    => SITE_LOGO_PADDING_TOP,
		'bottom' => SITE_LOGO_PADDING_BOTTOM,
		'left'   => SITE_LOGO_PADDING_LEFT,
		'right'  => SITE_LOGO_PADDING_RIGHT,
	),
	'output'      => array(
		array(
			'element'  => '.site-branding',
			'property' => 'padding',
			'media_query'   => '@media ( min-width: 62rem )',
		),
	)
) );