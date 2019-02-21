<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Renovation
 */
$infinity_title_style      = Kirki::get_option( 'infinity', 'page_style_heading_style' );
$infinity_heading_bg_image = Kirki::get_option( 'infinity', 'page_heading_bg_image' );
$infinity_heading_bg_color = Kirki::get_option( 'infinity', 'page_heading_bg_color' );
$infinity_heading_color    = Kirki::get_option( 'infinity', 'page_style_heading_font_color' );
$infinity_disable_parallax = ! Kirki::get_option( 'infinity', 'page_style_disable_parallax' );

$infinity_layout = Kirki::get_option( 'infinity', 'archive_layout' );

get_header(); ?>
<?php if ( 'bg_color' != $infinity_title_style ) { //If enable heading image ?>
	<div class="big-title image-bg <?php if ( 'big-image' == $infinity_title_style ) {
		echo 'image-bg--big';
	} ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
		<?php if ( ( "on" != $infinity_disable_parallax || ! Kirki::get_option( 'infinity', 'page_style_disable_parallax' ) ) && ! $infinity_disable_parallax ) { ?>
			data-stellar-background-ratio="0.5"
		<?php } ?>>
		<div class="container">
			<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</div>
	</div>
<?php } else { // single color heading ?>
	<div class="big-title color-bg" style="background-color: <?php echo esc_attr( $infinity_heading_bg_color ); ?>">
		<div class="container">
			<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
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
			<?php $class = $infinity_layout != 'full-width' ? 'col-sm-8 col-md-9' : 'col-sm-12'; ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<main class="content">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'blog' ); ?>
						<?php endwhile; // end of the loop. ?>
						<?php TM_Renovation_Templates::paging_nav(); ?>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>
				</main>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>