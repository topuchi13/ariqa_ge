<?php

/**
 * Class ThemeMove_Responsive
 * @property mixed data
 * @package ThemeMove
 */
Class ThemeMove_Responsive {

  private $settings = array();

  private $value = '';

  private $sizes = array(
    'lg' => 'Large',
    'md' => 'Medium',
    'sm' => 'Small',
    'xs' => 'Extra small'
  );
  private $icons = array(
    'lg' => 'fa-desktop',
    'md' => 'fa-tablet fa-rotate-270',
    'sm' => 'fa-tablet',
    'xs' => 'fa-mobile'
  );

  private $item_width_list = array();

  /**
   * @param $settings
   * @param $value
   */
  public function __construct($settings, $value) {
    $this->settings = $settings;
    $this->value = $value;
    
    $this->item_width_list = array(
      __('1 columns - 1/1 - 12 items in a row', 'tm-renovation')  => 1,
      __('2 columns - 1/6 - 6 items in a row', 'tm-renovation')  => 2,
      __('3 columns - 1/4 - 4 items in a row', 'tm-renovation')  => 3,
      __('4 columns - 1/3 - 3 items in a row', 'tm-renovation')  => 4,
      __('6 columns - 1/2 - 2 items in a row', 'tm-renovation')  => 6,
      __('12 columns - 1/1 - 1 item in a row', 'tm-renovation') => 12,
    );
  }

  /**
   * @return array|mixed
   */
  private function valueData() {
    if ( ! isset( $this->data ) ) {
      $this->data = preg_split( '/\s+/', $this->value );
    }

    return $this->data;
  }

  private function sizeControl ($size_key) {
    if ('md' === $size_key) {
      return '<span class="vc_description">' . __( 'Default value from "Number of items in a row" attribute', 'tm-renovation' ) . '</span>';
    }

    $empty_label = $size_key === 'xs' ? '' : __( 'Inherit from smaller', 'tm-renovation' );
    $output = '<select name="tm_col_' . $size_key . '_size" class="thememove_responsive_field" data-type="size-' . $size_key . '">'
      . '<option value="" style="color: #ccc;">' . $empty_label . '</option>';
    foreach ( $this->item_width_list as $label => $width ) {
        $value = 'col-' . $size_key . '-' . $width;
        $output .= '<option value="' . $value . '"' . ( in_array( $value, $this->valueData() ) ? ' selected="true"' : '' ) . '>' . $label . '</option>';
    }
    $output .= '</select>';
    return $output;
  }

  /**
   * Render HTML for responsive param
   * @return string
   */
  public function render() {
    $html = '';
    $html .= '<div class="tm_responsive" data-responsive="true">
              <input name="' . esc_attr( $this->settings['param_name'] ) . '" class="wpb_vc_param_value ' .
                    esc_attr( $this->settings['param_name'] ) . ' ' . esc_attr( $this->settings['type'] ) .
                    '_field" type="hidden" value="' . esc_attr( $this->value ) . '"/>
             <table class="vc_table tm_table tm_responsive-table">
              <tr>
                <th>' . __('Device', 'tm-renovation') . '</th>
                <th>' . __('Item width', 'tm-renovation') . '</th>
                <th>' . __('Hide on device?', 'tm-renovation') . '</th>
              </tr>
            ';
    foreach ( $this->sizes as $key => $size ) {
      $html .= '
        <tr class="tm_size-' . $key . '">
          <td class="tm_screen-size tm_screen-size--' . $key . '">
            <i class="fa ' . $this->icons[$key] . '" title="' . $size . '"></i>
          </td>
          <td>' . $this->sizeControl($key)  . '</td>
          <td>
					<label>
						<input type="checkbox" name="vc_hidden-' . $key . '"
						       value="yes"' . (in_array( 'vc_hidden-' . $key, $this->valueData() ) ? ' checked="true"' : "") .
						       'class="thememove_responsive_field">
					</label>
				</td>
        </tr>
      ';
    }
    $html .= '</table>
        </div>';
    return  $html;
  }
}

/**
 * Register params
 * @param $settings
 * @param $value
 * @return string
 */
function thememove_responsive_settings_field( $settings, $value ) {
  $responsive = new ThemeMove_Responsive($settings, $value);

  return $responsive->render();
}
vc_add_shortcode_param( 'thememove_responsive', 'thememove_responsive_settings_field', TM_RENOVATION_URI . '/inc/vc-params/thememove-responsive/thememove_responsive.js');
