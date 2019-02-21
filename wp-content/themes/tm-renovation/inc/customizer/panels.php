<?php

$priority = 1;

// Add panels
Kirki::add_panel( 'site', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Site', 'tm-renovation' ),
) );

Kirki::add_panel( 'logo', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Logo & Favicon', 'tm-renovation' ),
) );

Kirki::add_panel( 'layout', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Layout & Background', 'tm-renovation' ),
) );

Kirki::add_panel( 'typo', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Typography', 'tm-renovation' ),
) );

Kirki::add_panel( 'color', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Color', 'tm-renovation' ),
) );

Kirki::add_panel( 'top', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Top Area', 'tm-renovation' ),
) );

Kirki::add_panel( 'header', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Header', 'tm-renovation' ),
) );

Kirki::add_panel( 'social', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Social', 'tm-renovation' ),
) );

if ( function_exists( 'tm_bread_crumb' ) ) {
	Kirki::add_panel( 'breadcrumb', array(
		'priority' => $priority ++,
		'title'    => esc_html__( 'Breadcrumb', 'tm-renovation' ),
	) );
}

Kirki::add_panel( 'nav', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Navigation', 'tm-renovation' ),
) );

Kirki::add_panel( 'button', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Button', 'tm-renovation' ),
) );

Kirki::add_panel( 'footer', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Footer', 'tm-renovation' ),
) );

Kirki::add_panel( 'copyright', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Copyright', 'tm-renovation' ),
) );

Kirki::add_panel( 'page', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Page', 'tm-renovation' ),
) );

Kirki::add_panel( 'post', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Post', 'tm-renovation' ),
) );

Kirki::add_panel( 'woo', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Shop', 'tm-renovation' ),
) );

Kirki::add_panel( 'custom', array(
	'priority' => $priority ++,
	'title'    => esc_html__( 'Custom Code', 'tm-renovation' ),
) );

require_once TM_RENOVATION_CUSTOMIZER_DIR . '/site/_site.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/logo/_logo.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/layout/_layout.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/typo/_typo.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/color/_color.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/nav/_nav.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/button/_button.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/top/_top.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/header/_header.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/social/_social.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/breadcrumb/_breadcrumb.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/footer/_footer.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/copyright/_copyright.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/page/_page.php';
require_once TM_RENOVATION_CUSTOMIZER_DIR . '/post/_post.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once TM_RENOVATION_CUSTOMIZER_DIR . '/woo/_woo.php';
}

require_once TM_RENOVATION_CUSTOMIZER_DIR . '/custom/_custom.php';