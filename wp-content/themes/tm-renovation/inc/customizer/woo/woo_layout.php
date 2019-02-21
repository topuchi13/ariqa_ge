<?php
/**
 * Woo Layout
 * ================
 */
$section  = 'woo_layout';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'     => 'woo_layout_category',
	'label'       => esc_html__( 'Category Product Page Layout', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the category product page layout you want', 'tm-renovation' ),
	'help'        => esc_html__( 'Choose the category product page layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_LAYOUT_CATEGORY,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );

Kirki::add_field( 'infinity', array(
	'type'        => 'radio-image',
	'settings'     => 'woo_layout_single_product',
	'label'       => esc_html__( 'Single Product Page Layout', 'tm-renovation' ),
	'description' => esc_html__( 'Choose the product page layout you want', 'tm-renovation' ),
	'help'        => esc_html__( 'Choose the product page layout you want', 'tm-renovation' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => WOO_LAYOUT_SINGLE_PRODUCT,
	'choices'     => array(
		'full-width'      => TM_RENOVATION_URI . '/core/kirki/assets/images/1c.png',
		'content-sidebar' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cr.png',
		'sidebar-content' => TM_RENOVATION_URI . '/core/kirki/assets/images/2cl.png',
	),
) );