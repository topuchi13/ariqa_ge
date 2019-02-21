<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/projects/archive-project.php
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

global $projects_loop;

// Store column count for displaying the grid
if ( empty( $projects_loop['columns'] ) )
	$projects_loop['columns'] = apply_filters( 'projects_loop_columns', 2 );

get_header( 'projects' ); ?>
<div class="content-wrapper row">
  <?php
  /**
   * projects_before_main_content hook
   *
   * @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
   */
  do_action( 'projects_before_main_content' );
  ?>
<?php if ( apply_filters( 'projects_show_page_title', true ) ) : ?>
  <?php if ('bg_color' != $infinity_title_style ) { //If enable heading image ?>
    <div class="big-title image-bg <?php if( 'big-image' == $infinity_title_style  ) { echo 'image-bg--big'; } ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
        <?php if(("on" != $infinity_disable_parallax  || !Kirki::get_option( 'infinity', 'page_style_disable_parallax')) && !$infinity_disable_parallax){ ?>
          data-stellar-background-ratio="0.5"
        <?php } ?>>
      <div class="container">
        <h1 class="entry-title"><?php projects_page_title(); ?></h1>
        <?php do_action( 'projects_archive_description' ); ?>
      </div>
    </div>
  <?php } else { // single color heading ?>
    <div class="big-title color-bg" style="background-color: <?php echo esc_attr($infinity_heading_bg_color); ?>">
      <div class="container">
        <h1 class="entry-title"><?php projects_page_title(); ?></h1>
        <?php do_action( 'projects_archive_description' ); ?>
      </div>
    </div>
  <?php } ?>
<?php endif; ?>
<?php if ( function_exists( 'tm_bread_crumb' ) && Kirki::get_option( 'infinity', 'site_general_breadcrumb_enable' ) == 1 ) { ?>
  <div class="breadcrumb">
    <div class="container">
    <?php echo tm_bread_crumb( array( 'home_label' => Kirki::get_option( 'infinity', 'site_general_breadcrumb_home_text' ) ) ); ?>
    </div>
  </div>
<?php } ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 projects columns-<?php echo esc_attr($projects_loop['columns']); ?>">
        <main class="content">
          <?php if ( have_posts() ) : ?>
            <?php do_action( 'projects_before_loop' ); ?>
            <?php projects_project_loop_start(); ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php projects_get_template_part( 'content', 'project' ); ?>
            <?php endwhile; // end of the loop. ?>
            <?php projects_project_loop_end(); ?>
            <?php do_action( 'projects_after_loop' ); ?>
          <?php else:?>
            <?php projects_get_template( 'loop/no-projects-found.php' ); ?>
          <?php endif;?>
        </main>
      </div>
      </div>
    </div>
    <?php do_action( 'projects_after_main_content' ); ?>
  </div>
</div>
<?php get_footer( 'projects' ); ?>