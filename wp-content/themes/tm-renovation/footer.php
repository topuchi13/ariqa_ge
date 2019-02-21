<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Renovation
 */
?>

</div><!-- #content -->
<?php if ( is_active_sidebar( 'footer' ) ) { ?>
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
				<div class="col-md-4">
					<?php dynamic_sidebar( 'footer2' ); ?>
				</div>
				<div class="col-md-4">
					<?php dynamic_sidebar( 'footer3' ); ?>
				</div>
			</div>
		</div>
		<div class="hidden-xs hidden-sm hidden-md">
			<?php TM_Renovation_Templates::social_links( false ); ?>
		</div>
	</footer>
<?php } ?>
<?php if ( Kirki::get_option( 'infinity', 'copyright_layout_enable' ) == 1 ) { ?>
	<div class="copyright">
		<div class="container">
			<div class="row middle">
				<div class="col-xs-12 center">
					<?php echo html_entity_decode( Kirki::get_option( 'infinity', 'copyright_layout_text' ) ); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
</div><!-- #page -->

<?php if ( Kirki::get_option( 'infinity', 'site_general_back_to_top' ) == 1 ) { ?>
	<a class="scrollup"><i class="fa fa-angle-up"></i>Go to top</a>
<?php } ?>

<?php wp_footer(); ?>

<!-- BS:SNIPPET--><script type='text/javascript' id="__bs_script__">//<![CDATA[
    document.write("<script async src='/browser-sync/browser-sync-client.2.6.0.js'><\/script>".replace("HOST", location.hostname));
//]]></script><!-- BS:SNIPPET:END-->
</body>
</html>