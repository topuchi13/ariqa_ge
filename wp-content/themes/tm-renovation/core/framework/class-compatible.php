<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prevents theme from running on WordPress versions prior to 4.3
 *
 * Since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.3.
 *
 * @package TM_Renovation_Framework
 * @since   3.0
 */

if ( ! class_exists( 'TM_Renovation_Compatible' ) ) {

	class TM_Renovation_Compatible {

		public function __construct() {

			if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
				add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );
				add_action( 'load-customize.php', array( $this, 'customize' ) );
				add_action( 'template_redirect', array( $this, 'preview' ) );
			}
		}

		/**
		 * Prevent switching to ThemeMove on old versions of WordPress.
		 *
		 * Switches to the default theme.
		 *
		 * @since ThemeMove 1.0
		 */
		function switch_theme() {
			switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
			unset( $_GET['activated'] );
			add_action( 'admin_notices', array( $this, 'upgrade_notice' ) );
		}

		/**
		 * Add message for unsuccessful theme switch.
		 *
		 * Prints an update nag after an unsuccessful attempt to switch to
		 * ThemeMove on WordPress versions prior to 3.9.
		 *
		 * @since Twenty Fifteen 1.0
		 */
		function upgrade_notice() {
			$message = sprintf( __( 'ThemeMove requires at least WordPress version 3.9. You are running version %s. Please upgrade and try again.', 'tm-renovation' ), $GLOBALS['wp_version'] );
			printf( '<div class="error"><p>%s</p></div>', $message );
		}

		/**
		 * Prevent the Customizer from being loaded on WordPress versions prior to 3.9.
		 *
		 * @since ThemeMove 1.0
		 */
		function customize() {
			wp_die( sprintf( __( 'ThemeMove requires at least WordPress version 3.9. You are running version %s. Please upgrade and try again.', 'tm-renovation' ), $GLOBALS['wp_version'] ), '', array(
				'back_link' => true,
			) );
		}

		/**
		 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.9.
		 *
		 * @since ThemeMove 1.0
		 */
		function preview() {
			if ( isset( $_GET['preview'] ) ) {
				wp_die( sprintf( __( 'ThemeMove requires at least WordPress version 3.9. You are running version %s. Please upgrade and try again.', 'tm-renovation' ), $GLOBALS['wp_version'] ) );
			}
		}
	}

	new TM_Renovation_Compatible();
}
