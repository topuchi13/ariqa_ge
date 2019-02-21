<?php
define( 'TM_IMPORT_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
define( 'TM_IMPORT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class ThemeMove_Import {
	public $demos = array();
	public $dummies = array();
	public $dummy;
	public $style = array();
	public $support = array();
	public $generate_thumb = false;

	private $response = array();
	private $process = array();
	private $importer;
	private $file_path;
	private $_cpath;

	public function __construct() {

		$this->response  = array( 'status' => 'fail', 'message' => '' );
		$this->file_path = get_template_directory() . DS . 'inc' . DS . 'import' . DS . 'files' . DS;
		$this->_cpath    = ABSPATH . 'wp-content' . DS;

		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'init', array( $this, 'init' ) );

		// AJAX Import
		add_action( 'wp_ajax_import_dummy', array( $this, 'import_dummy' ) );
	}

	public function init() {
		$this->demos          = apply_filters( 'thememove_import_demos', array() );
		$this->dummies        = apply_filters( 'thememove_import_dummies', array() );
		$this->style          = apply_filters( 'thememove_import_style', array(
			'title_color'  => '#222222',
			'link_color'   => '#337ab7',
			'notice_color' => '#00BF50',
			'logo'         => ''
		) );
		$this->support        = apply_filters( 'thememove_import_support', array(
			'name'       => 'ThemeMove',
			'author_url' => 'http://themeforest.net/user/thememove/portfolio',
			'url'        => 'http://support.thememove.com',
			'text'       => 'support.thememove.com',
		) );
		$this->generate_thumb = apply_filters( 'thememove_import_generate_thumb', false );
	}

	public function register_menu() {
		add_menu_page( TM_THEME_NAME . ' Theme', esc_html__( TM_THEME_NAME . ' Import', 'thememove' ), 'manage_options', 'tm_import_page', array(
			&$this,
			'register_page'
		), 'dashicons-download' );
	}

	public function register_page() {
		$demos          = $this->demos;
		$dummies        = $this->dummies;
		$style          = $this->style;
		$support        = $this->support;
		$generate_thumb = $this->generate_thumb;

		include( TM_IMPORT_PATH . DS . 'import-page.php' );
	}

	public function enqueue_scripts() {
		$screen = get_current_screen();

		$args = array(
			'ajax' => admin_url( 'admin-ajax.php' )
		);


		if ( $screen->id == 'toplevel_page_tm_import_page' ) {
			wp_enqueue_style( 'tm_import_css', TM_IMPORT_URL . '/assets/css/import.css', array(), TM_CORE_VERSION );
			wp_enqueue_script( 'tm_import_js', TM_IMPORT_URL . '/assets/js/import.js', array(), TM_CORE_VERSION );

			wp_localize_script( 'tm_import_js', 'tm_import_vars', $args );
		}
	}

	public function import_dummy() {
		if ( ! empty( $_GET['dummy'] ) ) {

			$this->dummy = sanitize_text_field( $_GET['dummy'] );

			if ( ! $this->is_valid_dummy_slug( $this->dummy ) ) {
				$this->send_fail_msg( esc_html__( 'Wrong dummy name', 'tm-core' ) );
			}

			$this->process = explode( ',', $this->dummies[ $this->dummy ]['process'] );

			$this->load_importers();

			if ( $this->need_process( 'media' ) ) {
				if ( ! $this->importer->check_writeable() ) {
					$this->send_fail_msg( wp_kses( __( 'Could not write files into directory: <strong>%swp-content</strong>', 'tm-core' ),
						array(
							'strong' => array()
						)
					),
						str_replace( '\\', '/', ABSPATH ) );
				}

				$_tmppath = $this->_cpath . TM_THEME_SLUG . '-' . $this->dummy . '_tmp';

				// START DOWNLOAD IMAGES
				$this->importer->download_package( $_tmppath );
				//  FINISH DOWNLOAD AND UNPACKAGE
				$this->importer->unpackage( $this->_cpath, $_tmppath );
			}

			if ( $this->need_process( 'woocommerce' ) ) {
				$this->importer->import_woocommerce_image_sizes();
			}

			if ( $this->need_process( 'xml' ) ) {
				$this->import_xml();
			}

			if ( $this->need_process( 'home' ) ) {
				$this->importer->import_page_options();
			}

			if ( $this->need_process( 'sidebars' ) ) {
				$this->importer->import_sidebars();
			}

			if ( $this->need_process( 'widgets' ) ) {
				$this->importer->import_widgets();
			}

			if ( $this->need_process( 'menus' ) ) {
				$this->importer->import_menus();
			}

			if ( $this->need_process( 'customizer' ) ) {
				$this->importer->import_customizer_options();
			}

			if ( $this->need_process( 'woocommerce' ) ) {
				$this->importer->import_woocommerce_pages();
			}

			if ( $this->need_process( 'attribute_swatches' ) ) {
				$this->importer->import_attribute_swatches();
			}

			if ( $this->need_process( 'essential_grid' ) ) {
				$this->importer->import_essential_grid();
				$this->importer->fix_essential_grid();
			}

			if ( $this->need_process( 'sliders' ) ) {
				$this->importer->import_rev_sliders();
			}

			$this->send_success_msg( esc_html__( 'Import is successful!', 'tm-core' ) );

		} else {
			$this->send_fail_msg( esc_html__( 'Wrong dummy name', 'tm-core' ) );
		}

		$this->send_response();
	}

	private function need_process( $process ) {
		return in_array( $process, $this->process );
	}

	private function load_importers() {

		require_once( dirname( __FILE__ ) . '/thememove.importer.php' );

		// Load Importer API
		if ( class_exists( 'TM_WP_Importer' ) ) {
			$this->importer                 = new TM_WP_Importer( false );
			$this->importer->generate_thumb = $this->generate_thumb;
		} else {
			$this->send_fail_msg( esc_html__( 'Can\'t find TM_WP_Importer class', 'tm-core' ) );
		}
	}

	private function import_xml() {

		$file = $this->get_file_to_import( 'content.xml' );

		if ( ! $file ) {
			$this->send_fail_msg( sprintf(
				wp_kses( __( 'File does not exist: <strong>%s/content.xml</strong>', 'tm-core' ),
					array( 'strong' => array() )
				),
				$this->dummy
			) );
		}

		try {
			$this->importer->import( $file );
		} catch ( Exception $ex ) {
			$this->_send_fail_msg( esc_html__( 'Error while importing', 'tm-core' ) );

			if ( WP_DEBUG || ( isset( $_GET['debug'] ) && $_GET['debug'] == 'true' ) ) {
				var_dump( $ex );
			}
		}
	}

	private function get_file_to_import( $filename ) {

		$file = $this->file_path . $this->dummy . DS . $filename;

		if ( ! file_exists( $file ) ) {
			return false;
		}

		return $file;
	}

	private function send_response() {

		if ( ! empty( $this->response ) ) {
			wp_send_json( $this->response );
		} else {
			wp_send_json( array( 'message' => 'empty response' ) );
		}
	}

	private function send_success_msg( $msg ) {

		$this->send_msg( 'success', $msg );

	}


	private function send_fail_msg( $msg ) {

		$this->send_msg( 'fail', $msg );

	}

	private function send_msg( $status, $message ) {
		$this->response = array(
			'status'  => $status,
			'message' => $message
		);

		$this->send_response();
	}

	private function is_valid_dummy_slug( $dummy ) {
		return in_array( $dummy, array_keys( $this->dummies ) );
	}
}

new ThemeMove_Import();