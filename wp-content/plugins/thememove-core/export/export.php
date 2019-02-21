<?php
if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! WP_DEBUG && ( ! isset( $_GET['debug'] ) || 'true' != $_GET['debug'] ) ) {
	return;
}

class ThemeMove_Export {

	function __construct() {
		add_action( 'admin_menu', array( &$this, 'thememove_admin_export' ) );

		add_filter( 'export_wp_filename', array( &$this, 'thememove_export_wp_filename' ) );
	}

	function init_thememove_export() {
		if ( isset( $_REQUEST['export_option'] ) ) {
			$export_option = $_REQUEST['export_option'];

			switch ( $export_option ) {
				case 'content':
					$this->export_content();
					break;
				case 'sidebars':
					$this->export_sidebars();
					break;
				case 'widgets':
					$this->export_widgets();
					break;
				case 'thememove_menus':
					$this->export_thememove_menus();
					break;
				case 'page_options':
					$this->export_page_options();
					break;
				case 'customizer_options':
					$this->export_customizer_options();
					break;
				case 'woocommerce':
					if ( class_exists( 'WooCommerce' ) ) {
						$this->export_woocommerce();
					}
					break;
				case 'isw':
					if ( class_exists( 'WooCommerce' ) && class_exists('Insight_Attribute_Swatches') ) {
						$this->export_insight_attribute_swatches();
					}
					break;
				case 'essential_grid':
					if ( class_exists( 'Essential_Grid' ) ) {
						$this->export_essential_grid();
					}
					break;
				case 'rev_sliders':
					if ( class_exists( 'RevSliderAdmin' ) ) {
						$this->export_rev_sliders();
					}
					break;
				case 'media_package':
					if ( class_exists( 'RevSliderAdmin' ) ) {
						$this->export_media_packages();
					}
					break;
				default:
					break;
			}
		}
	}

	function thememove_admin_export() {
		if ( isset( $_REQUEST['export'] ) ) {
			$this->init_thememove_export();
		}

		add_menu_page( 'ThemeMove Theme', esc_html__( 'ThemeMove Export', 'tm-core' ), 'manage_options', 'thememove_options_export_page', array(
			&$this,
			'thememove_generate_export_page'
		) );
	}

	function thememove_generate_export_page() {
		include_once( untrailingslashit( plugin_dir_path( __FILE__ ) . 'export-page.php' ) );
	}

	function thememove_export_wp_filename() {
		return 'content.xml';
	}

	function save_as_txt_file( $file_name, $output ) {
		header( "Content-type: application/text", true, 200 );
		header( "Content-Disposition: attachment; filename=$file_name" );
		header( "Pragma: no-cache" );
		header( "Expires: 0" );
		echo $output;
		exit;
	}

	function available_widgets() {
		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[ $widget['id_base'] ] ) ) { // no dupes

				$available_widgets[ $widget['id_base'] ]['id_base'] = $widget['id_base'];
				$available_widgets[ $widget['id_base'] ]['name']    = $widget['name'];

			}

		}

		return $available_widgets;
	}

	function export_content() {

		require_once( ABSPATH . 'wp-admin/includes/export.php' );

		$args = array();

		$args['content'] = 'all';

		export_wp( $args );
	}

	function export_customizer_options() {

		$options = get_theme_mods();
		unset( $options['nav_menu_locations'] );

		$this->save_as_txt_file( 'customizer.txt', serialize( $options ) );
	}

	function export_sidebars() {

		$sidebars = json_encode( get_option( 'kungfu_sidebars', '' ) );

		$this->save_as_txt_file( 'sidebars.txt', $sidebars );
	}

	function export_widgets() {

		// Get all available widgets site supportsss
		$available_widgets = $this->available_widgets();

		// Get all widget instances for each widget
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {

			// Get all instances for this ID base
			$instances = get_option( 'widget_' . $widget_data['id_base'] );

			// Have instances
			if ( ! empty( $instances ) ) {

				// Loop instances
				foreach ( $instances as $instance_id => $instance_data ) {

					// Key is ID (not _multiwidget)
					if ( is_numeric( $instance_id ) ) {
						$unique_instance_id                      = $widget_data['id_base'] . '-' . $instance_id;
						$widget_instances[ $unique_instance_id ] = $instance_data;
					}

				}

			}

		}


		// Gather sidebars with their widget instances
		$sidebars_widgets          = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
		$sidebars_widget_instances = array();
		foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {

			// Skip inactive widgets
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Skip if no data or not an array (array_version)
			if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
				continue;
			}

			// Loop widget IDs for this sidebar
			foreach ( $widget_ids as $widget_id ) {

				// Is there an instance for this widget ID?
				if ( isset( $widget_instances[ $widget_id ] ) ) {

					// Add to array
					$sidebars_widget_instances[ $sidebar_id ][ $widget_id ] = $widget_instances[ $widget_id ];

				}

			}

		}

		$data = json_encode( $sidebars_widget_instances );

		$this->save_as_txt_file( 'widgets.txt', $data );
	}

	function export_thememove_menus() {
		global $wpdb;

		$this->data = array();
		$locations  = get_nav_menu_locations();

		$terms_table = $wpdb->prefix . "terms";
		foreach ( (array) $locations as $location => $menu_id ) {
			$menu_slug = $wpdb->get_results( "SELECT * FROM $terms_table where term_id={$menu_id}", ARRAY_A );
			if ( ! empty( $menu_slug ) ) {
				$this->data[ $location ] = $menu_slug[0]['slug'];
			}
		}

		$output = serialize( $this->data );
		$this->save_as_txt_file( "menus.txt", $output );
	}

	function export_page_options() {
		$thememove_show_on_front = get_option( "show_on_front" );

		$thememove_settings_pages = array(
			'show_on_front' => $thememove_show_on_front,
		);

		if ( $static_page_id = get_option( "page_on_front" ) ) {
			$thememove_static_page                     = get_post( $static_page_id );
			$thememove_settings_pages['page_on_front'] = $thememove_static_page->post_title;
		}

		if ( $post_page_id = get_option( 'page_for_posts' ) ) {
			$thememove_post_page                        = get_post( $post_page_id );
			$thememove_settings_pages['page_for_posts'] = $thememove_post_page->post_title;
		}

		$output = serialize( $thememove_settings_pages );

		$this->save_as_txt_file( "page_options.txt", $output );
	}

	function export_woocommerce() {
		$data = array(
			'images' => array(
				'catalog'   => wc_get_image_size( 'shop_catalog' ),
				'thumbnail' => wc_get_image_size( 'shop_thumbnail' ),
				'single'    => wc_get_image_size( 'shop_single' ),
			),
		);

		$output = serialize( $data );

		$this->save_as_txt_file( 'woocommerce.txt', $output );
	}

	function export_insight_attribute_swatches() {
		$settings = get_option( 'isw_settings', '' );

		$this->save_as_txt_file( 'attribute_swatches.txt', serialize( $settings ) );
	}

	function export_essential_grid() {

		require_once( ABSPATH . 'wp-content/plugins/essential-grid/essential-grid.php' );

		$c_grids   = new Essential_Grid();
		$item_skin = new Essential_Grid_Item_Skin();
		$item_ele  = new Essential_Grid_Item_Element();
		$nav_skin  = new Essential_Grid_Navigation();
		$metas     = new Essential_Grid_Meta();
		$fonts     = new ThemePunch_Fonts();

		$grids            = $c_grids->get_essential_grids();
		$skins            = $item_skin->get_essential_item_skins();
		$elements         = $item_ele->get_essential_item_elements();
		$navigation_skins = $nav_skin->get_essential_navigation_skins();
		$custom_metas     = $metas->get_all_meta();
		$custom_fonts     = $fonts->get_all_fonts();

		header( 'Content-Type: text/json' );
		header( 'Content-Disposition: attachment;filename=essential_grid.txt' );
		ob_start();

		$export = array();

		$ex = new Essential_Grid_Export();

		//export Grids
		if ( ! empty( $grids ) ) {
			$export['grids'] = $grids;
		}

		//export Skins
		if ( ! empty( $skins ) ) {
			$export['skins'] = $skins;
		}

		//export Elements
		if ( ! empty( $elements ) ) {
			$export['elements'] = $elements;
		}

		//export Navigation Skins
		if ( ! empty( $navigation_skins ) ) {
			$export['navigation-skins'] = $navigation_skins;
		}

		//export Custom Meta
		if ( ! empty( $custom_metas ) ) {
			$export['custom-meta'] = $custom_metas;
		}

		//export Punch Fonts
		if ( ! empty( $custom_fonts ) ) {
			$export['punch-fonts'] = $custom_fonts;
		}

		//export Global Styles
		$export['global-css'] = $ex->export_global_styles( 'on' );

		echo json_encode( $export );

		$content = ob_get_contents();
		ob_clean();
		ob_end_clean();

		echo $content;

		exit;
	}

	function export_rev_sliders() {
//		header( "Content-Type: application/text", true, 200 );
//		header( 'Content-Disposition: attachment; filename="rev_sliders.txt"' );

		system( 'mysqldump -u ' . DB_USER . ' -p' . DB_PASSWORD . ' ' . DB_NAME . ' > rev_sliders.txt' );

//		passthru( $cmd );

//		exit();
	}

	function export_media_packages() {

		$src = ABSPATH . '/wp-content/uploads';
		$dst = ABSPATH . '/wp-content' . DS . TM_THEME_SLUG . '-' . $_POST['demo'];

		$this->recurse_copy( $src, $dst );
	}

	function recurse_copy( $src, $dst ) {

		if ( is_dir( $src ) ) {

			$dir = opendir( $src );

			if ( ! is_dir( $dst ) ) {
				@mkdir( $dst );
			}

			while ( false !== ( $file = readdir( $dir ) ) ) {
				if ( ( $file != '.' ) && ( $file != '..' ) ) {
					if ( is_dir( $src . '/' . $file ) ) {
						$this->recurse_copy( $src . '/' . $file, $dst . '/' . $file );
					} else {
						if ( false == preg_match( '/-\d{1,}x\d{1,}+\.\w{3,}$/', $file ) ) {
							copy( $src . '/' . $file, $dst . '/' . $file );
						}
					}
				}
			}
			closedir( $dir );
		}

	}
}

new ThemeMove_Export();