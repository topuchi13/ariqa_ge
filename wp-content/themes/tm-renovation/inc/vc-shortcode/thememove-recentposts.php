<?php
/**
 * ThemeMove Recentposts Shortcode
 * @version 1.0
 * @package ThemeMove
 */
class WPBakeryShortCode_Thememove_Recentposts extends WPBakeryShortCode
{
}

// Mapping shortcode
vc_map(array(
  'name' => esc_html__('Recent Posts', 'tm-renovation'),
  'base' => 'thememove_recentposts',
  'category' => esc_html__('by THEMEMOVE', 'tm-renovation'),
  'params' => array(
    array(
      'type' => 'checkbox',
      'param_name' => 'show_title',
      'value' => array(
        'Show title' => true
      )
    ),
    array(
      'type' => 'checkbox',
      'param_name' => 'show_excerpt',
      'value' => array(
        esc_html__('Show excerpt', 'tm-renovation' ) => true
      )
    ),
    array(
      'type' => 'checkbox',
      'param_name' => 'show_meta',
      'value' => array(
        'Show Meta' => true
      )
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Enter numbers of articles', 'tm-renovation'),
      'param_name' => 'number',
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Extra class name', 'tm-renovation'),
      'param_name' => 'el_class',
      'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'tm-renovation'),
    ),
  )
));