<?php
/**
 * Single Project Image
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

?>
<div class="single-featured">

	<?php
		if ( has_post_thumbnail() ) {

			$image       		= get_the_post_thumbnail( $post->ID, array(1170, 600, 'bfi_thumb' => true) );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( projects_get_gallery_attachment_ids() );
			$lightbox_rel 		= apply_filters( 'projects_lightbox_rel', $rel = 'lightbox' );

			if ( $attachment_count > 0 ) {
				$gallery = '[project-gallery]';
			} else {
				$gallery = '';
			}

			if ( apply_filters( 'projects_gallery_link_images', true ) ) {
				echo '<a href="' . esc_url($image_link) . '" title="' . esc_attr($image_title) . '" rel="' . esc_attr($lightbox_rel) . ' project-gallery-' . esc_attr($post->ID) . '">' . $image . '</a>';
			} else {
				echo $image;
			}

		}

	 ?>

</div>
