<?php

$section  = 'button_layout';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'typography',
	'settings' => 'button_style_font',
	'label'    => esc_html__( 'Font Settings', 'tm-renovation' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array(
		'font-family'    => BUTTON_STYLE_FONT_FAMILY,
		'font-size'      => BUTTON_STYLE_FONT_SIZE,
		'variant'        => BUTTON_STYLE_FONT_VARIANT,
		'line-height'    => BUTTON_STYLE_FONT_LINE_HEIGHT,
		'letter-spacing' => BUTTON_STYLE_FONT_LETTER_SPACING,
		'subsets'        => array( 'latin-ext' ),
	),
	'output'   => array(
		'element' => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit,
				a.button, button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'spacing',
	'settings'  => 'button_padding',
	'label'     => esc_html__( 'Padding', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => BUTTON_PADDING_TOP,
		'bottom' => BUTTON_PADDING_BOTTOM,
		'left'   => BUTTON_PADDING_LEFT,
		'right'  => BUTTON_PADDING_RIGHT,
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
			    .btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'padding',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'spacing',
	'settings'  => 'button_margin',
	'label'     => esc_html__( 'Margin', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => BUTTON_MARGIN_TOP,
		'bottom' => BUTTON_MARGIN_BOTTOM,
		'left'   => BUTTON_MARGIN_LEFT,
		'right'  => BUTTON_MARGIN_RIGHT,
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'margin',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'dimension',
	'settings'  => 'button_border_width',
	'label'     => esc_html__( 'Border width', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => BUTTON_BORDER_WIDTH,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'border-width',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'button_border_style',
	'label'     => esc_html__( 'Border style', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => BUTTON_BORDER_STYLE,
	'transport' => 'auto',
	'choices'   => array(
		'solid'  => esc_html__( 'Solid', 'tm-renovation' ),
		'dashed' => esc_html__( 'Dashed', 'tm-renovation' ),
		'dotted' => esc_html__( 'Dotted', 'tm-renovation' ),
		'double' => esc_html__( 'Double', 'tm-renovation' ),
	),
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				a.button, button, input[type="button"],
				input[type="reset"], input[type="submit"],
				.btn, .thememove-btn,
				.btQuoteBooking .btContactNext,
				.btQuoteBooking .btContactSubmit'),
			'property' => 'border-style',
		),
	),
) );