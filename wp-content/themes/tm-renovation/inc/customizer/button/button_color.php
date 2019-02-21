<?php

$section  = 'button_color';
$priority = 1;

// Text color
Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_style_link_color',
	'label'       => esc_html__( 'Text Color', 'tm-renovation' ),
	'description' => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => BUTTON_STYLE_LINK_COLOR,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				button, input[type="button"],
				input[type="reset"], input[type="submit"],
				a.btn, a.thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'color',
		),
		array(
			'element'  => '.tp-caption.Renovation-Button > a',
			'property' => 'color',
			'units'    => '!important',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_style_link_color_hover',
	'description' => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => BUTTON_STYLE_LINK_COLOR_HOVER,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				button:hover, input[type="button"]:hover,
				input[type="reset"]:hover, input[type="submit"]:hover,
				a.btn:hover, a.thememove-btn:hover,
				.btQuoteBooking .btContactNext:hover,
				.btQuoteBooking .btContactSubmit:hover'),
			'property' => 'color',
		),
		array(
			'element'  => '.tp-caption.Renovation-Button:hover > a, .tp-caption.Renovation-Button > a:hover',
			'property' => 'color',
			'units'    => '!important',
		),
	),
) );

// Background color
Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_bg_color',
	'label'       => esc_html__( 'Background color', 'tm-renovation' ),
	'description' => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => BUTTON_BG_COLOR,
	'transport'   => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				a.button, button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'background-color',
		),
		array(
			'element'  => '.tp-caption.Renovation-Button',
			'property' => 'background-color',
			'units'    => '!important',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_bg_color_hover',
	'description' => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => BUTTON_BG_COLOR_HOVER,
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				a.button:hover, button:hover, input[type="button"]:hover,
				input[type="reset"]:hover, input[type="submit"]:hover,
				.btn:hover, .thememove-btn:hover,
				.btQuoteBooking .btContactNext:hover,
				.btQuoteBooking .btContactSubmit:hover'),
			'property' => 'background-color',
		),
		array(
			'element'  => '.tp-caption.Renovation-Button:hover',
			'property' => 'background-color',
			'units'    => '!important',
		),
	),
) );

// Border color
Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_border_color',
	'label'       => esc_html__( 'Border color', 'tm-renovation' ),
	'description' => esc_html__( 'Border color', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => BUTTON_BORDER_COLOR,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				a.button, button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'border-color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'    => 'button_border_color_hover',
	'description' => esc_html__( 'Border color', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => BUTTON_BORDER_COLOR_HOVER,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				a.button:hover, button:hover, input[type="button"]:hover,
				input[type="reset"]:hover, input[type="submit"]:hover,
				.btn:hover, .thememove-btn:hover,
				.btQuoteBooking .btContactNext:hover,
				.btQuoteBooking .btContactSubmit:hover'),
			'property' => 'border-color',
		),
	),
) );