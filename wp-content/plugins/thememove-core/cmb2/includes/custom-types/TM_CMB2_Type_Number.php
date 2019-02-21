<?php

class TM_CMB2_Type_Number {

	public function __construct() {
		add_action( 'cmb2_render_number', array( $this, 'thememove_cmb2_render_number' ), 10, 5 );
		add_filter( 'cmb2_sanitize_number', array( $this, 'thememove_cmb2_sanitize_number' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_admin_scripts' ) );
	}

	/**
	 * Render the 'number' custom field type
	 *
	 * @param $field
	 * @param $escaped_value
	 * @param $object_id
	 * @param $object_type
	 * @param $field_type_object
	 */
	public function thememove_cmb2_render_number( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {

		$options = $field_type_object->field->args( 'options' );

		$value = $escaped_value ? $escaped_value : $field_type_object->field->args( 'default' );

		?>
		<div class="cmb2_number">
			<?php if ( isset( $options['prefix'] ) && $options['prefix'] ) { ?>
				<span><?php echo esc_attr( $options['prefix'] ) ?></span>
			<?php } ?>
			<input type="button" value="-" class="minus"/>
			<input type="number"
				<?php echo isset( $options['min'] ) ? 'min="' . esc_attr( $options['min'] ) . '"' : '' ?>
				<?php echo isset( $options['max'] ) ? 'max="' . esc_attr( $options['max'] ) . '"' : '' ?>
				<?php echo isset( $options['step'] ) ? 'step="' . esc_attr( $options['step'] ) . '"' : '' ?>
				   class="cmb_text_small"
				   name="<?php echo esc_attr( $field_type_object->_name() ) ?>"
				   id="<?php echo esc_attr( $field_type_object->_id() ) ?>"
				   value="<?php echo esc_attr( $value ) ?>"
			>
			<input type="button" value="+" class="plus"/>
			<?php if ( isset( $options['suffix'] ) && $options['suffix'] ) { ?>
				<span><?php echo esc_attr( $options['suffix'] ) ?></span>
			<?php } ?>
		</div>
		<?php if ( $field_type_object->_desc() ) { ?>
			<p class="cmb2-metabox-description">
				<?php echo $field_type_object->_desc(); ?>
			</p>
		<?php }
	}

	/**
	 * Sanitize the field
	 *
	 * @param $null
	 * @param $new
	 *
	 * @return mixed
	 */
	public function thememove_cmb2_sanitize_number( $null, $new ) {
		$new = preg_replace( "/[^0-9]/", "", $new );

		return $new;
	}

	public function setup_admin_scripts() {
		wp_enqueue_script( 'cmb2-number-js', plugins_url( 'js/cmb2-number.js', __FILE__ ) );
	}
}

new TM_CMB2_Type_Number();