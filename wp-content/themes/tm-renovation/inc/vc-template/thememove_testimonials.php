<?php
/**
 * Shortcode attributes
 *
 * @var $enable_carousel
 * @var $display_bullets
 * @var $enable_autoplay
 * @var $number
 * @var $box_style
 * @var $orderby
 * @var $order
 * @var $display_author
 * @var $display_url
 * @var $display_avatar
 * @var $size
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Testimonials
 */
$output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

if ( $atts['enable_carousel'] == 'yes' ) {
	$el_class .= 'carousel-enable';
}

$el_class .= ' style-' . $atts['box_style'];

$atts['is_rtl'] = is_rtl();

?>
<div <?php echo 'class="thememove-testimonials ' . esc_attr( $el_class ) . '"'; ?>
	data-atts="<?php echo esc_attr( json_encode( $atts ) ); ?>">

	<?php do_action( 'woothemes_testimonials', array(
		'limit'          => $number,
		'size'           => apply_filters( 'tm_renovation_testimonial_avatar_size', 70 ),
		'orderby'        => $orderby,
		'order'          => $order,
		'display_author' => ( $display_author == 'yes' ? true : false ),
		'display_avatar' => ( $display_avatar == 'yes' ? true : false ),
		'display_url'    => ( $display_url == 'yes' ? true : false ),
	) ); ?>
</div>