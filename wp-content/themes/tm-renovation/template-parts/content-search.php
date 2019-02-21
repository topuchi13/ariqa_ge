<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Renovation
 */

$infinity_hide_tags         =  Kirki::get_option( 'infinity', 'post_layout_hide_tags' );
$infinity_hide_share        =  Kirki::get_option( 'infinity', 'post_layout_hide_share' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<div class="entry-meta">
					<?php TM_Renovation_Templates::posted_on(); ?>
					<span class="author vcard"><i class="fa fa-pencil"></i> <?php echo get_the_author(); ?></span>
					<span class="categories-links"><i class="fa fa-folder-open-o"></i> <?php echo get_the_category_list( esc_html__( ', ', 'tm-renovation' ) ) ?> </span>
					<span class="comments-counts"><i class="fa fa-comments"></i><?php comments_number( '0', '1', '%' ); ?> <?php comments_number( '', '', '' ); ?></span>
				</div><!-- .entry-meta -->
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div>
	<!-- .entry-header -->

	<div class="entry-summary">
		<?php TM_Renovation_Templates::print_excerpt(180); ?>
	</div>
	<!-- .entry-summary -->

	<div class="entry-footer">
		<?php if ('post' == get_post_type()) : ?>
			<?php if ( $infinity_hide_tags || $infinity_hide_share ):
				$class = 'col-xs-12';
			else:
				$class = 'col-sm-6';
			endif;
			?>

			<div class="row middle">
				<?php if (!$infinity_hide_tags) : ?>
					<div class="<?php echo esc_attr($class); ?>">
						<?php the_tags( '<i class="fa fa-tags"></i> Tags: ', ', ' ); ?>
					</div>
				<?php endif; ?>
				<?php if (!$infinity_hide_share) : ?>
					<div class="<?php echo esc_attr($class); ?> <?php if (!$infinity_hide_tags) { echo 'end-sm'; }?>">
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
					</div>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<?php TM_Renovation_Templates::entry_footer(); ?>
		<?php endif; ?>
	</div>
	<!-- .entry-footer -->
</article><!-- #post-## -->

