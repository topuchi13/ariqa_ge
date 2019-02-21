<?php
/**
 * Shortcode attributes
 * @var $icon_type
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $icon_pe7stroke
 * @var $icon_renovation
 * @var $font_size
 * @var $font_color
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Icon
 */
$output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$iconClass = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : 'fa fa-adjust';

?>
<div class="thememove-icon<?php echo esc_attr(' ' . $el_class); ?>">
	<i class="<?php echo esc_attr($iconClass); ?>"
	   style="font-size: <?php echo esc_attr($font_size . (is_numeric($font_size) ? 'px' : '')); ?>;color: <?php echo esc_attr($font_color); ?>"></i>
</div>