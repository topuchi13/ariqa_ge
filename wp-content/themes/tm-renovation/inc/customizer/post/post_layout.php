<?php
/**
 * Post Layout
 * =========
 */
$section  = 'post_layout';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'    => 'post_layout',
	'description' => esc_html__( 'Choose the post layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => POST_LAYOUT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'spacing',
	'settings'  => 'post_spacing_padding',
	'label'     => esc_html__( 'Padding', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => POST_SPACING_PADDING_TOP,
		'bottom' => POST_SPACING_PADDING_BOTTOM,
		'left'   => POST_SPACING_PADDING_LEFT,
		'right'  => POST_SPACING_PADDING_RIGHT,
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.big-title--single .entry-title',
			'property' => 'padding',
		),
	)
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'post_layout_hide_tags',
	'label'       => esc_html__( 'Hide tags', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to hide tags when display posts.', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => POST_LAYOUT_HIDE_TAGS,
) );


Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'post_layout_hide_share',
	'label'       => esc_html__( 'Hide share buttons', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to hide share buttons when display posts.', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => POST_LAYOUT_HIDE_SHARE,
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'toggle',
	'settings'    => 'post_layout_hide_read_more',
	'label'       => esc_html__( 'Hide \'Read more\' link', 'tm-renovation' ),
	'description' => esc_html__( 'Turn on this option if you want to hide \'Read more\' link when display posts.', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => POST_LAYOUT_HIDE_READ_MORE,
) );