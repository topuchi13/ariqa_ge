<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce functions
 *
 * @package TM_Renovation_Framework
 * @since   3.0
 */
if ( ! class_exists( 'TM_Renovation_Project' ) ) {

	class TM_Renovation_Project {

		function __construct() {

			// Remove admin notification of Projects
			global $projects;
			remove_action( 'admin_notices', array( $projects->admin, 'configuration_admin_notice' ) );

			add_filter( 'projects_custom_fields', array( $this, 'new_projects_fields' ) );

			//remove default style
			add_filter( 'projects_enqueue_styles', '__return_false' );

			add_filter( 'projects_loop_columns', array( $this, 'project_loop_columns' ) );
		}


		function new_projects_fields( $fields ) {

			$fields['location'] = array(
				'name'        => esc_html__( 'Location', 'tm-renovation' ),
				'description' => esc_html__( 'Enter a location for this project.', 'tm-renovation' ),
				'type'        => 'text',
				'default'     => '',
				'section'     => 'info',
			);

			$fields['date_completed'] = array(
				'name'        => esc_html__( 'Date Completed', 'tm-renovation' ),
				'description' => esc_html__( 'Enter a date Completed for this project.', 'tm-renovation' ),
				'type'        => 'text',
				'default'     => '',
				'section'     => 'info',
			);

			$fields['value'] = array(
				'name'        => esc_html__( 'Value', 'tm-renovation' ),
				'description' => esc_html__( 'Enter a value for this project.', 'tm-renovation' ),
				'type'        => 'text',
				'default'     => '',
				'section'     => 'info',
			);

			if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
				$pt_array = ( $pt_array = get_option( 'wpb_js_content_types' ) ) ? ( $pt_array ) : vc_default_editor_post_types(); // post type array
				if ( in_array( 'project', $pt_array ) ) {
					$fields['use_vc'] = array(
						'name'        => esc_html__( 'Use Visual Composer', 'tm-renovation' ),
						'description' => esc_html__( 'Use Visual Composer for this project', 'tm-renovation' ),
						'type'        => 'checkbox',
						'default'     => 'no',
						'section'     => 'info',
					);
				}
			} else {

				// Update user roles
				$pt_array[] = 'project';
				$user_roles = get_option( 'wp_user_roles' );
				update_option( 'wpb_js_content_types', $pt_array );

				if ( ! empty( $user_roles ) ) {
					foreach ( $user_roles as $key => $value ) {
						$user_roles[ $key ]['capabilities']['vc_access_rules_post_types']              = 'custom';
						$user_roles[ $key ]['capabilities']['vc_access_rules_post_types/page']         = true;
						$user_roles[ $key ]['capabilities']['vc_access_rules_post_types/tm_mega_menu'] = true;
						$user_roles[ $key ]['capabilities']['vc_access_rules_post_types/project']      = true;
					}
				}
			}

			return $fields;
		}

		function project_loop_columns() {
			return 3; // 3 projects per row
		}
	}

	new TM_Renovation_Project();
}