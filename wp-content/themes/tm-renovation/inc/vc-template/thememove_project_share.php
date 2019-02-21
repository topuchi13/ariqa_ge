<?php
/**
 * Shortcode attributes
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Project_Share
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;
?>
<div class="tm-project-share<?php echo esc_attr($el_class ? ' ' . $el_class : ''); ?>">
	<?php if ($post->post_type != 'project') {?>
		<div class="tm_project_details__warning">
			<?php esc_html_e('Project Details Shortcode only available for "Projects" content type.', 'tm-renovation'); ?>
		</div>
	<?php } else { ?>
		<div class="post-share-buttons">
			<span><?php echo esc_html__( 'Share ', 'tm-renovation' ); ?></span>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
			   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
				<i class="fa fa-facebook"></i>
			</a>
			<a href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo rawurlencode(the_title('', '', false)); ?>%20-%20<?php the_permalink(); ?>"
			   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
				<i class="fa fa-twitter"></i>
			</a>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
			   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
				<i class="fa fa-google-plus"></i>
			</a>
		</div>
	<?php } ?>
</div>
