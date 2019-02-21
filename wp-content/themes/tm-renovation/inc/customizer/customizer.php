<?php
/**
 * Renovation Theme Customizer
 *
 * @package Renovation
 */

/**
 * Configuration for the Kirki Customizer
 * =============================================
 */
function tm_renovation_config() {
	$args = array(
		'styles_priority' => 999,
		'width'           => '300px',
		'url_path'        => TM_RENOVATION_URI . '/core/kirki/'
	);

	return $args;
}

add_filter( 'kirki/config', 'tm_renovation_config' );

/**
 * Remove Unused Native Sections
 * =============================
 */
function tm_renovation_remove_customizer_sections( $wp_customize ) {
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'static_front_page' );

	$wp_customize->remove_control( 'blogname' );
	$wp_customize->remove_control( 'blogdescription' );
	$wp_customize->remove_control( 'page_for_posts' );

}

add_action( 'customize_register', 'tm_renovation_remove_customizer_sections' );

/**
 * General setups
 * ==============
 */
Kirki::add_config( 'infinity', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );


/**
 * Include setups
 * ==============
 */
// default value
require_once TM_RENOVATION_INC_DIR . '/variables.php';
require_once TM_RENOVATION_INC_DIR . '/customizer/panels.php';

add_filter( 'kirki/values/get_value', 'tm_renovation_kirki_db_get_theme_mod_value', 10, 2 );
function tm_renovation_kirki_db_get_theme_mod_value( $value, $setting ) {
	static $settings;

	if ( is_page() ) {//&& ! is_customize_preview() ) {

		$presets = apply_filters( 'infinity_page_meta_box_presets', array() );

		if ( ! empty( $presets ) ) {
			foreach ( $presets as $preset ) {
				$page_preset_value = get_post_meta( get_the_ID(), 'infinity_' . $preset, true );

				if ( $page_preset_value && 'default' != $page_preset_value ) {
					$_GET[ $preset ] = $page_preset_value;
				}
			}
		}

	}


	if ( is_null( $settings ) || ( empty( $settings ) && is_page() ) ) {
		$settings = array();

		if ( ! empty( $_GET ) ) {
			foreach ( $_GET as $key => $query_value ) {
				if ( ! empty( Kirki::$fields[ $key ] ) ) {
					$settings[ $key ] = $query_value;

					if ( is_array( Kirki::$fields[ $key ] ) &&
					     'kirki-preset' == Kirki::$fields[ $key ]['type'] &&
					     ! empty( Kirki::$fields[ $key ]['choices'] ) &&
					     ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ] ) &&
					     ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] )
					) {

						foreach ( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
							$settings[ $kirki_setting ] = $kirki_value;
						}
					}
				}
			}
		}
	}

	if ( isset ( $settings[ $setting ] ) ) {
		return $settings[ $setting ];
	}

	return $value;
}