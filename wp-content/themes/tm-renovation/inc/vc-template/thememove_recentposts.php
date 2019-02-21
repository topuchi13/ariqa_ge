<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $show_title
 * @var $show_excerpt
 * @var $show_meta
 * @var $number
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Recentposts
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array( 'post_type' => 'post', 'posts_per_page' => $number);
$loop = new WP_Query( $args );
$el_class = $this->getExtraClass( $el_class );
?>
<div class="recent-posts thememove-recent-posts <?php echo esc_attr($el_class); ?>">
  <?php while ( $loop->have_posts() ) : $loop->the_post(); $meta = get_post_meta(get_the_ID()); ?>
    <div class="recent-posts__item row">
        <a href="<?php the_permalink() ?>" class="recent-posts__thumb col-sm-3"><?php the_post_thumbnail('small-thumb'); ?></a>
        <div class="recent-posts__info col-sm-9">
          <?php if ($show_title): ?>
            <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
          <?php endif ?>
          <?php if ($show_excerpt): ?>
            <div class="entry-excerpt"><?php the_excerpt(); ?></div>
          <?php endif ?>
          <?php if ($show_meta): ?>
            <div class="post-meta">
              <span class="author"><i class="fa fa-user"></i> <?php the_author(); ?></span>
              <span class="post-date"><i class="fa fa-clock-o"></i> <?php the_time('F j, Y'); ?></span>
              <span class="post-com"><i class="fa fa-comments"></i> <?php comments_number( 'No response', 'One response', '% responses' ); ?></span>
            </div>
          <?php endif ?>
        </div>
    </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>