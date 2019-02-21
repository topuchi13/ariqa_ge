<?php
/**
 * Top Area Border
 * ============
 */
$section  = 'top_border';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'            => 'dimension',
	'settings'        => 'top_border_width',
	'label'           => esc_html__( 'Border width', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_BORDER_WIDTH,
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.site-top',
			'property' => 'border-width',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'top_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'radio-buttonset',
	'settings'        => 'top_border_style',
	'label'           => esc_html__( 'Border style', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_BORDER_STYLE,
	'transport'       => 'auto',
	'choices'         => array(
		'solid'  => esc_html__( 'Solid', 'tm-renovation' ),
		'dashed' => esc_html__( 'Dashed', 'tm-renovation' ),
		'dotted' => esc_html__( 'Dotted', 'tm-renovation' ),
		'double' => esc_html__( 'Double', 'tm-renovation' ),
	),
	'output'          => array(
		array(
			'element'  => '.site-top',
			'property' => 'border-style',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'top_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'        => 'top_border_color',
	'label'           => esc_html__( 'Border color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_BORDER_COLOR,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'          => array(
		array(
			'element'  => '.site-top',
			'property' => 'border-color',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'top_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );