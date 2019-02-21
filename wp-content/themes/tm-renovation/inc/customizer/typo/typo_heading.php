<?php

$section  = 'typo_heading';
$priority = 1;

Kirki::add_field( 'infinity',
	array(
		'type'      => 'typography',
		'settings'  => 'site_style_heading_font',
		'label'     => esc_html__( 'Font Family', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'transport' => 'auto',
		'default'   => array(
			'font-family'    => SITE_STYLE_HEADING_FONT_FAMILY,
			'variant'        => SITE_STYLE_HEADING_FONT_VARIANT,
			'line-height'    => SITE_STYLE_HEADING_LINE_HEIGHT,
			'letter-spacing' => SITE_STYLE_HEADING_LETTER_SPACING,
			'subsets'        => array( 'latin-ext' ),
		),
		'output'    => array(
			array(
				'element' => TM_Renovation_Helper::text2line( 'h1,h2,h3,h4,h5,h6,.vc_tta-tabs.vc_tta-style-renovation.vc_tta-style-renovation .vc_tta-tab > a,
			.woocommerce.single .product .woocommerce-tabs ul.tabs li,
			.btQuoteBooking .btQuoteTotalText,
			.btQuoteBooking .btQuoteTotalCalc,
			.btQuoteBooking .btQuoteTotalCurrency' ),
			),
			array(
				'element' => '.renovation .esg-filterbutton',
				'units'   => '!important',
			),
		),
	) );


Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'site_style_heading_font_color',
		'label'     => esc_html__( 'Font Color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_FONT_COLOR,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => TM_Renovation_Helper::text2line( 'h1,h2,h3,h4,h5,h6,.vc_tta-tabs.vc_tta-style-renovation.vc_tta-style-renovation .vc_tta-tab > a,
			.woocommerce.single .product .woocommerce-tabs ul.tabs li,
			.btQuoteBooking .btQuoteTotalText,
			.btQuoteBooking .btQuoteTotalCalc,
			.btQuoteBooking .btQuoteTotalCurrency' ),
				'property' => 'color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'     => 'custom',
		'settings' => 'site_style_hr_' . $priority ++,
		'section'  => $section,
		'priority' => $priority ++,
		'default'  => '<hr />',
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h1_font_size',
		'label'     => esc_html__( 'H1 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H1_FONT_SIZE,
		'transport' => 'auto',
		'choices'   => array(
			'min'  => 15,
			'max'  => 100,
			'step' => 1,
		),
		'output'    => array(
			'element'  => 'h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h2_font_size',
		'label'     => esc_html__( 'H2 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H2_FONT_SIZE,
		'choices'   => array(
			'min'  => 10,
			'max'  => 90,
			'step' => 1,
		),
		'transport' => 'auto',
		'output'    => array(
			'element'  => 'h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h3_font_size',
		'label'     => esc_html__( 'H3 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H3_FONT_SIZE,
		'choices'   => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1,
		),
		'transport' => 'auto',
		'output'    => array(
			'element'  => 'h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h4_font_size',
		'label'     => esc_html__( 'H4 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H4_FONT_SIZE,
		'choices'   => array(
			'min'  => 10,
			'max'  => 70,
			'step' => 1,
		),
		'transport' => 'auto',
		'output'    => array(
			'element'  => 'h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h5_font_size',
		'label'     => esc_html__( 'H5 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H5_FONT_SIZE,
		'choices'   => array(
			'min'  => 10,
			'max'  => 70,
			'step' => 1,
		),
		'transport' => 'auto',
		'output'    => array(
			'element'  => 'h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'slider',
		'settings'  => 'site_style_heading_h6_font_size',
		'label'     => esc_html__( 'H6 Font Size', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_HEADING_H6_FONT_SIZE,
		'choices'   => array(
			'min'  => 10,
			'max'  => 70,
			'step' => 1,
		),
		'transport' => 'auto',
		'output'    => array(
			'element'  => 'h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	) );