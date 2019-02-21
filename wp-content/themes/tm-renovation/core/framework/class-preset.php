<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *  Preset Handle
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Preset' ) ) {

	class TM_Renovation_Preset {

		/**
		 * Get preset form file
		 *
		 * @param string $type
		 * @param string $preset_id
		 *
		 * @return array|mixed|object
		 */
		public static function get_preset( $type = '', $preset_id = 'preset1' ) {
			global $wp_filesystem;

			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();

			$path = TM_RENOVATION_DIR . '/inc/presets/' . $type . '/' . $preset_id . '.json';

			$preset = array();

			if ( file_exists( $path ) ) {

				$json   = $wp_filesystem->get_contents( $path );
				$preset = json_decode( $json, true );
			}

			return $preset;
		}

		/**
		 * Get preset label
		 *
		 * @param string $type
		 * @param string $preset_id
		 *
		 * @return mixed|string
		 */
		public static function get_preset_label( $type = '', $preset_id = 'preset1' ) {

			$preset = self::get_preset( $type, $preset_id );

			if ( ! empty( $preset ) && isset( $preset['label'] ) ) {
				return $preset['label'];
			}

			return '';
		}

		/**
		 * Get preset image
		 *
		 * @param string $type
		 * @param string $preset_id
		 *
		 * @return array|mixed
		 */
		public static function get_preset_image( $type = '', $preset_id = 'preset1' ) {

			$preset = self::get_preset( $type, $preset_id );

			if ( ! empty( $preset ) && isset( $preset['image'] ) ) {
				return $preset['image'];
			}

			return array();
		}

		/**
		 * Get preset settings
		 *
		 * @param string $type
		 * @param string $preset_id
		 *
		 * @return array|mixed
		 */
		public static function get_preset_settings( $type = '', $preset_id = 'preset1' ) {

			$preset = self::get_preset( $type, $preset_id );

			if ( ! empty( $preset ) && isset( $preset['settings'] ) ) {
				return $preset['settings'];
			}

			return array();
		}
	}

	new TM_Renovation_Preset();
}