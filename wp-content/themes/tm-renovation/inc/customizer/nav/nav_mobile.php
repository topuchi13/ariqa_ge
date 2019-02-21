<?php

$section  = 'nav_mobile';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'  => 'nav_style_mobile_menu_link_color',
	'label'     => esc_html__( 'Button color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => NAV_STYLE_MOBILE_MENU_LINK_COLOR,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#open-left',
			'property' => 'color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'  => 'nav_bg_mobile_menu_bg',
	'label'     => esc_html__( 'Mobile menu background', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => NAV_BG_MOBILE_MENU_BG,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'     => '.snap-drawers',
			'property'    => 'background-color',
			'media_query' => '@media ( max-width: 74.9375rem )',
		),
	)
) );