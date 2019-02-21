<?php


class TM_CMB2_Type_Select2 {
	public function __construct() {
		add_filter( 'cmb2_render_tm_select', array( $this, 'render_tm_select' ), 10, 5 );
		add_filter( 'cmb2_render_tm_multiselect', array( $this, 'render_tm_multiselect' ), 10, 5 );
		add_filter( 'cmb2_sanitize_tm_multiselect', array( $this, 'tm_multiselect_sanitize' ), 10, 4 );
		add_filter( 'cmb2_types_esc_tm_multiselect', array( $this, 'tm_multiselect_escaped_value' ), 10, 3 );
		add_filter( 'cmb2_repeat_table_row_types', array( $this, 'tm_multiselect_table_row_class' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_admin_scripts' ) );
	}

	/**
	 * Render select box field
	 */
	public function render_tm_select( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new CMB2_Type_Select( $field_type_object );
		}
		echo $field_type_object->select( array(
			'class'            => 'tm_select2 tm_select',
			'desc'             => $field_type_object->_desc( true ),
			'options'          => '<option></option>' . $field_type_object->concat_items(),
			'data-placeholder' => $field->args( 'attributes', 'placeholder' ) ? $field->args( 'attributes', 'placeholder' ) : $field->args( 'description' ),
		) );
	}

	/**
	 * Render multi-value select input field
	 */
	public function render_tm_multiselect( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new CMB2_Type_Select( $field_type_object );
		}
		$a     = $field_type_object->parse_args( 'tm_multiselect', array(
			'multiple'         => 'multiple',
			'style'            => 'width: 99%',
			'class'            => 'tm_select2 tm_multiselect',
			'name'             => $field_type_object->_name() . '[]',
			'id'               => $field_type_object->_id(),
			'desc'             => $field_type_object->_desc( true ),
			'options'          => $this->get_tm_multiselect_options( $field_escaped_value, $field_type_object ),
			'data-placeholder' => $field->args( 'attributes', 'placeholder' ) ? $field->args( 'attributes', 'placeholder' ) : $field->args( 'description' ),
		) );
		$attrs = $field_type_object->concat_attrs( $a, array( 'desc', 'options' ) );
		echo sprintf( '<select%s>%s</select>%s', $attrs, $a['options'], $a['desc'] );
	}

	/**
	 * Return list of options for tm_multiselect
	 *
	 * Return the list of options, with selected options at the top preserving their order. This also handles the
	 * removal of selected options which no longer exist in the options array.
	 */
	public function get_tm_multiselect_options( $field_escaped_value = array(), $field_type_object ) {

		$options = (array) $field_type_object->field->options();
		// If we have selected items, we need to preserve their order
		if ( ! empty( $field_escaped_value ) ) {
			$options = $this->sort_array_by_array( $options, $field_escaped_value );
		}
		$selected_items = '';
		$other_items    = '';
		foreach ( $options as $option_value => $option_label ) {
			// Clone args & modify for just this item
			$option = array(
				'value' => $option_value,
				'label' => $option_label,
			);
			// Split options into those which are selected and the rest
			if ( in_array( $option_value, (array) $field_escaped_value ) ) {
				$option['checked'] = true;
				$selected_items .= $field_type_object->select_option( $option );
			} else {
				$other_items .= $field_type_object->select_option( $option );
			}
		}

		return $selected_items . $other_items;
	}

	/**
	 * Sort an array by the keys of another array
	 *
	 * @author Eran Galperin
	 * @link http://link.from.tm/1Waji4l
	 */
	public function sort_array_by_array( array $array, array $orderArray ) {
		$ordered = array();
		foreach ( $orderArray as $key ) {
			if ( array_key_exists( $key, $array ) ) {
				$ordered[ $key ] = $array[ $key ];
				unset( $array[ $key ] );
			}
		}

		return $ordered + $array;
	}

	/**
	 * Handle sanitization for repeatable fields
	 */
	public function tm_multiselect_sanitize( $check, $meta_value, $object_id, $field_args ) {
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = array_map( 'sanitize_text_field', $val );
		}

		return $meta_value;
	}

	/**
	 * Handle escaping for repeatable fields
	 */
	public function tm_multiselect_escaped_value( $check, $meta_value, $field_args ) {
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = array_map( 'esc_attr', $val );
		}

		return $meta_value;
	}

	/**
	 * Add 'table-layout' class to multi-value select field
	 */
	public function tm_multiselect_table_row_class( $check ) {
		$check[] = 'tm_multiselect';

		return $check;
	}

	/**
	 * Enqueue scripts and styles
	 */
	public function setup_admin_scripts() {
		$asset_path = apply_filters( 'tm_cmb2_field_select2_asset_path', plugins_url( '', __FILE__ ) );

		wp_register_script( 'tm-select2-js', $asset_path . '/js/select2.min.js', array( 'jquery-ui-sortable' ) );
		wp_enqueue_script( 'tm-select2-init', $asset_path . '/js/cmb2-select2.js', array(
			'cmb2-scripts',
			'tm-select2-js'
		) );

		wp_enqueue_style( 'tm-select2', $asset_path . '/css/select2.min.css' );
	}
}

new TM_CMB2_Type_Select2();