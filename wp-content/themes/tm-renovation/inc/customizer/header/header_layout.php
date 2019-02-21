<?php
/**
 * Header Layout
 * ==============
 */
$section  = 'header_layout';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'select',
	'settings'     => 'header_type',
	'label'       => esc_html__( 'Header Type', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the header type you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => HEADER_TYPE,
	'choices'     => array(
		'header01' => 'Type 01',
		'header02' => 'Type 02',
		'header03' => 'Type 03',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'     => 'typography',
	'settings' => 'header_style_font',
	'label'    => esc_html__( 'Font Settings', 'tm-renovation' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array(
		'font-size'      => HEADER_STYLE_FONT_SIZE,
		'line-height'    => SITE_STYLE_BODY_LINE_HEIGHT,
		'letter-spacing' => SITE_STYLE_BODY_LETTER_SPACING,
		'subsets'        => array( 'latin-ext' ),
	),
	'output'   => array(
		'element' => '.site-header',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'header_style_font_color',
	'label'     => esc_html__( 'Font Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => HEADER_STYLE_FONT_COLOR,
	'transport' => 'auto',
	'output'    => array(
		'element'     => '.site-header, .extra-info h3',
		'property'    => 'color',
		'media_query' => '@media ( min-width: 75rem )',
	)
) );


Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'header_bg_color',
	'label'     => esc_html__( 'Background color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => HEADER_BG_COLOR,
	'choices'   => array(
		'alpha' => true,
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.site-header',
			'property' => 'background-color',
		),
	)
) );
