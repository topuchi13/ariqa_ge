<?php
/**
 * The template for displaying project content in the single-project.php template
 *
 * Override this template by copying it to yourtheme/projects/content-single-project.php
 *
 * @author        WooThemes
 * @package       Projects/Templates
 * @version       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php
/**
 * projects_before_single_project hook
 *
 */
do_action( 'projects_before_single_project' );
?>

	<div id="project-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		/**
		 * projects_before_single_project_summary hook
		 *
		 * @hooked projects_template_single_title - 10
		 * @hooked projects_template_single_short_description - 20
		 * @hooked projects_template_single_feature - 30
		 * @hooked projects_template_single_gallery - 40
		 */
		remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
		do_action( 'projects_before_single_project_summary' );
		?>

		<div class="summary entry-summary row">

			<?php
			/**
			 * projects_single_project_summary hook
			 *
			 * @hooked projects_template_single_description - 10
			 * @hooked projects_template_single_meta - 20
			 */
			do_action( 'projects_single_project_summary' );
			?>

		</div>
		<!-- .summary -->
		<?php
		global $post;
		$use_vc = get_post_meta( $post->ID, '_use_vc', true );
		$pt_array = ( $pt_array = vc_settings()->get( 'content_types' ) ) ? ( $pt_array ) : vc_default_editor_post_types(); // post type array
		if ( ! in_array( 'project', $pt_array ) || $use_vc == 'no' || $use_vc == '' ) {
			?>
			<div class="post-share-buttons">
				<span><?php echo esc_html__( 'Share ', 'tm-renovation' ); ?></span>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
				   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
					<i class="fa fa-facebook"></i>
				</a>
				<a href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo rawurlencode( the_title( '', '', false ) ); ?>%20-%20<?php the_permalink(); ?>"
				   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
					<i class="fa fa-twitter"></i>
				</a>
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
				   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
					<i class="fa fa-google-plus"></i>
				</a>
			</div>
		<?php } ?>
		<?php
		/**
		 * projects_after_single_project_summary hook
		 *
		 */
		do_action( 'projects_after_single_project_summary' );
		?>

	</div><!-- #project-<?php the_ID(); ?> -->

<?php
/**
 * projects_after_single_project hook
 *
 * @hooked projects_single_pagination - 10
 */
remove_action( 'projects_after_single_project', 'projects_single_pagination', 5 );
do_action( 'projects_after_single_project' );