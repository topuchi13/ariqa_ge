<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue style & script
 *
 * @package TM_Renovation_Framework
 * @since   3.0
 */

if ( ! class_exists( 'TM_Renovation_Enqueue' ) ) {

	class TM_Renovation_Enqueue {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'thememove_scripts' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'custom_css' ) );

			add_action( 'wp_head', array( $this, 'inline_live_css' ) );

			add_action( 'wp_head', array( $this, 'inline_css' ) );

			add_action( 'wp_footer', array( $this, 'custom_js' ) );

			add_action( 'admin_head', array( $this, 'admin_css' ) );

			add_action( 'customize_controls_init', array( $this, 'admin_customizer_css' ) );

			add_action( 'admin_footer', array( $this, 'admin_custom_js' ) );
		}

		/**
		 * Enqueue scripts and styles.
		 * ==========================
		 */
		function thememove_scripts() {

			wp_enqueue_style( 'tm-renovation-style', TM_RENOVATION_URI . '/style.css' );
			wp_enqueue_style( 'tm-renovation-main', TM_RENOVATION_URI . '/css/main.css' );
			wp_enqueue_style( 'font-awesome', TM_RENOVATION_URI . '/css/font-awesome.min.css' );
			wp_enqueue_style( 'font-pe-icon-7-stroke', TM_RENOVATION_URI . '/css/pe-icon-7-stroke.css' );
			wp_enqueue_style( 'tm-renovation-icon', TM_RENOVATION_URI . '/css/renovation.css' );

			wp_enqueue_script( 'head-room-jquery', TM_RENOVATION_URI . '/js/jQuery.headroom.min.js', array( 'jquery' ), TM_RENOVATION_THEME_VERSION, true );
			wp_enqueue_script( 'head-room', TM_RENOVATION_URI . '/js/headroom.min.js', array( 'jquery' ), TM_RENOVATION_THEME_VERSION, true );

			wp_enqueue_script( 'owl-carousel', TM_RENOVATION_URI . '/js/owl.carousel.min.js', array( 'jquery' ), TM_RENOVATION_THEME_VERSION, true );
			wp_enqueue_script( 'stellar', TM_RENOVATION_URI . '/js/jquery.stellar.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'magnific', TM_RENOVATION_URI . '/js/jquery.magnific-popup.min.js' );
			wp_enqueue_script( 'perfect-scrollbar', TM_RENOVATION_URI . '/js/perfect-scrollbar.jquery.min.js' );

			wp_enqueue_script( 'tm-renovation-js-main', TM_RENOVATION_URI . '/js/main.js', array( 'jquery' ), TM_RENOVATION_THEME_VERSION, true );
			wp_localize_script( 'tm-renovation-js-main', 'tmRenovationConfigs', array(
				'is_rtl'      => is_rtl(),
				'ajax_url'    => esc_url( admin_url( 'admin-ajax.php' ) ),
				'wc_cart_url' => ( function_exists( 'wc_get_cart_url' ) ? esc_url( wc_get_cart_url() ) : '' ),
				'header_type' => Kirki::get_option( 'infinity', 'header_type' ),
			) );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if ( is_rtl() ) {
				wp_enqueue_style( 'tm-renovation-style-rtl', TM_RENOVATION_URI . '/css/rtl.css' );
			}
		}

		/**
		 * Setup custom css.
		 * ================
		 */
		function custom_css() {
			$custom_css = Kirki::get_option( 'infinity', 'custom_css' );
			if ( Kirki::get_option( 'infinity', 'custom_css_enable' ) == 1 ) {
				wp_add_inline_style( 'tm-renovation-main', html_entity_decode( $custom_css, ENT_QUOTES ) );
			}
		}

		/**
		 * For live customize in Custom code >> Custom CSS
		 */
		function inline_live_css() {
			echo '<style id="tm-renovation-inline-live-css" type="text/css"></style>';
		}

		/**
		 * Inline CSS
		 */
		function inline_css() {
			echo '<style id="tm-renovation-inline-css" type="text/css"></style>';
		}

		function custom_js() {
			$custom_js = Kirki::get_option( 'infinity', 'custom_js' );
			echo '<script>' . html_entity_decode( $custom_js, ENT_QUOTES ) . '</script>';
		}

		function admin_css() {
			wp_enqueue_style( 'tm-renovation-custom-admin-css', TM_RENOVATION_URI . '/core/css/core.css' );
		}

		function admin_customizer_css() {
			wp_enqueue_style( 'tm-renovation-customizer-admin-css', TM_RENOVATION_URI . '/core/css/customizer.css' );
		}

		function admin_custom_js() {
			wp_enqueue_script( 'infinity-custom-admin-js', TM_RENOVATION_URI . '/core/js/core.js' );
		}

	}

	new TM_Renovation_Enqueue();
}