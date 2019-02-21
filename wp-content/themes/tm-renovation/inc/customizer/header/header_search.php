<?php

$section  = 'search';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'     => 'header_layout_search_enable',
	'label'       => esc_html__( 'Search box', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to enable search box on your site', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => HEADER_LAYOUT_SEARCH_ENABLE,
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'header_style_search_text_color',
	'label'     => esc_html__( 'Icon Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => HEADER_STYLE_SEARCH_TEXT_COLOR,
	'transport' => 'auto',
	'required'  => array(
		array(
			'settings' => 'header_layout_search_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		'element'  => '.search-box i',
		'property' => 'color',
	)
) );