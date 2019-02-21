<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Renovation
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf(_nx('1 comment', '%1$s comments ', get_comments_number(), 'comments title', 'tm-renovation'),
				number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation">
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tm-renovation' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tm-renovation' ) ); ?></div>
				</div>
				<!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'callback'    => 'TM_Renovation_Templates::comment',
				'short_ping'  => true,
				'avatar_size' => 80
			) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tm-renovation' ); ?></h2>

				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tm-renovation' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tm-renovation' ) ); ?></div>

				</div>
				<!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tm-renovation' ); ?></p>
	<?php endif; ?>

	<?php
	$commenter     = wp_get_current_commenter();
	$req           = get_option( 'require_name_email' );
	$aria_req      = ( $req ? " aria-required='true'" : '' );
	$fields        = array(
		'author'        => '<div class="col-md-6">' . '<input id="author" placeholder="' . esc_html__('Your name (required)', 'tm-renovation') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
		'email'         => '<div class="col-md-6">' . '<input id="email" placeholder="' . esc_html__('Email (required)', 'tm-renovation') . '" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
	);
	$comments_args = array(
		// change the title of send button
		'label_submit'         => 'Send Message',
		// change the title of the reply section
		'title_reply'          => 'Leave a comment',
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after'  => '',
		'comment_notes_before' => '',
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="col-md-12"><p class="comment-form-comment"><textarea id="comment" placeholder="' . esc_html__('Your Comment (required)', 'tm-renovation' ) . '" name="comment" aria-required="true"></textarea></p></div>',
	);
	comment_form( $comments_args ); ?>

</div><!-- #comments -->
