<?php

$panel    = 'typo';
$priority = 1;

Kirki::add_section( 'typo_links', array(
	'title'    => esc_html__( 'Links', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'typo_body', array(
	'title'    => esc_html__( 'Body', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

Kirki::add_section( 'typo_heading', array(
	'title'    => esc_html__( 'Heading', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/typo/typo_body.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/typo/typo_heading.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/typo/typo_links.php';