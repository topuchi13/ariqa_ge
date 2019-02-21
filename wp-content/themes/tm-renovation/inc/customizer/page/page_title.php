<?php

$section  = 'page_title';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'typography',
	'settings' => 'page_style_heading_font',
	'label'    => esc_html__( 'Font Family', 'tm-renovation' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array(
		'font-family'    => PAGE_STYLE_HEADING_FONT_FAMILY,
		'font-size'      => PAGE_STYLE_HEADING_FONT_SIZE,
		'variant'        => PAGE_STYLE_HEADING_FONT_VARIANT,
		'letter-spacing' => PAGE_STYLE_HEADING_LETTER_SPACING,
	),
	'output'   => array(
		'element' => '.big-title .entry-title',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'     => 'select',
	'label'    => esc_html__( 'Page Title Style', 'tm-renovation' ),
	'settings' => 'page_style_heading_style',
	'default'  => PAGE_STYLE_HEADING_STYLE,
	'section'  => $section,
	'priority' => $priority ++,
	'choices'  => array(
		'image'     => esc_html__( 'Image Background', 'tm-renovation' ),
		'big-image' => esc_html__( 'Big Image Background', 'tm-renovation' ),
		'bg_color'  => esc_html__( 'Single Color Background', 'tm-renovation' ),
	),
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'toggle',
	'settings'        => 'page_style_disable_parallax',
	'label'           => esc_html__( 'Parallax Effect', 'tm-renovation' ),
	'description'     => esc_html__( 'Turn on this option if you want to enable parallax effect for page heading', 'tm-renovation' ),
	'default'         => ! PAGE_STYLE_DISABLE_PARALLAX,
	'section'         => $section,
	'priority'        => $priority ++,
	'active_callback' => array(
		array(
			'settings' => 'page_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'color',
	'settings'  => 'page_style_heading_font_color',
	'label'     => esc_html__( 'Font Color', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => PAGE_STYLE_HEADING_FONT_COLOR,
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.big-title .entry-title',
			'property' => 'color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'     => 'custom',
	'settings' => 'page_bg_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Background', 'tm-renovation' ) . '</div>',
) );

// Background settings
Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'        => 'page_heading_bg_color',
	'label'           => esc_html__( 'Background Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => PAGE_HEADING_BG_COLOR,
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.big-title',
			'property' => 'background-color',
		)
	),
	'active_callback' => array(
		array(
			'settings' => 'page_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'color',
	'settings'        => 'page_overlay_bg_color',
	'label'           => esc_html__( 'Overlay Color', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => PAGE_OVERLAY_BG_COLOR,
	'transport'       => 'auto',
	'choices'   => array(
		'alpha' => true,
	),
	'output'          => array(
		array(
			'element'  => '.big-title.image-bg:after',
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'page_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'            => 'image',
	'settings'        => 'page_heading_bg_image',
	'label'           => esc_html__( 'Background Image', 'tm-renovation' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => PAGE_HEADING_BG_IMAGE,
	'transport'       => 'auto',
	'output'          => array(
		array(
			'element'  => '.big-title.image-bg',
			'property' => 'background-image',
		),
	),
	'active_callback' => array(
		array(
			'settings' => 'page_style_heading_style',
			'operator' => '!=',
			'value'    => 'bg_color',
		),
	)
) );