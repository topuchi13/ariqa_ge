<?php

$section  = 'nav_desktop';
$priority = 1;

Kirki::add_field( 'infinity',
	array(
		'type'        => 'toggle',
		'settings'    => 'nav_sticky_enable',
		'label'       => esc_html__( 'Sticky Menu', 'tm-renovation' ),
		'description' => esc_html__( 'Turn on this option if you want to enable sticky header on your site',
			'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_STICKY_ENABLE,
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'color',
		'settings'  => 'nav_bg_menu_background',
		'label'     => esc_html__( 'Background', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => NAV_BG_MENU_BACKGROUND,
		'transport' => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'    => array(
			array(
				'element'  => TM_Renovation_Helper::text2line( '.main-navigation,
				.header02 #site-navigation .menu,
				.header02 #site-navigation .primary-menu:before' ),
				'property' => 'background-color',
			),
		),
	) );

// Menu Items
Kirki::add_field( 'infinity',
	array(
		'type'     => 'custom',
		'settings' => 'nav_typo_group_title_' . $priority ++,
		'section'  => $section,
		'priority' => $priority ++,
		'default'  => '<div class="group_title">' . esc_html__( 'Menu Items', 'tm-renovation' ) . '</div>',
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'typography',
		'settings'  => 'nav_typo_menu_font',
		'label'     => esc_html__( 'Font Settings', 'tm-renovation' ),
		'section'   => $section,
		'priority'  => $priority ++,
		'transport' => 'auto',
		'default'   => array(
			'font-family'    => NAV_TYPO_MENU_FONT_FAMILY,
			'font-size'      => NAV_TYPO_MENU_FONT_SIZE,
			'variant'        => NAV_TYPO_MENU_FONT_VARIANT,
			'line-height'    => NAV_TYPO_MENU_LINE_HEIGHT,
			'letter-spacing' => NAV_TYPO_MENU_LETTER_SPACING,
			'subsets'        => array( 'latin-ext' ),
		),
		'output'    => array(
			'element' => '#site-navigation .menu > ul > li > a, #site-navigation .menu > li > a',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'spacing',
		'label'     => esc_html__( 'Link padding', 'tm-renovation' ),
		'settings'  => 'nav_spacing_menu_text_padding',
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => array(
			'top'    => NAV_SPACING_MENU_TEXT_PADDING_TOP,
			'bottom' => NAV_SPACING_MENU_TEXT_PADDING_BOTTOM,
			'left'   => NAV_SPACING_MENU_TEXT_PADDING_LEFT,
			'right'  => NAV_SPACING_MENU_TEXT_PADDING_RIGHT,
		),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => TM_Renovation_Helper::text2line('.header01 #site-navigation .menu > ul > li > a, .header01  #site-navigation .menu > li > a,
			.header02 #site-navigation .menu > ul > li > a, .header02  #site-navigation .menu > li > a,
			.header03 #site-navigation .menu > ul > li, .header03 #site-navigation .menu > li'),
				'property' => 'padding',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_style_menu_text',
		'label'       => esc_html__( 'Link Color', 'tm-renovation' ),
		'description' => esc_html__( 'Normal State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_STYLE_MENU_TEXT,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => '#site-navigation .menu > ul > li > a, #site-navigation .menu > li > a',
				'property' => 'color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_style_menu_text_hover',
		'description' => esc_html__( 'Hover State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_STYLE_MENU_TEXT_HOVER,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => TM_Renovation_Helper::text2line( '
				#site-navigation .menu > ul > li:hover > a,
				#site-navigation .menu > ul > li.current_page_item > a,
				#site-navigation .menu > li.current-menu-item > a,
				#site-navigation .menu > li:hover > a' ),
				'property' => 'color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_bg_menu_text_bg',
		'label'       => esc_html__( 'Link Background', 'tm-renovation' ),
		'description' => esc_html__( 'Normal State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_BG_MENU_TEXT_BG,
		'transport'   => 'auto',
		'choices'     => array(
			'alpha' => true,
		),
		'output'      => array(
			array(
				'element'  => TM_Renovation_Helper::text2line( '
				#site-navigation .menu > ul > li,
				#site-navigation .menu > li' ),
				'property' => 'background-color',
			),
			array(
				'element'  => TM_Renovation_Helper::text2line( '
				.header02 #site-navigation .menu:before,
				.header02 #site-navigation .menu > ul > li:before,
				.header02 #site-navigation .menu > li:before' ),
				'property' => ( ! is_rtl() ? 'border-left-color' : 'border-right-color' ),
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_bg_menu_text_bg_hover',
		'description' => esc_html__( 'Hover State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_BG_MENU_TEXT_BG_HOVER,
		'transport'   => 'auto',
		'choices'     => array(
			'alpha' => true,
		),
		'output'      => array(
			array(
				'element'  => TM_Renovation_Helper::text2line( '
				#site-navigation .menu > ul > li.current-menu-item,
				#site-navigation .menu > li.current-menu-item,
				#site-navigation .menu > ul > li:hover,
				#site-navigation .menu > li:hover' ),
				'property' => 'background-color',
			),
			array(
				'element'  => TM_Renovation_Helper::text2line( '
				.header02 #site-navigation .menu > ul > li.current-menu-item:before,
				.header02 #site-navigation .menu > li.current-menu-item:before,
				.header02 #site-navigation .menu > ul > li:hover:before,
				.header02 #site-navigation .menu > li:hover:before' ),
				'property' => ( ! is_rtl() ? 'border-left-color' : 'border-right-color' ),
			),
		),
	) );

// Sub Items
Kirki::add_field( 'infinity',
	array(
		'type'     => 'custom',
		'settings' => 'nav_typo_group_title_' . $priority ++,
		'section'  => $section,
		'priority' => $priority ++,
		'default'  => '<div class="group_title">' . esc_html__( 'Sub Menu Items', 'tm-renovation' ) . '</div>',
	) );

Kirki::add_field( 'infinity',
	array(
		'type'     => 'typography',
		'settings' => 'nav_typo_sub_menu_font',
		'label'    => esc_html__( 'Font Settings', 'tm-renovation' ),
		'section'  => $section,
		'priority' => $priority ++,
		'default'  => array(
			'font-family'    => NAV_TYPO_SUB_MENU_FONT_FAMILY,
			'font-size'      => NAV_TYPO_SUB_MENU_FONT_SIZE,
			'variant'        => NAV_TYPO_SUB_MENU_FONT_VARIANT,
			'line-height'    => NAV_TYPO_SUB_MENU_LINE_HEIGHT,
			'letter-spacing' => NAV_TYPO_SUB_MENU_LETTER_SPACING,
		),
		'output'   => array(
			'element' => '#site-navigation .sub-menu,#site-navigation .children',
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'      => 'spacing',
		'label'     => esc_html__( 'Link padding', 'tm-renovation' ),
		'settings'  => 'nav_spacing_sub_menu_text_padding',
		'section'   => $section,
		'priority'  => $priority ++,
		'default'   => array(
			'top'    => NAV_SPACING_SUB_MENU_TEXT_PADDING_TOP,
			'bottom' => NAV_SPACING_SUB_MENU_TEXT_PADDING_BOTTOM,
			'left'   => NAV_SPACING_SUB_MENU_TEXT_PADDING_LEFT,
			'right'  => NAV_SPACING_SUB_MENU_TEXT_PADDING_RIGHT,
		),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '#site-navigation .sub-menu li > a, #site-navigation .children li > a',
				'property' => 'padding',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_style_sub_menu_text',
		'label'       => esc_html__( 'Link Color', 'tm-renovation' ),
		'description' => esc_html__( 'Normal State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_STYLE_SUB_MENU_TEXT,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => '#site-navigation .sub-menu li a, #site-navigation .children li a',
				'property' => 'color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_style_sub_menu_text_hover',
		'description' => esc_html__( 'Hover State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_STYLE_SUB_MENU_TEXT_HOVER,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => '#site-navigation .sub-menu li:hover > a, #site-navigation .children li:hover > a',
				'property' => 'color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_bg_sub_menu_text_bg',
		'label'       => esc_html__( 'Link Background', 'tm-renovation' ),
		'description' => esc_html__( 'Normal State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_BG_SUB_MENU_TEXT_BG,
		'transport'   => 'auto',
		'choices'     => array(
			'alpha' => true,
		),
		'output'      => array(
			array(
				'element'  => '#site-navigation .sub-menu li, #site-navigation .children li',
				'property' => 'background-color',
			),
		),
	) );

Kirki::add_field( 'infinity',
	array(
		'type'        => 'color',
		'settings'    => 'nav_bg_sub_menu_text_bg_hover',
		'description' => esc_html__( 'Hover State', 'tm-renovation' ),
		'section'     => $section,
		'priority'    => $priority ++,
		'default'     => NAV_BG_SUB_MENU_TEXT_BG_HOVER,
		'transport'   => 'auto',
		'choices'     => array(
			'alpha' => true,
		),
		'output'      => array(
			array(
				'element'  => '#site-navigation .sub-menu li:hover, #site-navigation .children li:hover',
				'property' => 'background-color',
			),
		),
	) );