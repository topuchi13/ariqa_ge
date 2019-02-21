<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial setup for this theme
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Init' ) ) {

	class TM_Renovation_Init {

		public function __construct() {

			// Adjust the content-width.
			add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

			// Load the theme's textdomain.
			add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ) );

			// Add theme supports.
			add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );

			// Register navigation menus.
			add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );

			// Register widget areas.
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );

			// Support shortcode in widget
			add_filter( 'widget_text', 'do_shortcode' );
		}

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		public function content_width() {
			$GLOBALS['content_width'] = apply_filters( 'content_width', 640 );
		}

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 *
		 */
		public function load_theme_textdomain() {
			load_theme_textdomain( 'tm-renovation', TM_RENOVATION_DIR . '/languages' );
		}


		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function add_theme_supports() {

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
			add_theme_support( 'title-tag' );

			/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'post-thumb', 850, 500, true );
			add_image_size( 'small-thumb', 60, 40, true );
			add_image_size( 'medium-thumb', 370, 220, true );
			add_image_size( 'project-single', 1170, 600, true );
			add_image_size( 'project-archive', 600, 400, true );

			/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

			/*
			 * Enable support for Post Formats.
			 * See http://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'infinity_custom_background_args', array(
				'default-color' => '#ffffff',
				'default-image' => '',
			) ) );

			// Support woocommerce
			add_theme_support( 'woocommerce',

				array(
					// Product grid theme settings
					'product_grid'          => array(
						'default_rows'    => 3,
						'min_rows'        => 1,
						'max_rows'        => apply_filters( 'tm_renovation_shop_max_rows', 10 ),
						'default_columns' => 3,
						'min_columns'     => 3,
						'max_columns'     => 6,
					),
				) );

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

		/**
		 * Registers the Menus.
		 */
		public function register_nav_menus() {

			register_nav_menus( array(
				                    'primary' => esc_html__( 'Primary Menu', 'tm-renovation' ),
			                    ) );

			$header_type = Kirki::get_option( 'infinity', 'header_type' );

			if ( 'header03' != $header_type ) {
				register_nav_menus( array(
					                    'top-right' => esc_html__( 'Top Right Menu', 'tm-renovation' ),
				                    ) );
			}

			if ( 'header01' == $header_type ) {
				register_nav_menus( array(
					                    'top-left' => esc_html__( 'Top Left Menu', 'tm-renovation' ),
				                    ) );
			}
		}

		/**
		 * Register widget area.
		 * ====================
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		function widgets_init() {
			// Sidebar
			register_sidebar( array(
				                  'name'          => esc_html__( 'Sidebar', 'tm-renovation' ),
				                  'id'            => 'sidebar-1',
				                  'description'   => '',
				                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			// Top left widget area
			register_sidebar( array(
				                  'name'          => esc_html__( 'Top Left Widget Area', 'tm-renovation' ),
				                  'id'            => 'top-left-widget',
				                  'description'   => esc_html__( 'Only available for Header Type 03', 'tm-renovation' ),
				                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			// Header Right
			register_sidebar( array(
				                  'name'          => esc_html__( 'Header Right', 'tm-renovation' ),
				                  'id'            => 'header-right',
				                  'description'   => '',
				                  'before_widget' => '<aside id="%1$s" class="widget header-right %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			// Sidebar for shop
			if ( class_exists( 'WooCommerce' ) ) {
				register_sidebar( array(
					                  'name'          => esc_html__( 'Sidebar for shop', 'tm-renovation' ),
					                  'id'            => 'sidebar-shop',
					                  'description'   => '',
					                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					                  'after_widget'  => '</aside>',
					                  'before_title'  => '<h3 class="widget-title">',
					                  'after_title'   => '</h3>',
				                  ) );
			}

			// Footer 1
			register_sidebar( array(
				                  'name'          => esc_html__( 'Footer 1 Widget Area', 'tm-renovation' ),
				                  'id'            => 'footer',
				                  'description'   => '',
				                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title"><span>',
				                  'after_title'   => '</span></h3>',
			                  ) );

			// Footer 2
			register_sidebar( array(
				                  'name'          => esc_html__( 'Footer 2 Widget Area', 'tm-renovation' ),
				                  'id'            => 'footer2',
				                  'description'   => '',
				                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title"><span>',
				                  'after_title'   => '</span></h3>',
			                  ) );

			// Footer 3
			register_sidebar( array(
				                  'name'          => esc_html__( 'Footer 3 Widget Area', 'tm-renovation' ),
				                  'id'            => 'footer3',
				                  'description'   => '',
				                  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</aside>',
				                  'before_title'  => '<h3 class="widget-title"><span>',
				                  'after_title'   => '</span></h3>',
			                  ) );
		}
	}

	new TM_Renovation_Init();
}