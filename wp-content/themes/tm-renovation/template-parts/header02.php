<?php if ( ( has_nav_menu( 'social' ) || has_nav_menu( 'top-right' ) ) && Kirki::get_option( 'infinity', 'top_layout_enable' ) == 1 ) { ?>
	<div class="site-top">
		<div class="container">
			<div class="row middle">

				<div class="col-sm-5 col-md-6 hidden-xs hidden-sm hidden-md">
					<?php TM_Renovation_Templates::social_links(); ?>
				</div>

				<?php if ( has_nav_menu( 'top-right' ) ) { ?>
					<div class="col-sm-7 col-md-6">
						<?php wp_nav_menu( array(
							                   'theme_location'  => 'top-right',
							                   'menu_id'         => 'top-right-menu',
							                   'container_class' => 'top-right-menu end-md',
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

				<div class="col-xs-12 col-lg-10">
					<div class="header-right table-row">
						<div class="row middle">
							<div class="col-lg-2 hidden-xs hidden-sm hidden-md"></div>

							<?php

							$search_enable    = Kirki::get_option( 'infinity', 'header_layout_search_enable' );
							$mini_cart_enable = Kirki::get_option( 'infinity', 'header_layout_mini_cart_enable' );

							if ( $search_enable || ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) ) {
								$class  = 'col-lg-8';
								$class2 = 'col-lg-2';
							} else {
								$class = 'col-lg-12';
							} ?>

							<div class="col-xs-12 col-sm-10 <?php echo esc_attr( $class ); ?>">
								<?php dynamic_sidebar( 'header-right' ); ?>
							</div>
							<?php if ( $search_enable || ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) ) { ?>
								<div
									class="col-xs-12 col-sm-2 <?php echo esc_attr( $class2 ); ?> center-xs end-sm end-lg">
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
	</header>
	<!-- #masthead -->

<?php echo TM_Renovation_Templates::site_menu(); ?>