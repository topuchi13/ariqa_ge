<?php
/**
 * Woo Color
 * ================
 */
$section  = 'woo_color';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'color',
	'settings' => 'woo_color_primary',
	'label'    => esc_html__( 'Primary color', 'tm-renovation' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => WOO_COLOR_PRIMARY,
	'output'   => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce.single .product .woocommerce-tabs ul.tabs li a:after,
				.sidebar .widget_product_tag_cloud .tagcloud a:hover,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				p.demo_store,.woocommerce a.button.alt.disabled,
				.woocommerce button.button.alt.disabled,
				.woocommerce input.button.alt.disabled,
				.woocommerce #respond input#submit.alt.disabled,
				.woocommerce a.button.alt:disabled,
				.woocommerce button.button.alt:disabled,
				.woocommerce input.button.alt:disabled,
				.woocommerce #respond input#submit.alt:disabled,
				.woocommerce a.button.alt:disabled[disabled],
				.woocommerce button.button.alt:disabled[disabled],
				.woocommerce input.button.alt:disabled[disabled],
				.woocommerce #respond input#submit.alt:disabled[disabled],background-color'),
			'property' => 'background-color',
		),
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce-checkout form.woocommerce-checkout .select2-container.select2-container-active .select2-choice,
				.select2-drop-active,
				.sidebar .widget_product_tag_cloud .tagcloud a:hover'),
			'property' => 'border-color',
		),
		array(
			'element'  => '.woocommerce .woocommerce-message,.woocommerce .woocommerce-info',
			'property' => 'border-top-color',
		),
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce-checkout .showlogin,
				.woocommerce-checkout .showcoupon,
				.woocommerce ul.product_list_widget li a:hover,
				.woocommerce .woocommerce-message:before,
				.woocommerce .woocommerce-info:before,
				.woocommerce.single .product .woocommerce-tabs ul.tabs li.active a,
				.woocommerce.single .product .woocommerce-tabs ul.tabs li:hover a'),
			'property' => 'color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'woo_color_secondary',
	'label'     => esc_html__( 'Secondary color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => WOO_COLOR_SECONDARY,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
				.woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce nav.woocommerce-pagination ul li a:hover,
				.woocommerce nav.woocommerce-pagination ul li a:focus'),
			'property' => 'background',
		),
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.widget_product_tag_cloud .tagcloud a,
				.woocommerce-checkout .woocommerce-checkout #payment label,
				.woocommerce ul.product_list_widget li a'),
			'property' => 'color'
		),
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce .widget_shopping_cart .total,
				.woocommerce .widget_shopping_cart .total'),
			'property' => 'border-top-color'
		)
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'woo_color_high_light',
	'label'     => esc_html__( 'High Light Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => WOO_COLOR_HIGH_LIGHT,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce-cart .cart-collaterals .cart_totals .discount td,
				.woocommerce div.product .stock,
				.woocommerce div.product span.price,
				.woocommerce div.product p.price'),
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce span.onsale',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'woo_color_content_bg',
	'label'     => esc_html__( 'Content Background Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => WOO_COLOR_CONTENT_BG,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'   => 'woo_color_subtext',
	'label'     => esc_html__( 'Subtext Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => WOO_COLOR_SUBTEXT,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce-checkout #payment div.payment_box span.help,
				.woocommerce-checkout .checkout .create-account small,
				.woocommerce-cart .cart-collaterals .cart_totals table small,
				.woocommerce-cart .cart-collaterals .cart_totals p small,
				.woocommerce #reviews #comments ol.commentlist li .meta,
				.woocommerce #reviews h2 small a,
				.woocommerce #reviews h2 small,
				.woocommerce .woocommerce-breadcrumb a,
				.woocommerce small.note,.woocommerce .woocommerce-breadcrumb'),
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_color',
	'label'       => esc_html__( 'Button Color', 'tm-renovation' ),
	'description' => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_COLOR,
	'transport'   => 'postMessage',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit'),
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_color_hover',
	'description' => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_COLOR_HOVER,
	'transport'   => 'postMessage',
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce #respond input#submit:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button:hover'),
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_bg_color',
	'label'       => esc_html__( 'Button Background Color', 'tm-renovation' ),
	'description' => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_BG_COLOR,
	'transport'   => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit'),
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_bg_color_hover',
	'description' => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_BG_COLOR_HOVER,
	'transport'   => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt.disabled:hover,
				.woocommerce button.button.alt.disabled:hover,
				.woocommerce input.button.alt.disabled:hover,
				.woocommerce #respond input#submit.alt.disabled:hover,
				.woocommerce a.button.alt:disabled:hover,
				.woocommerce button.button.alt:disabled:hover,
				.woocommerce input.button.alt:disabled:hover,
				.woocommerce #respond input#submit.alt:disabled:hover,
				.woocommerce a.button.alt:disabled[disabled]:hover,
				.woocommerce button.button.alt:disabled[disabled]:hover,
				.woocommerce input.button.alt:disabled[disabled]:hover,
				.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button.alt:hover,
				.woocommerce #respond input#submit.alt:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button:hover'),
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_border_color',
	'label'       => esc_html__( 'Button Border Color', 'tm-renovation' ),
	'description' => esc_html__( 'Normal State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_BORDER_COLOR,
	'transport'   => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit'),
			'property' => 'border-color',
			'units'    => '!important'
		),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'color',
	'settings'     => 'woo_button_border_color_hover',
	'description' => esc_html__( 'Hover State', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_BUTTON_BORDER_COLOR_HOVER,
	'transport'   => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => TM_Renovation_Helper::text2line('
				.woocommerce a.button.alt.disabled:hover,
				.woocommerce button.button.alt.disabled:hover,
				.woocommerce input.button.alt.disabled:hover,
				.woocommerce #respond input#submit.alt.disabled:hover,
				.woocommerce a.button.alt:disabled:hover,
				.woocommerce button.button.alt:disabled:hover,
				.woocommerce input.button.alt:disabled:hover,
				.woocommerce #respond input#submit.alt:disabled:hover,
				.woocommerce a.button.alt:disabled[disabled]:hover,
				.woocommerce button.button.alt:disabled[disabled]:hover,
				.woocommerce input.button.alt:disabled[disabled]:hover,
				.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button.alt:hover,
				.woocommerce #respond input#submit.alt:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button:hover'),
			'property' => 'border-color',
			'units'    => '!important'
		),
	),
) );