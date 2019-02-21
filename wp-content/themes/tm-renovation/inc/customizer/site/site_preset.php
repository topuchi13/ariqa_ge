<?php

$section  = 'site_preset';
$priority = 1;
$type     = 'site';

Kirki::add_field( 'infinity', array(
	'type'        => 'preset',
	'settings'    => 'site_preset',
	'label'       => esc_html__( 'Site Preset', 'tm-renovation' ),
	'description' => esc_html__( 'Controls the main color scheme & layout throughout your site.', 'tm-renovation' ),
	'default'     => 'preset1',
	'priority'    => $priority ++,
	'choices'     => array(
		'1' => array(
			'label'    => TM_Renovation_Preset::get_preset_label( $type, 'preset1' ),
			'image'    => TM_Renovation_Preset::get_preset_image( $type, 'preset1' ),
			'settings' => TM_Renovation_Preset::get_preset_settings( $type, 'preset1' ),
		),
		'2' => array(
			'label'    => TM_Renovation_Preset::get_preset_label( $type, 'preset2' ),
			'image'    => TM_Renovation_Preset::get_preset_image( $type, 'preset2' ),
			'settings' => TM_Renovation_Preset::get_preset_settings( $type, 'preset2' ),
		),
		'3' => array(
			'label'    => TM_Renovation_Preset::get_preset_label( $type, 'preset3' ),
			'image'    => TM_Renovation_Preset::get_preset_image( $type, 'preset3' ),
			'settings' => TM_Renovation_Preset::get_preset_settings( $type, 'preset3' ),
		),
		'4' => array(
			'label'    => TM_Renovation_Preset::get_preset_label( $type, 'preset4' ),
			'image'    => TM_Renovation_Preset::get_preset_image( $type, 'preset4' ),
			'settings' => TM_Renovation_Preset::get_preset_settings( $type, 'preset4' ),
		),
		'5' => array(
			'label'    => TM_Renovation_Preset::get_preset_label( $type, 'preset5' ),
			'image'    => TM_Renovation_Preset::get_preset_image( $type, 'preset5' ),
			'settings' => TM_Renovation_Preset::get_preset_settings( $type, 'preset5' ),
		),
	),
) );