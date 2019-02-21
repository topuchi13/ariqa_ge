<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Import sample data
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Import' ) ) {

	class TM_Renovation_Import {

		function __construct() {

			add_filter( 'thememove_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'thememove_import_style', array( $this, 'import_style' ) );
			add_filter( 'thememove_import_generate_thumb', array( $this, 'import_generate_thumb' ) );
		}

		function import_demos() {
			return array(
				'thememove01' => array(
					'screenshot' => 'https://renovation.thememove.com/data/images/demo.jpg',
					'name'       => esc_html__( 'Renovation', 'tm-renovation' ),
					'url'        => 'https://renovation.thememove.com/packages/tm-renovation-thememove01.zip',
				),
			);
		}

		function import_style() {
			return array(
				'title_color'  => '#222222',
				'link_color'   => '#FBD232',
				'notice_color' => '#FBD232',
				'logo'         => 'https://renovation.thememove.com/data/images/logo.png',
			);
		}

		function import_generate_thumb() {
			return true;
		}
	}

	new TM_Renovation_Import();
}