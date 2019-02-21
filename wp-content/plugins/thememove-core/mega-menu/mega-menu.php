<?php

if ( ! defined( 'TM_MEGA_MENU_SLUG' ) ) {
	define( 'TM_MEGA_MENU_POST_TYPE', 'tm_mega_menu' );
}

require_once( trailingslashit( dirname( __FILE__ ) ) . 'class-tm-walker-nav-menu.php' );

class ThemeMove_Mega_Menu {

	public function __construct() {
		$this->tm_mega_menu_hooks();
	}

	function tm_mega_menu_hooks() {
		add_action( 'init', array( $this, 'tm_mega_menu_register_post_type' ), 0 );
		add_action( 'wp_head', array( $this, 'tm_mega_menu_generate_vc_custom_css' ), 999 );
		add_action( 'admin_footer', array( $this, 'tm_mega_menu_remove_vc_frontend_editor' ) );
		add_action( 'admin_bar_menu', array( $this, 'tm_mega_menu_remove_wp_bar_view' ), 999 );

		add_filter( 'post_row_actions', array( $this, 'tm_mega_menu_remove_row_actions' ), 999, 2 );
	}

	function tm_mega_menu_remove_vc_frontend_editor() {
		?>
		<style type="text/css">
			.post-type-tm_mega_menu .wpb_switch-to-front-composer {
				display: none;
			}
		</style>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				setTimeout(function () {
					$('.post-type-tm_mega_menu .wpb_switch-to-front-composer').remove();
					$('.post-type-tm_mega_menu .wpb_switch-to-composer').next('.vc_spacer').remove();
				}, 50);
			});
		</script>
		<?php
	}

	function tm_mega_menu_register_post_type() {

		$labels = array(
			'name'               => _x( 'Mega Menus', 'Post Type General Name', 'tm-core' ),
			'singular_name'      => _x( 'Mega Menu', 'Post Type Singular Name', 'tm-core' ),
			'menu_name'          => __( 'Mega Menu', 'tm-core' ),
			'name_admin_bar'     => __( 'Mega Menu', 'tm-core' ),
			'parent_item_colon'  => __( 'Parent Menu:', 'tm-core' ),
			'all_items'          => __( 'All Menus', 'tm-core' ),
			'add_new_item'       => __( 'Add New Menu', 'tm-core' ),
			'add_new'            => __( 'Add New', 'tm-core' ),
			'new_item'           => __( 'New Menu', 'tm-core' ),
			'edit_item'          => __( 'Edit Menu', 'tm-core' ),
			'update_item'        => __( 'Update Menu', 'tm-core' ),
			'view_item'          => __( 'View Menu', 'tm-core' ),
			'search_items'       => __( 'Search Menu', 'tm-core' ),
			'not_found'          => __( 'Not found', 'tm-core' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'tm-core' ),
		);
		$args   = array(
			'label'               => __( TM_MEGA_MENU_POST_TYPE, 'tm-core' ),
			'description'         => __( 'ThemeMove Mega Menu', 'tm-core' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-list-view',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'page',
		);
		register_post_type( TM_MEGA_MENU_POST_TYPE, $args );

	}

	function tm_mega_menu_remove_row_actions( $actions ) {

		if ( get_post_type() == TM_MEGA_MENU_POST_TYPE ) {
			unset ( $actions['inline hide-if-no-js'] );
			unset ( $actions['view'] );
			unset ( $actions['edit_vc'] );
		}

		return $actions;
	}

	function tm_mega_menu_remove_wp_bar_view( $wp_admin_bar ) {
		if ( get_post_type() == TM_MEGA_MENU_POST_TYPE ) {
			$wp_admin_bar->remove_node( 'view' );
		}
	}

	function tm_mega_menu_generate_vc_custom_css() {

		$locations = get_nav_menu_locations();

		foreach ( $locations as $location ) {
			$menu = wp_get_nav_menu_object( $location );

			if ( is_object( $menu ) ) {

				$nav_items = wp_get_nav_menu_items( $menu->term_id );
				$mega_menu_ids = array();

				foreach ( (array) $nav_items as $nav_item ) {
					if ( TM_MEGA_MENU_POST_TYPE == $nav_item->object ) {
						$mega_menu_ids[] = $nav_item->object_id;
					}
				}

				if ( ! empty( $mega_menu_ids ) ) {
					$post_custom_css_array       = array();
					$shortcodes_custom_css_array = array();

					foreach ( $mega_menu_ids as $mega_menu_id ) {
						$post_custom_css = get_post_meta( $mega_menu_id, '_wpb_post_custom_css', true );
						if ( ! empty( $post_custom_css ) ) {
							$post_custom_css_array[] = $post_custom_css;
						}

						$shortcodes_custom_css = get_post_meta( $mega_menu_id, '_wpb_shortcodes_custom_css', true );
						if ( ! empty( $shortcodes_custom_css ) ) {
							$shortcodes_custom_css_array[] = $shortcodes_custom_css;
						}
					}

					if ( ! empty( $post_custom_css_array ) ) {
						echo '<style type="text/css" data-type="vc_custom-css">';
						echo implode( '', $post_custom_css_array );
						echo '</style>';
					}

					if ( ! empty( $shortcodes_custom_css_array ) ) {
						echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
						echo implode( '', $shortcodes_custom_css_array );
						echo '</style>';
					}
				}
			}
		}
	}
}

new ThemeMove_Mega_Menu();