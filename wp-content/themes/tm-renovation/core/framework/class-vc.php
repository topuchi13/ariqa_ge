<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Extend VC
 *
 * @package TM_Renovation_Framework
 * @since   3.0
 */
if ( ! class_exists( 'TM_Renovation_VC' ) ) {

	class TM_Renovation_VC {

		public function __construct() {

			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				$new_vc_dir = TM_RENOVATION_INC_DIR . '/vc-template';
				vc_set_shortcodes_templates_dir( $new_vc_dir );
			}

			add_filter( 'vc_shortcodes_css_class', array( $this, 'rewrite_class_name' ), 10, 2 );

			add_action( 'vc_after_init', array( $this, 'load_params' ) );
			add_action( 'vc_after_init', array( $this, 'load_fontlibs' ) );
			add_action( 'vc_after_init', array( $this, 'load_shortcodes' ) );
			add_action( 'vc_after_init', array( $this, 'update_shortcode_params' ) );
		}

		/**
		 * Rewrite Visual Composer  Classes
		 */
		public function rewrite_class_name( $class_string, $tag ) {

			if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
				$class_string = str_replace( 'vc_row-fluid', 'row', $class_string );
			}
			if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
				$class_string = preg_replace( '/vc_col-xs-(\d{1,2})/', 'col-xs-$1', $class_string );
				$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string );
				$class_string = preg_replace( '/vc_col-md-(\d{1,2})/', 'col-md-$1', $class_string );
				$class_string = preg_replace( '/vc_col-lg-(\d{1,2})/', 'col-lg-$1', $class_string );
			}

			return $class_string;
		}

		/**
		 * Load VC Params
		 */
		public function load_params() {
			require_once TM_RENOVATION_INC_DIR . '/vc-params/thememove-responsive/thememove_responsive.php';
		}

		/**
		 * Load VC icon font libraries
		 */
		public function load_fontlibs() {
			require_once TM_RENOVATION_INC_DIR . '/fontlibs/pe7stroke.php';
			require_once TM_RENOVATION_INC_DIR . '/fontlibs/renovation.php';
		}

		/**
		 * Load shortcode
		 */
		public function load_shortcodes() {

			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-blog.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-button.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-recentposts.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-gmaps.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-gmaps2.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-icon.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-testimonials.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-project-details.php';
			require_once TM_RENOVATION_INC_DIR . '/vc-shortcode/thememove-project-share.php';
		}

		/**
		 * Update param for shortcodes
		 */
		public function update_shortcode_params() {

			if ( function_exists( 'vc_update_shortcode_param' ) ) {

				// remove accent_color param of Cost Calculator
				vc_remove_param( 'bt_cost_calculator', 'accent_color' );

				/* Custom Heading */
				vc_update_shortcode_param( 'vc_custom_heading', array(
					'param_name' => 'use_theme_fonts',
					'std'        => 'yes',
				) );

				/* Tab */
				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Renovation | by Renovation', 'tm-renovation' ) => 'renovation',
						esc_html__( 'Classic', 'tm-renovation' )                    => 'classic',
						esc_html__( 'Modern', 'tm-renovation' )                     => 'modern',
						esc_html__( 'Flat', 'tm-renovation' )                       => 'flat',
						esc_html__( 'Outline', 'tm-renovation' )                    => 'outline',
					),
				) );

				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'spacing',
					'std'        => '0',
				) );

				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'shape',
					'std'        => 'square',
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'robin' ),
					),
				) );

				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'color',
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'robin' ),
					),
				) );

				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'no_fill_content_area',
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array( 'robin' ),
					),
				) );

				vc_update_shortcode_param( 'vc_tta_tabs', array(
					'param_name' => 'no_fill_content_area',
					'std'        => 'true',
				) );
			}
		}

		/**
		 * Get Taxonomy for Auto-Complete Params
		 *
		 * @return array
		 */
		static function get_taxonomy_for_autocomplete() {
			$record_set = array();

			$categories = get_categories();
			foreach ( $categories as $category ) {
				$cat_arr          = array();
				$cat_arr['label'] = $category->cat_name;
				$cat_arr['value'] = $category->cat_ID;
				$cat_arr['group'] = 'CATEGORY';

				$record_set[] = $cat_arr;
			}

			$tags = get_tags();
			foreach ( $tags as $tag ) {
				$tag_arr          = array();
				$tag_arr['label'] = $tag->name;
				$tag_arr['value'] = $tag->term_id;
				$tag_arr['group'] = 'TAG';

				$record_set[] = $tag_arr;
			}

			return $record_set;
		}
	}

	new TM_Renovation_VC();
}