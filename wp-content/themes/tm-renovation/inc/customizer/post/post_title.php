<?php

$section  = 'post_title';
$priority = 1;


Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'post_style_heading_enable',
	'label'       => esc_html__( 'Show heading title in single post', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to show heading title in single post', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => POST_STYLE_HEADING_ENABLE,
) );


Kirki::add_field( 'infinity', array(
	'type'            => 'text',
	'settings'        => 'post_style_heading_text',
	'label'           => esc_html__( 'Text', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => POST_STYLE_HEADING_TEXT,
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '.big-title--single',
			'function' => 'html',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'post_style_heading_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'typography',
	'settings'        => 'post_style_heading_font',
	'label'           => esc_html__( 'Font Family', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => array(
		'font-family'    => POST_STYLE_HEADING_FONT_FAMILY,
		'font-size'      => POST_STYLE_HEADING_FONT_SIZE,
		'variant'        => POST_STYLE_HEADING_FONT_VARIANT,
		'letter-spacing' => POST_STYLE_HEADING_LETTER_SPACING,
	),
	'output'          => array(
		'element' => '.big-title--single .entry-title',
	),
	'active_callback' => array(
		array(
			'settings' => 'post_style_heading_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'        => 'post_style_heading_font_color',
	'label'           => esc_html__( 'Font Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => POST_STYLE_HEADING_FONT_COLOR,
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.big-title--single .entry-title',
			'property' => 'color',
			'units'    => '!important',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'post_style_heading_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'select',
	'settings'        => 'post_style_heading_style',
	'label'           => esc_html__( 'Style', 'tm-renovation' ),
	'default'         => POST_STYLE_HEADING_STYLE,
	'section'         => $section,
	'priority'        => $priority ++,
	'choices'         => array(
		'image'     => esc_html__( 'Image Background', 'tm-renovation' ),
		'big-image' => esc_html__( 'Big Image Background', 'tm-renovation' ),
		'bg_color'  => esc_html__( 'Single Color Background', 'tm-renovation' ),
	),
	'active_callback' => array(
		array(
			'settings' => 'post_style_heading_enable',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'toggle',
	'settings'        => 'post_style_disable_parallax',
	'label'           => esc_html__( 'Parallax Effect', 'tm-renovation' ),
	'description'     => esc_html__( 'Turn on this option if you want to enable parallax effect for page heading', 'tm-renovation' ),
	'default'         => ! POST_STYLE_DISABLE_PARALLAX,
	'section'         => $section,
	'priority'        => $priority ++,
	'active_callback' => array(
		array(
			'settings' => 'post_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'     => 'custom',
	'settings' => 'post_bg_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Background', 'tm-renovation' ) . '</div>',
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'  => 'post_heading_bg_color',
	'label'     => esc_html__( 'Background color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => POST_HEADING_BG_COLOR,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.big-title--single',
			'property' => 'background-color',
			'units'    => '!important',
		),
	),
	'required'  => array(
		array(
			'settings' => 'post_style_heading_style',
			'operator' => '==',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'  => 'post_overlay_bg_color',
	'label'     => esc_html__( 'Overlay color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => POST_OVERLAY_BG_COLOR,
	'transport' => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'    => array(
		array(
			'element'  => '.big-title--single.image-bg:after',
			'property' => 'background-color',
			'units'    => '!important',
		),
	),
	'required'  => array(
		array(
			'settings' => 'post_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'image',
	'settings'  => 'post_heading_bg_image',
	'label'     => esc_html__( 'Background Image', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => POST_HEADING_BG_IMAGE,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.big-title--single.image-bg',
			'property' => 'background-image',
		),
	),
	'required'  => array(
		array(
			'settings' => 'post_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );