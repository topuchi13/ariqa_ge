<?php

$panel    = 'post';
$priority = 1;

// Add sections for post panel
Kirki::add_section( 'post_layout', array(
	'title'    => esc_html__( 'Layout', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'post_title', array(
	'title'       => esc_html__( 'Page Title', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/post/post_layout.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/post/post_title.php';