<?php

$section  = 'typo_body';
$priority = 1;

Kirki::add_field( 'infinity',
	array(
		'type'      => 'typography',
		'settings'  => 'site_style_body_font',
		'label'     => esc_html__( 'Font Family', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'transport' => 'auto',
		'default'   => array(
			'font-family'    => SITE_STYLE_BODY_FONT_FAMILY,
			'variant'        => SITE_STYLE_BODY_FONT_VARIANT,
			'font-size'      => SITE_STYLE_BODY_FONT_SIZE,
			'line-height'    => SITE_STYLE_BODY_LINE_HEIGHT,
			'letter-spacing' => SITE_STYLE_BODY_LETTER_SPACING,
			'subsets'        => array( 'latin-ext' ),
		),
		'output'    => array(
			array(
				'element' => TM_Renovation_Helper::text2line( '
				.eg-renovation-member-wrapper .esg-entry-content p,
				body, input, select, textarea' ),
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'site_style_body_text',
		'label'     => esc_html__( 'Font Color', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => SITE_STYLE_BODY_TEXT,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => 'body',
				'property' => 'color',
			),
		),
	) );

