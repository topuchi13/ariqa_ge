<?php

$section  = 'social_mobile';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'mobile_menu_social_links_color',
	'label'           => esc_html__( 'Social links color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => MOBILE_MENU_SOCIAL_LINKS_COLOR,
	'output'          => array(
		array(
			'element'  => '#social-menu-top-mobile > li > a',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'social_links_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'mobile_menu_social_links_color_hover',
	'label'           => esc_html__( 'Social links color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => MOBILE_MENU_SOCIAL_LINKS_COLOR_HOVER,
	'output'          => array(
		array(
			'element'  => '#social-menu-top-mobile > li > a:hover',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'social_links_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );