<?php
/**
 * ThemeMove Project Share Buttons Shortcode
 * @version 1.0
 * @package ThemeMove
 */
class WPBakeryShortCode_Thememove_Project_Share extends WPBakeryShortCode
{
}

// Mapping shortcode
vc_map(array(
	'name'        => esc_html__('Project Share Buttons', 'tm-renovation'),
	'description' => esc_html__('Only available for Projects.', 'tm-renovation'),
	'base'        => 'thememove_project_share',
	'category'    => esc_html__('by THEMEMOVE', 'tm-renovation'),
	'show_settings_on_create' => false,
	'params'      => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'tm-renovation'),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'tm-renovation'),
		),
	)
));