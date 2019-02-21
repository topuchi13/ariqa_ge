<?php

class TM_CMB2_Type_RGBa_Picker {

	public function __construct() {
		add_action( 'cmb2_render_rgba_colorpicker', array( $this, 'render_color_picker' ), 10, 5 );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_admin_scripts' ) );
	}

	public function render_color_picker( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		echo $field_type_object->input( array(
			'class'              => 'cmb2-colorpicker color-picker',
			'data-default-color' => $field->args( 'default' ),
			'data-alpha'         => 'true',
		) );
	}

	public function setup_admin_scripts() {
		if ( 'page' == get_current_screen()->id ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'rgba-picker-js', plugins_url( 'js/cmb2-rgba-picker.js', __FILE__ ), array( 'wp-color-picker' ), TM_CORE_VERSION, true );
		}
	}
}
new TM_CMB2_Type_RGBa_Picker();