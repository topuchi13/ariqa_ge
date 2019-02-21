<?php

$section  = 'minicart';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'     => 'header_layout_mini_cart_enable',
	'label'       => esc_html__( 'Mini Cart', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to enable mini cart for header', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => HEADER_LAYOUT_MINI_CART_ENABLE,
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'header_style_minicart_icon_color',
	'label'           => esc_html__( 'Icon Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => HEADER_STYLE_MINICART_ICON_COLOR,
	'transport'       => 'auto',
	'active_callback' => array(
		array(
			'settings' => 'header_layout_mini_cart_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		'element'  => '.mini-cart .mini-cart__button .mini-cart-icon:before',
		'property' => 'color',
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'header_style_minicart_text_color',
	'label'           => esc_html__( 'Text Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => HEADER_STYLE_MINICART_TEXT_COLOR,
	'transport'       => 'auto',
	'active_callback' => array(
		array(
			'settings' => 'header_layout_mini_cart_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		'element'  => '.mini-cart',
		'property' => 'color',
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'header_style_minicart_number_color',
	'label'           => esc_html__( 'Number Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => HEADER_STYLE_MINICART_NUMBER_COLOR,
	'transport'       => 'auto',
	'active_callback' => array(
		array(
			'settings' => 'header_layout_mini_cart_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		'element'  => '.mini-cart .mini-cart__button .mini-cart-icon:after',
		'property' => 'color',
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'         => 'header_bg_minicart_number_bg',
	'label'           => esc_html__( 'Background Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => HEADER_BG_MINICART_NUMBER_BG,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'settings' => 'header_layout_mini_cart_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		array(
			'element'  => '.mini-cart .mini-cart__button .mini-cart-icon:after',
			'property' => 'background-color',
		),
	)
) );