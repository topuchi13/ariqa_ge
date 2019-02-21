<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *  Custom template tags for this theme.
 *
 * @package   TM_Renovation_Framework
 *
 * @sine      3.0
 */
if ( ! class_exists( 'TM_Renovation_Templates' ) ) {

	class TM_Renovation_Templates {

		function __construct() {

			add_action( 'edit_category', array( $this, 'category_transient_flusher' ) );

			add_action( 'save_post', array( $this, 'category_transient_flusher' ) );

			add_filter( 'woothemes_testimonials_item_template', array( $this, 'testimonials_item_template' ) );
		}

		/**
		 * Display navigation to next/previous set of posts when applicable.
		 */
		public static function paging_nav() {
			global $wp_query, $wp_rewrite;

			// Don't print empty markup if there's only one page.
			if ( $wp_query->max_num_pages < 2 ) {
				return;
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
				                         'base'      => $pagenum_link,
				                         'format'    => $format,
				                         'total'     => $wp_query->max_num_pages,
				                         'current'   => $paged,
				                         'mid_size'  => 1,
				                         'add_args'  => array_map( 'urlencode', $query_args ),
				                         'prev_text' => '<i class="fa fa-angle-left"></i>',
				                         'next_text' => '<i class="fa fa-angle-right"></i>',
			                         ) );

			if ( $links ) :

				?>
				<div class="pagination loop-pagination">
					<?php echo $links; ?>
				</div><!-- .pagination -->
				<?php
			endif;
		}

		/**
		 * Prints HTML with meta information for the current post-date/time and author.
		 */
		public static function posted_on() {

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
			                        esc_attr( get_the_date( 'c' ) ),
			                        esc_html( get_the_date() ),
			                        esc_attr( get_the_modified_date( 'c' ) ),
			                        esc_html( get_the_modified_date() )
			);

			$posted_on = sprintf(
				esc_html_x( '%s', 'post date', 'tm-renovation' ),
				'<i class="fa fa-clock-o"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				esc_html_x( 'by %s', 'post author', 'tm-renovation' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span>'; // <span class="byline"> ' . $byline . '</span>WPCS: XSS OK.

		}

		/**
		 * Prints HTML with meta information for the categories, tags and comments.
		 */
		public static function entry_footer() {
			// Hide category and tag text for pages.
			if ( 'post' == get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'tm-renovation' ) );
				if ( $categories_list && self::categorized_blog() ) {
					printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tm-renovation' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tm-renovation' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'tm-renovation' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			}

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link( esc_html__( 'Leave a comment', 'tm-renovation' ), esc_html__( '1 Comment', 'tm-renovation' ), esc_html__( '% Comments', 'tm-renovation' ) );
				echo '</span>';
			}

			edit_post_link( esc_html__( 'Edit', 'tm-renovation' ), '<span class="edit-link">', '</span>' );
		}

		/**
		 * Returns true if a blog has more than 1 category.
		 *
		 * @return bool
		 */
		public static function categorized_blog() {
			if ( false === ( $all_the_cool_cats = get_transient( 'tm_renovation_categories' ) ) ) {
				// Create an array of all the categories that are attached to posts.
				$all_the_cool_cats = get_categories( array(
					                                     'fields'     => 'ids',
					                                     'hide_empty' => 1,
					                                     // We only need to know if there is more than one category.
					                                     'number'     => 2,
				                                     ) );

				// Count the number of categories that are attached to the posts.
				$all_the_cool_cats = count( $all_the_cool_cats );

				set_transient( 'tm_renovation_categories', $all_the_cool_cats );
			}

			if ( $all_the_cool_cats > 1 ) {
				// This blog has more than 1 category so infinity_categorized_blog should return true.
				return true;
			} else {
				// This blog has only 1 category so infinity_categorized_blog should return false.
				return false;
			}
		}

		/**
		 * Flush out the transients used in infinity_categorized_blog.
		 */
		public function category_transient_flusher() {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			// Like, beat it. Dig?
			delete_transient( 'tm_renovation_categories' );
		}

		/**
		 * Custom Comment Form
		 * ========================================================================
		 */
		public static function comment( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, $size = '100' ); ?>
				</div>
				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'tm-renovation' ) ?></em>
						<br/>
					<?php endif; ?>
					<div class="metadata">
						<?php printf( wp_kses( '<cite class="fn">%s</cite>', array( 'cite' => array() ) ), get_comment_author_link() ) ?>
						<br/>
						<a class="comment-date"
						   href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
							<?php printf( esc_html__( '%1$s', 'tm-renovation' ), get_comment_date(), get_comment_time() ) ?></a>
						<?php edit_comment_link( esc_html__( '(Edit)', 'tm-renovation' ), '  ', '' ) ?>
						<?php comment_reply_link( array_merge( $args, array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						) ) ) ?>
					</div>
					<?php comment_text() ?>
				</div>
			</div>
			<?php
		}

		/**
		 * Dynamic excerpt for post
		 *
		 * @param int $length Max excerpt length.
		 *
		 * @return string
		 */
		public static function print_excerpt( $length ) {

			global $post;

			$text = $post->post_excerpt;
			if ( '' == $text ) {
				$text = get_the_content( '' );
				$text = apply_filters( 'the_content', $text );
				$text = str_replace( ']]>', ']]>', $text );
			}
			$text = strip_shortcodes( $text );
			$text = strip_tags( $text );

			$text    = substr( $text, 0, $length );
			$excerpt = self::reverse_strrchr( $text, '.', 1 );
			if ( $excerpt ) {
				echo apply_filters( 'the_excerpt', $excerpt );
			} else {
				echo apply_filters( 'the_excerpt', $text );
			}
		}

		/**
		 * Returns the portion of haystack which goes until the last occurrence of needle
		 *
		 * @param int $haystack
		 * @param int $needle
		 * @param int $trail
		 *
		 * @return int
		 */
		public static function reverse_strrchr( $haystack, $needle, $trail ) {
			return strrpos( $haystack, $needle ) ? substr( $haystack, 0, strrpos( $haystack, $needle ) + $trail ) : false;
		}

		/**
		 * Social Links
		 *
		 * @sine 2.0
		 *
		 * @param bool $mobile
		 */
		public static function social_links( $mobile = false ) {

			if ( ! Kirki::get_option( 'infinity', 'social_links_enable' ) ) {
				return;
			}

			$social_links = Kirki::get_option( 'infinity', 'social_links' );

			$id = $mobile ? 'social-menu-mobile' : 'social-menu-top';

			$classes = array( 'social-menu' );

			if ( $mobile ) {
				$classes[] = 'social-menu--mobile';
			}

			if ( ! empty( $social_links ) ) {
				?>
				<div class="<?php echo implode( ' ', $classes ); ?>">
					<ul class="menu" id="<?php echo esc_attr( $id ); ?>">
						<?php foreach ( $social_links as $row ) { ?>
							<li class="menu-item">
								<?php if ( isset( $row['link_url'] ) && ! empty( $row['link_url'] ) ) { ?>
								<a href="<?php echo esc_url_raw( $row['link_url'] ); ?>">
									<?php } ?>
									<?php if ( isset( $row['icon_class'] ) && ! empty( $row['icon_class'] ) ) { ?>
										<i class="fa <?php echo esc_attr( $row['icon_class'] ); ?>"></i>
									<?php } ?>
									<?php if ( isset( $row['link_url'] ) && ! empty( $row['link_url'] ) ) { ?>
								</a>
							<?php } ?>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php
			}
		}

		public static function logo() {

			ob_start();

			global $infinity_custom_logo;

			$logo = Kirki::get_option( 'infinity', 'site_logo' );

			if ( $infinity_custom_logo ) {
				$logo = $infinity_custom_logo;
			}

			if ( $logo ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img
						src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
			<?php } else { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php }

			return ob_get_clean();

		}

		public static function site_menu( $classes = '' ) {

			ob_start();

			?>

			<nav id="site-navigation"
			     class="main-navigation hidden-xs hidden-sm hidden-md <?php echo esc_attr( $classes ); ?>">
				<div class="container">
					<div class="row middle">
						<div class="col-lg-12">
							<?php

							$arg = array(
								'theme_location'  => 'primary',
								'menu_id'         => 'primary-menu',
								'container_class' => 'primary-menu',
							);

							if ( class_exists( 'TM_Walker_Nav_Menu' ) && has_nav_menu( 'primary' ) ) {
								$arg['walker'] = new TM_Walker_Nav_Menu();
							}

							wp_nav_menu( $arg );
							?>
						</div>
					</div>
				</div>
			</nav>
			<!-- #site-navigation -->

			<?php

			return ob_get_clean();

		}

		public static function mobile_menu_btn() {

			ob_start();

			?>

			<div class="mobile-menu-btn">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
					<path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
					      id="top"></path>
					<path d="M300,320 L540,320" id="middle"></path>
					<path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
					      id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
				</svg>
			</div>

			<?php

			return ob_get_clean();
		}

		public static function mobile_menu() {

			ob_start();
			?>
			<div class="site-mobile-menu">

				<div class="search-box">
					<?php get_search_form(); ?>
					<i class="fa fa-search"></i>
				</div>

				<?php

				$args = array(
					'theme_location' => 'primary',
					'menu_id'        => 'site-mobile-menu',
				);

				if ( class_exists( 'TM_Walker_Nav_Menu' ) && has_nav_menu( 'primary' ) ) {
					$args['walker'] = new TM_Walker_Nav_Menu();
				}

				wp_nav_menu( $args );
				?>

				<div class="hidden-lg">
					<?php self::social_links( true ); ?>
				</div>

			</div>
			<?php
			return ob_get_clean();
		}

		public static function search_box() {

			ob_start();

			?>

			<div class="search-box">
				<i class="fa fa-search"></i>
				<?php get_search_form(); ?>
			</div>

			<?php

			return ob_get_clean();
		}

		public static function minicart() {

			$cart_html = '';

			$qty = WC()->cart->get_cart_contents_count();

			$cart_html .= '<div class="mini-cart__button" title="' . esc_html__( 'View your shopping cart', 'tm-renovation' ) . '">';
			$cart_html .= '<span class="mini-cart-icon"' . ' data-count="' . $qty . '"></span>';
			$cart_html .= '</div>';

			return $cart_html;
		}

		public static function testimonials_item_template() {
			return '<div id="quote-%%ID%%" class="%%CLASS%%" itemprop="review" itemscope itemtype="http://schema.org/Review"><blockquote class="testimonials-text" itemprop="reviewBody">%%TEXT%%</blockquote><div class="item-info"><div class="avatar-wrapper">%%AVATAR%%</div> %%AUTHOR%%</div></div>';
		}
	}

	new TM_Renovation_Templates();
}
