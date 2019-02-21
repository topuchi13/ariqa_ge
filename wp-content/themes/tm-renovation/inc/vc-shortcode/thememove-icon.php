<?php

class WPBakeryShortCode_Thememove_Icon extends WPBakeryShortCode {
}

vc_map(array(
	'name' => esc_html__('Icon', 'tm-renovation'),
	'base' => 'thememove_icon',
	'category' => esc_html__('by THEMEMOVE', 'tm-renovation'),
	'js_view' => 'VcIconElementView_Backend',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon library', 'tm-renovation'),
			'admin_label' => true,
			'value' => array(
				esc_html__('Font Awesome', 'tm-renovation') => 'fontawesome',
				esc_html__('Open Iconic', 'tm-renovation') => 'openiconic',
				esc_html__('Typicons', 'tm-renovation') => 'typicons',
				esc_html__('Entypo', 'tm-renovation') => 'entypo',
				esc_html__('Linecons', 'tm-renovation') => 'linecons',
				esc_html__('P7 Stroke', 'tm-renovation') => 'pe7stroke',
				esc_html__('Renovation', 'tm-renovation') => 'renovation',
			),
			'param_name' => 'type',
			'description' => esc_html__('Select icon library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'fontawesome',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'openiconic',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'openiconic',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'typicons',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'typicons',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'entypo',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'entypo',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'linecons',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'linecons',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_pe7stroke',
			'value' => 'pe-7s-album',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'pe7stroke',
				'iconsPerPage' => 400,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'pe7stroke',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'tm-renovation'),
			'param_name' => 'icon_renovation',
			'value' => '',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'renovation',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'renovation',
			),
			'description' => esc_html__('Select icon from library.', 'tm-renovation'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font size', 'tm-renovation'),
			'param_name' => 'font_size',
			'value' => '25',
			'description' => esc_html__('Enter font size', 'tm-renovation'),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'tm-renovation'),
			'param_name' => 'font_color',
			'value' => PRIMARY_COLOR,
			'description' => esc_html__('Select icon color.', 'tm-renovation'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'tm-renovation'),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'tm-renovation'),
		),
	)
));