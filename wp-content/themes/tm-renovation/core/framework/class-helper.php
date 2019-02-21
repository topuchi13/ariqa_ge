<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper functions
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Helper' ) ) {

	class TM_Renovation_Helper {

		function __construct() {

			if ( version_compare( $GLOBALS['wp_version'], '4.4', '>=' ) ) {
				add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );
			}
		}

		public function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		/**
		 * Pass a PHP string to Javasript string
		 **/
 		public static function phpStr_to_JSStr( $string ) {
			return str_replace( "\n",
				'\n',
				str_replace( '"', '\"', addcslashes( str_replace( "\r", '', (string) $string ), "\0..\37" ) ) );
		}

		public static function text2line( $str ) {
			return trim( preg_replace( "/[\r\v\n\t]*/", '', $str ) );
		}
	}

	new TM_Renovation_Helper();
}