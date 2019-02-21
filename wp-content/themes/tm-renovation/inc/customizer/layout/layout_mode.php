<?php

$section  = 'layout_mode';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'     => 'site_layout',
	'label'       => esc_html__( 'Site layout', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the site layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SITE_LAYOUT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'     => 'archive_layout',
	'label'       => esc_html__( 'Archive layout', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the archive layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ARCHIVE_LAYOUT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'     => 'search_layout',
	'label'       => esc_html__( 'Search layout', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the search layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SEARCH_LAYOUT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );