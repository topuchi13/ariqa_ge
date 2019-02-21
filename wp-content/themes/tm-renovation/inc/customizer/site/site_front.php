<?php

$section  = 'site_front';

function frontpage_setup( $wp_customize ) {
	$wp_customize->get_control( 'show_on_front' )->section  = 'site_front';
	$wp_customize->get_control( 'show_on_front' )->priority = '3';
	$wp_customize->get_control( 'page_on_front' )->section  = 'site_front';
	$wp_customize->get_control( 'page_on_front' )->priority = '4';
	$wp_customize->get_control( 'page_on_front' )->label    = 'Choose a page';
	$wp_customize->get_control( 'show_on_front' )->label    = '';
}

add_action( 'customize_register', 'frontpage_setup' );