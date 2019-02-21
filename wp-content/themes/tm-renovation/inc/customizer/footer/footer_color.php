<?php

$section  = 'footer_color';
$priority = 1;

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'footer_style_text_color',
		'label'     => esc_html__( 'Text Color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => FOOTER_STYLE_TEXT_COLOR,
		'transport' => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'    => array(
			'element'  => '.site-footer',
			'property' => 'color',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'footer_style_link_color',
		'label'       => esc_html__( 'Link Color', 'tm-renovation' ),
		'description' => esc_html__( 'Normal State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => FOOTER_STYLE_LINK_COLOR,
		'transport'   => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'      => array(
			'element'  => '.site-footer a',
			'property' => 'color',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'footer_style_link_color_hover',
		'description' => esc_html__( 'Hover State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => FOOTER_STYLE_LINK_COLOR_HOVER,
		'transport'   => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'      => array(
			'element'  => '.site-footer a:hover',
			'property' => 'color',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'footer_style_widget_title_color',
		'label'     => esc_html__( 'Widget Title Color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => FOOTER_STYLE_WIDGET_TITLE_COLOR,
		'transport' => 'auto',
		'output'    => array(
			'element'  => '.site-footer .widget-title',
			'property' => 'color',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'footer_bg_color',
		'label'     => esc_html__( 'Background color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => FOOTER_BG_COLOR,
		'transport' => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'    => array(
			array(
				'element'  => '.site-footer:before',
				'property' => 'background-color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'footer_border_color',
		'label'     => esc_html__( 'Border color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => FOOTER_BORDER_COLOR,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '.site-footer',
				'property' => 'border-color',
			),
		),
	) );