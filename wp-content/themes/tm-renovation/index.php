<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Renovation
 */
$infinity_layout                 = Kirki::get_option( 'infinity', 'archive_layout' );

$infinity_title_style       =  Kirki::get_option( 'infinity', 'page_style_heading_style' );
$infinity_heading_bg_image  =  Kirki::get_option( 'infinity', 'page_heading_bg_image' );
$infinity_heading_bg_color  =  Kirki::get_option( 'infinity', 'page_heading_bg_color' );
$infinity_heading_color     =  Kirki::get_option( 'infinity', 'page_style_heading_font_color' );
$infinity_disable_parallax  =  !Kirki::get_option( 'infinity', 'page_style_disable_parallax' );

get_header(); ?>
<?php if ('bg_color' != $infinity_title_style ) { //If enable heading image ?>
	<div class="big-title image-bg <?php if( 'big-image' == $infinity_title_style  ) { echo 'image-bg--big'; } ?>" style="background-image: url('<?php echo esc_url( $infinity_heading_bg_image ); ?>')"
		<?php if(("on" != $infinity_disable_parallax  || !Kirki::get_option( 'infinity', 'page_style_disable_parallax')) && !$infinity_disable_parallax){ ?>
			data-stellar-background-ratio="0.5"
		<?php } ?>>
		<div class="container">
			<h1 class="entry-title" itemprop="headline"><?php esc_html_e( 'Blog', 'tm-renovation' ) ?></h1>
		</div>
	</div>
<?php } else { // single color heading ?>
	<div class="big-title color-bg" style="background-color: <?php echo esc_attr($infinity_heading_bg_color); ?>">
		<div class="container">
			<h1 class="entry-title" itemprop="headline"><?php echo esc_html_e( 'Blog', 'tm-renovation' ) ?></h1>
		</div>
	</div>
<?php } ?>
<div class="container">
	<div class="row">
		<?php $class = $infinity_layout != 'full-width' ? 'col-sm-8 col-md-9' : 'col-sm-12'; ?>
		<div class="<?php echo esc_attr( $class ); ?>">
			<main class="content" role="main">
				<?php if ( have_posts() ) : ?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
						?>
					<?php endwhile; ?>
					<?php TM_Renovation_Templates::paging_nav(); ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</main>
			<!-- .content -->
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
