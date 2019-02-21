<?php

/**
 * Testimonials shortcode
 *
 * @version 1.0
 * @package ThemeMove
 */
class WPBakeryShortCode_Thememove_Testimonials extends WPBakeryShortCode {

}

// Mapping shortcode
vc_map( array(
	        'name'                      => 'Testimonials',
	        'base'                      => 'thememove_testimonials',
	        'category'                  => 'by THEMEMOVE',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'type'       => 'checkbox',
			        'heading'    => esc_html__( 'Enable Carousel', 'tm-renovation' ),
			        'param_name' => 'enable_carousel',
			        'value'      => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'std'        => 'yes',
		        ),
		        array(
			        'type'       => 'checkbox',
			        'heading'    => esc_html__( 'Show Bullets', 'tm-renovation' ),
			        'param_name' => 'display_bullets',
			        'value'      => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'dependency' => array( 'element' => 'enable_carousel', 'not_empty' => true ),
			        'std'        => 'yes',
		        ),
		        array(
			        'type'       => 'checkbox',
			        'heading'    => esc_html__( 'Enable Autoplay', 'tm-renovation' ),
			        'param_name' => 'enable_autoplay',
			        'value'      => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'dependency' => array( 'element' => 'enable_carousel', 'not_empty' => true ),
			        'std'        => 'yes',
		        ),
		        array(
			        'type'        => 'textfield',
			        'heading'     => esc_html__( 'Number of item per slide', 'tm-renovation' ),
			        'param_name'  => 'number_per_slide',
			        'value'       => '1',
			        'description' => esc_html__( 'Number of Testimonials per slide', 'tm-renovation' ),
			        'dependency'  => array( 'element' => 'enable_carousel', 'not_empty' => true ),
			        'std'         => 'yes',
		        ),
		        array(
			        'type'        => 'dropdown',
			        'heading'     => esc_html__( 'Style', 'tm-renovation' ),
			        'param_name'  => 'box_style',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( 'Default', 'tm-renovation' )         => '',
				        esc_html__( 'Renovation 2017', 'tm-renovation' ) => 'new2017',
			        ),
			        'description' => esc_html__( 'Select testimonial style', 'tm-renovation' ),
		        ),
		        array(
			        'type'        => 'textfield',
			        'heading'     => esc_html__( 'Total', 'tm-renovation' ),
			        'param_name'  => 'number',
			        'value'       => '',
			        'description' => esc_html__( 'Number of Testimonials', 'tm-renovation' ),
		        ),
		        array(
			        'type'        => 'dropdown',
			        'heading'     => esc_html__( 'Order by', 'tm-renovation' ),
			        'param_name'  => 'orderby',
			        'value'       => array(
				        esc_html__( 'None', 'tm-renovation' )       => 'none',
				        esc_html__( 'ID', 'tm-renovation' )         => 'ID',
				        esc_html__( 'Title', 'tm-renovation' )      => 'title',
				        esc_html__( 'Date', 'tm-renovation' )       => 'date',
				        esc_html__( 'Menu Order', 'tm-renovation' ) => 'menu_order',
			        ),
			        'description' => esc_html__( 'How to order the items ?', 'tm-renovation' ),
		        ),
		        array(
			        'type'        => 'dropdown',
			        'heading'     => esc_html__( 'Order', 'tm-renovation' ),
			        'param_name'  => 'order',
			        'value'       => array(
				        esc_html__( 'DESC', 'tm-renovation' ) => 'DESC',
				        esc_html__( 'ASC', 'tm-renovation' )  => 'ASC',
			        ),
			        'description' => esc_html__( 'How to order the items', 'tm-renovation' ),
		        ),
		        array(
			        'type'        => 'checkbox',
			        'heading'     => esc_html__( 'Show Author Info', 'tm-renovation' ),
			        'param_name'  => 'display_author',
			        'value'       => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'description' => esc_html__( 'Choose yes to show author name and byline', 'tm-renovation' ),
			        'std'         => 'yes',
		        ),
		        array(
			        'type'        => 'checkbox',
			        'heading'     => esc_html__( 'Show URL', 'tm-renovation' ),
			        'param_name'  => 'display_url',
			        'value'       => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'description' => esc_html__( 'Choose yes to show author url', 'tm-renovation' ),
			        'dependency'  => array( 'element' => 'display_author', 'not_empty' => true ),
			        'std'         => 'yes',
		        ),
		        array(
			        'type'        => 'checkbox',
			        'heading'     => esc_html__( 'Show Author Image', 'tm-renovation' ),
			        'param_name'  => 'display_avatar',
			        'value'       => array( esc_html__( 'Yes', 'tm-renovation' ) => 'yes' ),
			        'description' => esc_html__( 'Choose yes to show author avatar', 'tm-renovation' ),
			        'std'         => 'yes',
		        ),
		        array(
			        'type'       => 'textfield',
			        'heading'    => esc_html__( 'Extra class name', 'tm-renovation' ),
			        'param_name' => 'el_class',
		        ),
	        ),
        ) );