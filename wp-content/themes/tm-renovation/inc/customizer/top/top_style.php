<?php
/**
 * Top Area Style
 * ============
 */
$section  = 'top_style';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'top_bg_color',
	'label'           => esc_html__( 'Background color', 'tm-renovation' ),
	'help'            => esc_html__( 'Setup background color for your top', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_BG_COLOR,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'          => array(
		array(
			'element'  => '.site-top, .header01 .top-right-menu .sub-menu li',
			'property' => 'background-color',
		),
		array(
			'element'     => '.header02 .top-right-menu li:first-child:before',
			'property'    => 'border-left-color',
			'media_query' => '@media (min-width: 62rem)',
		)
	),
	'active_callback' => array(
		array(
			'settings' => 'header_type',
			'operator' => '!=',
			'value'    => 'header04',
		),
		array(
			'settings' => 'top_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'typography',
	'settings'        => 'top_style_link_font',
	'label'           => esc_html__( 'Font Family', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => array(
		'font-size' => TOP_STYLE_LINK_FONT_SIZE
	),
	'output'          => array(
		'element' => '.site-top a',
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
	'settings'         => 'top_style_link_font_color',
	'label'           => esc_html__( 'Link Color', 'tm-renovation' ),
	'description'     => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_STYLE_LINK_FONT_COLOR,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'          => array(
		'element'  => '.site-top a, .header03 .site-top',
		'property' => 'color',
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
	'settings'         => 'top_style_link_font_color_hover',
	'description'     => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => TOP_STYLE_LINK_FONT_COLOR_HOVER,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'          => array(
		'element'  => '.site-top a:hover',
		'property' => 'color',
	),
	'active_callback' => array(
		array(
			'settings' => 'top_layout_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );