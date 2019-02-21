<?php
/**
 * Top Area Spacing
 * ============
 */
$section  = 'top_spacing';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'            => 'spacing',
	'settings'         => 'top_padding',
	'label'           => esc_html__( 'Padding', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'transport'       => 'auto',
	'default'         => array(
		'top'    => TOP_PADDING_TOP,
		'bottom' => TOP_PADDING_BOTTOM,
		'left'   => TOP_PADDING_LEFT,
		'right'  => TOP_PADDING_RIGHT,
	),
	'output'          => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.header01 .site-top,
				.header03 .site-top ul li'),
			'property' => 'padding',
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
	'type'            => 'spacing',
	'settings'         => 'top_margin',
	'label'           => esc_html__( 'Margin', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'transport'       => 'auto',
	'default'         => array(
		'top'    => TOP_MARGIN_TOP,
		'bottom' => TOP_MARGIN_BOTTOM,
		'left'   => TOP_MARGIN_LEFT,
		'right'  => TOP_MARGIN_RIGHT,
	),
	'output'          => array(
		array(
			'element'  => '.site-top',
			'property' => 'margin',
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