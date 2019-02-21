<?php
/**
 * The Template for displaying all single projects.
 *
 * Override this template by copying it to yourtheme/projects/single-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$infinity_title_style       =  Kirki::get_option( 'infinity', 'page_style_heading_style' );
$infinity_heading_bg_image  =  Kirki::get_option( 'infinity', 'page_heading_bg_image' );
$infinity_heading_bg_color  =  Kirki::get_option( 'infinity', 'page_heading_bg_color' );
$infinity_heading_color     =  Kirki::get_option( 'infinity', 'page_style_heading_font_color' );
$infinity_disable_parallax  =  !Kirki::get_option( 'infinity', 'page_style_disable_parallax' );

get_header( 'projects' );

?>
<?php if ('bg_color' != $infinity_title_style ) { //If enable heading image ?>
	<div class="big-title image-bg <?php if( 'big-image' == $infinity_title_style  ) { echo 'image-bg--big'; } ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
		<?php if(("on" != $infinity_disable_parallax  || !Kirki::get_option( 'infinity', 'page_style_disable_parallax')) && !$infinity_disable_parallax){ ?>
			data-stellar-background-ratio="0.5"
		<?php } ?>>
		<div class="container">
			<?php the_title( '<h1 class="entry-title" itemprop="headline" itemprop="headline">', '</h1>' ); ?>
		</div>
	</div>
<?php } else { // single color heading ?>
	<div class="big-title color-bg" style="background-color: <?php echo esc_attr($infinity_heading_bg_color); ?>">
		<div class="container">
			<?php the_title( '<h1 class="entry-title" itemprop="headline" itemprop="headline">', '</h1>' ); ?>
		</div>
	</div>
<?php } ?>
<?php if ( function_exists( 'tm_bread_crumb' ) && Kirki::get_option( 'infinity', 'site_general_breadcrumb_enable' ) == 1 ) { ?>
	<div class="breadcrumb">
		<div class="container">
			<?php echo tm_bread_crumb( array( 'home_label' => Kirki::get_option( 'infinity', 'site_general_breadcrumb_home_text' ) ) ); ?>
		</div>
	</div>
<?php } ?>
<div class="container">
  <div class="row">
	<?php
	/**
	* projects_before_main_content hook
	*
	* @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
	*/
	do_action( 'projects_before_main_content' );
	?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php if (class_exists('WPBakeryVisualComposerAbstract')) {
			global $post;
			$use_vc = get_post_meta($post->ID, '_use_vc', true);

			// Check if Project post type is available to Visual Composer
			$pt_array = ( $pt_array = vc_settings()->get( 'content_types' ) ) ? ( $pt_array ) : vc_default_editor_post_types(); // post type array
			if ( !in_array('project', $pt_array) ) {
				projects_get_template_part( 'content', 'single-project' );
			} else {
				if ( 'yes' == $use_vc ) {
					the_content();
				} else {
					projects_get_template_part( 'content', 'single-project' );
				}
			}
		} ?>
		<?php endwhile; // end of the loop. ?>
		<?php
		/**
		 * projects_after_main_content hook
		 *
		 * @hooked projects_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'projects_after_main_content' );
		?>

		</div>
	</div>
<?php get_footer( 'projects' );