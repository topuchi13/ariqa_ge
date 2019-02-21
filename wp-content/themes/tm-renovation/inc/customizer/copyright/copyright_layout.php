<?php

$section  = 'copyright_layout';
$priority = 1;

// Content
Kirki::add_field( 'infinity', array(
	'type'            => 'editor',
	'settings'        => 'copyright_layout_text',
	'label'           => esc_html__( 'Content', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => COPYRIGHT_LAYOUT_TEXT,
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '.copyright .center',
			'function' => 'html',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'copyright_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

// Spacing
Kirki::add_field( 'infinity', array(
	'type'            => 'spacing',
	'settings'        => 'copyright_general_padding',
	'label'           => esc_html__( 'Padding', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => array(
		'top'    => COPYRIGHT_GENERAL_PADDING_TOP,
		'bottom' => COPYRIGHT_GENERAL_PADDING_BOTTOM,
		'left'   => COPYRIGHT_GENERAL_PADDING_LEFT,
		'right'  => COPYRIGHT_GENERAL_PADDING_RIGHT
	),
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.copyright',
			'property' => 'padding',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'copyright_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'spacing',
	'settings'        => 'copyright_general_margin',
	'label'           => esc_html__( 'Margin', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => array(
		'top'    => COPYRIGHT_GENERAL_MARGIN_TOP,
		'bottom' => COPYRIGHT_GENERAL_MARGIN_BOTTOM,
		'left'   => COPYRIGHT_GENERAL_MARGIN_LEFT,
		'right'  => COPYRIGHT_GENERAL_MARGIN_RIGHT
	),
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.copyright',
			'property' => 'margin',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'copyright_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );