<?php
/**
 * The template for displaying all single posts.
 *
 * @package Renovation
 */
$infinity_layout = Kirki::get_option( 'infinity', 'post_layout' );

$infinity_heading_enable   = Kirki::get_option( 'infinity', 'post_style_heading_enable' );
$infinity_heading_text     = Kirki::get_option( 'infinity', 'post_style_heading_text' );
$infinity_title_style      = Kirki::get_option( 'infinity', 'post_style_heading_style' );
$infinity_heading_bg_image = Kirki::get_option( 'infinity', 'post_heading_bg_image' );
$infinity_heading_bg_color = Kirki::get_option( 'infinity', 'post_heading_bg_color' );
$infinity_heading_color    = Kirki::get_option( 'infinity', 'post_style_heading_font_color' );
$infinity_disable_parallax = ! Kirki::get_option( 'infinity', 'post_style_disable_parallax' );

get_header(); ?>
<?php if ( $infinity_heading_enable == 1 ) { ?>
	<?php if ( 'bg_color' != $infinity_title_style ) { //If enable heading image ?>
		<div class="big-title big-title--single image-bg <?php if ( 'big-image' == $infinity_title_style ) {
			echo 'image-bg--big';
		} ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
			<?php if ( ( "on" != $infinity_disable_parallax || ! Kirki::get_option( 'infinity', 'post_style_disable_parallax' ) ) && ! $infinity_disable_parallax ) { ?>
				data-stellar-background-ratio="0.5"
			<?php } ?>>
			<div class="container">
				<h1 class="entry-title" itemprop="headline"
				    style="color: <?php echo esc_attr( $infinity_heading_color ); ?>"><?php echo $infinity_heading_text; ?></h1>
			</div>
		</div>
	<?php } else { // single color heading ?>
		<div class="big-title big-title--single color-bg"
		     style="background-color: <?php echo esc_attr( $infinity_heading_bg_color ); ?>">
			<div class="container">
				<h1 class="entry-title" itemprop="headline"
				    style="color: <?php echo esc_attr( $infinity_heading_color ); ?>"><?php echo $infinity_heading_text; ?></h1>
			</div>
		</div>
	<?php } ?>
<?php } ?>
<?php if ( function_exists( 'tm_bread_crumb' ) && Kirki::get_option( 'infinity', 'site_general_breadcrumb_enable' ) == 1 ) { ?>
	<div class="breadcrumb">
		<div class="container">
			<?php echo tm_bread_crumb( array( 'home_label' => Kirki::get_option( 'infinity', 'site_general_breadcrumb_home_text' ) ) ); ?>
		</div>
	</div>
<?php } ?>
	<div
		class="container" <?php if ( $infinity_heading_enable == 0 ) { ?> style="<?php echo esc_attr( "margin-top:70px;" ); ?>"<?php } ?>>
		<div class="row">
			<?php $class = $infinity_layout != 'full-width' ? 'col-sm-8 col-md-9' : 'col-sm-12'; ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<div class="content">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single' ); ?>
						<?php //the_post_navigation(); ?>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>