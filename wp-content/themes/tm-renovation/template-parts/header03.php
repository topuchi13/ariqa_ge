<?php if ( has_nav_menu( 'social' ) || Kirki::get_option( 'infinity', 'top_layout_enable' ) == 1 ) { ?>
	<div class="site-top">
		<div class="container">
			<div class="row middle">
				<div class="col-sm-12 col-md-10">
					<?php dynamic_sidebar( 'top-left-widget' ); ?>
				</div>

				<?php if ( has_nav_menu( 'social' ) ) { ?>
					<div class="col-sm-2 end-lg">
						<?php wp_nav_menu( array(
							                   'theme_location'  => 'social',
							                   'menu_id'         => 'social-menu-top',
							                   'container_class' => 'social-menu hidden-xs hidden-sm hidden-md',
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

			<div class="col-xs-8 col-sm-6 col-lg-2 site-branding">
				<?php echo TM_Renovation_Templates::logo() ?>
			</div>

			<div class="col-xs-4 col-sm-1 hidden-lg last-sm last-md end mobile-buttons">
				<?php echo TM_Renovation_Templates::mobile_menu_btn(); ?>
			</div>

			<div class="col-xs-12 col-sm-5 col-lg-10 center-xs center-sm center-md">
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

						<?php echo TM_Renovation_Templates::site_menu( $class . ' start-xs start-sm' ); ?>

						<?php if ( $search_enable || ( class_exists( 'WooCommerce' ) && $mini_cart_enable ) ) { ?>
							<div class="col-xs-12 <?php echo esc_attr( $class2 ); ?> end-sm end-lg">
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