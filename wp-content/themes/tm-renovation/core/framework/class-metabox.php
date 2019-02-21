<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * nclude and setup custom metaboxes and fields.
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Metabox' ) ) {

	class TM_Renovation_Metabox {

		function __construct() {

			add_filter( 'infinity_page_meta_box_presets', array( $this, 'page_meta_box_presets' ) );

			add_filter( 'cmb2_meta_boxes', array( $this, 'page_metabox' ) );

		}

		function page_meta_box_presets( $presets ) {
			$presets[] = 'site_preset';

			return $presets;
		}

		/**
		 * Define the metabox and field configurations.
		 *
		 * @param  array $meta_boxes
		 *
		 * @return array
		 */
		function page_metabox( array $meta_boxes ) {

			// Start with an underscore to hide fields from custom fields list
			$prefix = 'infinity_';

			/**
			 * Sample metabox to demonstrate each field type included
			 */
			$fields = array(
				// Sticky Header
				array(
					'name'    => esc_html__( 'Sticky Menu', 'tm-renovation' ),
					'desc'    => esc_html__( 'Custom settings for sticky menu', 'tm-renovation' ),
					'id'      => $prefix . 'sticky_menu',
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'tm-renovation' ),
						'enable'  => esc_html__( 'Enable', 'tm-renovation' ),
						'disable' => esc_html__( 'Disable', 'tm-renovation' ),
					),
				),
				// Bread Crumb Enable
				array(
					'name'    => esc_html__( 'Enable Breadcrumb', 'tm-renovation' ),
					'desc'    => esc_html__( 'Custom settings for breadcrumb', 'tm-renovation' ),
					'id'      => $prefix . 'bread_crumb_enable',
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'tm-renovation' ),
						'enable'  => esc_html__( 'Enable', 'tm-renovation' ),
						'disable' => esc_html__( 'Disable', 'tm-renovation' ),
					),
				),
				// Custom Logo
				array(
					'name' => esc_html__( 'Custom Logo', 'tm-renovation' ),
					'desc' => esc_html__( 'Upload an image or enter a URL for logo', 'tm-renovation' ),
					'id'   => $prefix . 'custom_logo',
					'type' => 'file',
				),
				// Page Layout
				array(
					'name'    => esc_html__( 'Page Layout', 'tm-renovation' ),
					'desc'    => esc_html__( 'Choose a layout you want', 'tm-renovation' ),
					'id'      => $prefix . 'page_layout_private',
					'type'    => 'select',
					'options' => array(
						'default'         => esc_html__( 'Default', 'tm-renovation' ),
						'full-width'      => esc_html__( 'Full width', 'tm-renovation' ),
						'content-sidebar' => esc_html__( 'Content-Sidebar', 'tm-renovation' ),
						'sidebar-content' => esc_html__( 'Sidebar-Content', 'tm-renovation' ),
					),
				),
				// Disable Title
				array(
					'name' => esc_html__( 'Disable Title', 'tm-renovation' ),
					'desc' => esc_html__( 'Check this box to disable the title of the page', 'tm-renovation' ),
					'id'   => $prefix . 'disable_title',
					'type' => 'checkbox',
				),
				// Title Style
				array(
					'name'    => esc_html__( 'Title Style', 'tm-renovation' ),
					'desc'    => esc_html__( 'Choose style for the title of the page', 'tm-renovation' ),
					'id'      => $prefix . 'title_style',
					'type'    => 'select',
					'default' => 'default',
					'options' => array(
						'default'   => esc_html__( 'Default', 'tm-renovation' ),
						'image'     => esc_html__( 'Image Background', 'tm-renovation' ),
						'big-image' => esc_html__( 'Big Image Background', 'tm-renovation' ),
						'bg_color'  => esc_html__( 'Single Color Background', 'tm-renovation' ),
					),
				),
				// Image Background
				array(
					'name'    => esc_html__( 'Image Background', 'tm-renovation' ),
					'desc'    => esc_html__( 'Upload an image or enter a URL for heading title', 'tm-renovation' ),
					'default' => PAGE_HEADING_BG_IMAGE,
					'id'      => $prefix . 'heading_image',
					'type'    => 'file',
				),
				// Disable Parallax
				array(
					'name' => esc_html__( 'Disable Parallax', 'tm-renovation' ),
					'desc' => esc_html__( 'Check this box to disable parallax effect for heading title', 'tm-renovation' ),
					'id'   => $prefix . 'disable_parallax',
					'type' => 'checkbox',
				),
				// Title Background Color
				array(
					'name'    => esc_html__( 'Title Background Color', 'tm-renovation' ),
					'desc'    => esc_html__( 'Pick a background color for heading title', 'tm-renovation' ),
					'id'      => $prefix . 'heading_bg_color',
					'default' => PAGE_HEADING_BG_COLOR,
					'type'    => 'colorpicker',
				),
				// Title Color
				array(
					'name'    => esc_html__( 'Title Color', 'tm-renovation' ),
					'desc'    => esc_html__( 'Pick a color for heading title', 'tm-renovation' ),
					'id'      => $prefix . 'heading_color',
					'default' => PAGE_STYLE_HEADING_FONT_COLOR,
					'type'    => 'colorpicker',
				),
				// Alternative Title
				array(
					'name' => esc_html__( 'Alternative Title', 'tm-renovation' ),
					'desc' => esc_html__( 'Enter your alternative title here', 'tm-renovation' ),
					'id'   => $prefix . 'alt_title',
					'type' => 'textarea_small',
				),
				// Disable Comment
				array(
					'name' => esc_html__( 'Disable Comment', 'tm-renovation' ),
					'desc' => esc_html( 'Check this box to disable comment form of the page', 'tm-renovation' ),
					'id'   => $prefix . 'disable_comment',
					'type' => 'checkbox',
				),
				// Custom Class
				array(
					'name' => esc_html__( 'Custom Class', 'tm-renovation' ),
					'desc' => esc_html__( 'Enter custom class for this page', 'tm-renovation' ),
					'id'   => $prefix . 'custom_class',
					'type' => 'text',
				),
			);

			$presets           = apply_filters( 'infinity_page_meta_box_presets', array() );
			$preset_meta_boxes = array();

			if ( ! empty( $presets ) ) {
				foreach ( $presets as $preset ) {
					if ( ! empty( Kirki::$fields[ $preset ] ) && ! empty( Kirki::$fields[ $preset ]['choices'] ) ) {
						$kirki_preset = Kirki::$fields[ $preset ];
						$options      = array( 'default' => esc_html__( 'Default (inherit from Customizer)', 'tm-renovation' ) );
						$images       = array( 'default' => '/images/preset-default.png' );

						foreach ( $kirki_preset['choices'] as $preset_choice_value => $preset_choice ) {
							$options[ $preset_choice_value ] = $preset_choice['label'];
							$images[ $preset_choice_value ]  = $preset_choice['image'];
						}

						$description = esc_html__( 'If you choose \'Default\' option, then page will load settings in Customizer.', 'tm-renovation' );

						$preset_meta_boxes[] = array(
							'name'        => $kirki_preset['label'],
							'desc'        => ( isset( $kirki_preset['description'] ) ? $kirki_preset['description'] : '' ) . $description,
							'id'          => $prefix . $preset,
							'type'        => 'radio_image',
							'options'     => $options,
							'images_path' => TM_RENOVATION_URI,
							'images'      => $images,
						);
					}
				}
			}

			$reverse_preset_meta_boxes = array_reverse( $preset_meta_boxes );

			foreach ( $reverse_preset_meta_boxes as $preset_meta_box ) {
				array_unshift( $fields, $preset_meta_box );
			}

			$meta_boxes['page_metabox'] = array(
				'id'           => 'page_metabox',
				'title'        => esc_html__( 'Page Settings', 'tm-renovation' ),
				'object_types' => array( 'page' ), // Post type
				'context'      => 'normal',
				'priority'     => 'high',
				'fields'       => $fields,
			);

			return $meta_boxes;
		}

	}

	new TM_Renovation_Metabox();
}

/*
 * CMB2 Radio Image
 * */

if ( ! class_exists( 'CMB2_Radio_Image' ) ) {
	/**
	 * Class CMB2_Radio_Image
	 */
	class CMB2_Radio_Image {

		public function __construct() {
			add_action( 'cmb2_render_radio_image', array( $this, 'callback' ), 10, 5 );
			add_filter( 'cmb2_list_input_attributes', array( $this, 'attributes' ), 10, 4 );
			add_action( 'admin_head', array( $this, 'admin_head' ) );
		}

		public function callback( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
			echo $field_type_object->radio();
		}

		public function attributes( $args, $defaults, $field, $cmb ) {
			if ( $field->args['type'] == 'radio_image' && isset( $field->args['images'] ) ) {
				foreach ( $field->args['images'] as $field_id => $image ) {
					if ( $field_id == $args['value'] ) {
						$image         = trailingslashit( $field->args['images_path'] ) . $image;
						$args['label'] = '<img src="' . $image . '" alt="' . $args['value'] . '" title="' . $args['label'] . '" /><span>' . $args['label'] . '</span>';
					}
				}
			}

			return $args;
		}

		public function admin_head() {
			?>
			<style>
				.cmb-type-radio-image .cmb2-radio-list {
					display: block;
					clear: both;
					overflow: hidden;
				}

				.cmb-type-radio-image .cmb2-radio-list input[type="radio"] {
					display: none;
				}

				.cmb-type-radio-image .cmb2-radio-list li {
					display: inline-block;
					margin-bottom: 20px;
					margin-right: 15px;
				}

				.cmb-type-radio-image .cmb2-radio-list input[type="radio"] + label > img {
					border: 3px solid #eee;
					display: block;
				}

				.cmb-type-radio-image .cmb2-radio-list input[type="radio"]:checked + label > img {
					border-color: #0073ab;
				}

				.cmb-type-radio-image .cmb2-radio-list li label img {
					display: block;
					width: 100%;
				}
			</style>
			<?php
		}
	}

	new CMB2_Radio_Image();
}