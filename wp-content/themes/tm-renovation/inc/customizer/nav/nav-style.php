<?php
/**
 * Nav Color
 * ================
 */
$section  = 'nav_style';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'     => 'custom',
	'settings' => 'nav_typo_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">Mobile Menu</div>',
) );

Kirki::add_field( 'infinity', array(
	'type'     => 'custom',
	'settings' => 'nav_typo_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">Main Menu</div>',
) );






