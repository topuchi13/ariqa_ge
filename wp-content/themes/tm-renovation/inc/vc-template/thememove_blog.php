<?php
/**
 * Shortcode attributes
 * @var $layout
 * @var $total_posts
 * @var $posts_per_page
 * @var $enable_share
 * @var $item_width_md
 * @var $number_of_columns_simple
 * @var $orderby
 * @var $order
 * @var $filter
 * @var $taxonomies
 * @var $responsive
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Blog
 */
$output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$this->get_query($atts);

$class = 'col-md-' . $item_width_md;

if('' != $responsive) {
	$class .= ' ' . $responsive;
}

?>
<div class="thememove-blog <?php echo esc_attr($el_class); ?>">
	<?php if('list' == $layout || 'full_list' == $layout) : ?><div class="post-list-layout container"><?php endif; ?>
	<?php if('grid' == $layout || 'full_grid' == $layout) : ?><div class="post-grid-layout row"><?php endif; ?>
	<?php if('simple'== $layout) { ?><div class="post-simple-layout container"><div class="row"> <?php } ?>
		<?php if ( $this->query->have_posts() ) : ?>

			<?php while ( $this->query->have_posts() ) : $this->query->the_post(); ?>

				<?php if('list' == $layout) : ?>

					<?php get_template_part( 'template-parts/content', 'list' ); ?>

				<?php elseif('full_list' == $layout) : ?>

					<?php if($this->query->current_post == 0): ?>
						<?php get_template_part( 'template-parts/content', '' ); ?>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'list' ); ?>
					<?php endif; ?>

				<?php elseif ('grid'== $layout) : ?>

					<div class="<?php echo esc_attr($class); ?>">
						<?php get_template_part('template-parts/content', 'grid'); ?>
					</div>

				<?php elseif ('full_grid' == $layout) : ?>

					<?php if( $this->query->current_post == 0 ) : ?>
						<div class="col-xs-12"><?php get_template_part('template-parts/content', ''); ?></div>
					<?php else : ?>
						<div class="<?php echo esc_attr($class); ?>"><?php get_template_part('template-parts/content', 'grid'); ?></div>
					<?php endif; ?>

				<?php elseif('simple' == $layout) : ?>
					<div class="col-sm-<?php echo esc_attr($number_of_columns_simple); ?>">
						<?php get_template_part('template-parts/content', 'simple'); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
	<?php if('simple' == $layout) : ?></div></div><?php endif; ?>
	<?php if('list' == $layout || 'full_list' == $layout) : ?></div><?php endif; ?>
	<?php if('grid' == $layout || 'full_grid' == $layout) : ?></div><?php endif; ?>
	<?php if($this->num_pages >= 2) { ?>
		<div class="pagination posts-pagination loop-pagination">
			<?php echo $this->get_paging_nav(); ?>
		</div>
	<?php } ?>
</div>
