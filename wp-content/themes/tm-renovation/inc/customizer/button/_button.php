<?php

$panel = 'button';

$priority = 1;
// Add sections for button panel
Kirki::add_section( 'button_layout', array(
	'title'       => esc_html__( 'Layout', 'tm-renovation' ),
	'description' => esc_html__( 'In this section you can control all layout settings of buttons', 'tm-renovation' ),
	'panel'       => $panel,
	'priority'    => $priority ++
) );

Kirki::add_section( 'button_color', array(
	'title'    => esc_html__( 'Color', 'tm-renovation' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

require_once TM_RENOVATION_DIR . '/inc/customizer/button/button_layout.php';
require_once TM_RENOVATION_DIR . '/inc/customizer/button/button_color.php';