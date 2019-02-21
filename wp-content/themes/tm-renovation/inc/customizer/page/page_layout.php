<?php
/**
 * Page Layout
 * =========
 */
$section  = 'page_layout';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'    => 'page_layout',
	'description' => esc_html__( 'Choose the site layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => PAGE_LAYOUT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'      => 'spacing',
	'settings'  => 'page_spacing_padding',
	'label'     => esc_html__( 'Padding', 'tm-renovation' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => PAGE_SPACING_PADDING_TOP,
		'bottom' => PAGE_SPACING_PADDING_BOTTOM,
		'left'   => PAGE_SPACING_PADDING_LEFT,
		'right'  => PAGE_SPACING_PADDING_RIGHT,
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.big-title .entry-title',
			'property' => 'padding',
		),
	)
) );