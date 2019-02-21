<?php
/**
 * Template part for displaying posts.
 * Simple layout
 *  @package ThemeMove
 */
?>
<article <?php post_class('post-simple-item'); ?>>
	<?php if(has_post_thumbnail()) { ?>
		<div class="post-thumb">
			<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail(array(850, 500, 'bfi_thumb' => true)); ?></a>
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php TM_Renovation_Templates::posted_on(); ?>
					<span class="comments-counts"><i class="fa fa-comments"></i><?php comments_number( '0', '1', '%' ); ?> <?php comments_number( '', '', '' ); ?></span>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	<?php } ?>

	<div class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</div><!-- .entry-header -->
</article>