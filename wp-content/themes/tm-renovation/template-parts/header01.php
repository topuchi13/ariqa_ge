<?php if ( ( has_nav_menu( 'top-left' ) || has_nav_menu( 'top-right' ) ) && Kirki::get_option( 'infinity', 'top_layout_enable' ) == 1 ) { ?>
	<div class="site-top">
		<div class="container">
			<div class="row middle">
				<?php if ( has_nav_menu( 'top-left' ) ) { ?>
					<div class="col-sm-5 col-md-6">
						<?php wp_nav_menu( array(
							                   'theme_location'  => 'top-left',
							                   'menu_id'         => 'top-left-menu',
							                   'container_class' => 'top-left-menu',
							                   'fallback_cb'     => false,
						                   ) ); ?>
					</div>
				<?php } ?>

				<?php if ( has_nav_menu( 'top-right' ) ) { ?>
					<div class="col-sm-7 col-md-6">
						<?php wp_nav_menu( array(
							                   'theme_location'  => 'top-right',
							                   'menu_id'         => 'top-right-menu',
							                   'container_class' => 'top-right-menu',
							                   'fallback_cb'     => false,
						                   ) ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
<header class="site-header">
	<div class="container">
		<div class="row middle-xs middle-sm middle-md">

			<div class="col-xs-8 col-lg-2 site-branding">
				<?php echo TM_Renovation_Templates::logo(); ?>
			</div>

			<div class="col-xs-4 hidden-lg end mobile-buttons">
				<?php echo TM_Renovation_Templates::mobile_menu_btn(); ?>
			</div>

			<div class="col-xs-12 col-lg-10 center-xs center-sm center-md">
				<div class="header-right">
					<div class="row middle">
						<?php

						$search_enable    = Kirki::get_option( 'infinity', 'header_layout_search_enable' );
						$mini_cart_enable = Kirki::get_option( 'infinity', 'header_layout_mini_cart_enable' );

						if ( $search_enable || ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) ) {
							$class  = 'col-lg-10';
							$class2 = 'col-lg-2';
						} else {
							$class = 'col-lg-12';
						} ?>

						<div class="col-xs-12 col-sm-9 <?php echo esc_attr( $class ); ?> start-xs start-sm">
							<?php dynamic_sidebar( 'header-right' ); ?>
						</div>
						<?php if ( $search_enable || ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) ) { ?>
							<div class="col-xs-12 col-sm-3 <?php echo esc_attr( $class2 ); ?> end-sm end-lg">

								<?php if ( $search_enable ) {
									echo TM_Renovation_Templates::search_box();
								} ?>

								<?php if ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) { ?>
									<div class="mini-cart">
										<?php echo TM_Renovation_Templates::minicart(); ?>
										<div class="widget_shopping_cart_content"></div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hidden-xs hidden-sm hidden-md">
		<?php echo TM_Renovation_Templates::social_links(); ?>
	</div>
</header>
<!-- #masthead -->

<?php echo TM_Renovation_Templates::site_menu(); ?>
