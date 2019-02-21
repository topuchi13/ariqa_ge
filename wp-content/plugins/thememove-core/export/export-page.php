<div class="wrapper">
	<div class="content">
		<table>
			<tbody>
			<tr>
				<td scope="row" width="150"><h1><?php esc_html_e( 'Export', 'tm-core' ); ?></h1></td>
			</tr>
			<tr valign="middle">
				<td>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="content"/>
						<input type="submit" value="<?php echo esc_html__( 'Content', 'tm-core' ); ?>" name="export"
						       class="button button-primary"/>
					</form>
					<br/>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="sidebars"/>
						<input type="submit" value="<?php echo esc_html__( 'Sidebars', 'tm-core' ); ?>" name="export"
						       class="button button-primary"/>
					</form>
					<br/>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="widgets"/>
						<input type="submit" value="<?php echo esc_html__( 'Widgets', 'tm-core' ); ?>" name="export"
						       class="button button-primary"/>
					</form>
					<br/>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="thememove_menus"/>
						<input type="submit" value="<?php echo esc_html__( 'Menus', 'tm-core' ); ?>" name="export"
						       class="button button-primary"/>
					</form>
					<br/>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="page_options"/>
						<input type="submit" value="<?php echo esc_html__( 'Page Options', 'tm-core' ); ?>"
						       name="export" class="button button-primary"/>
					</form>
					<br/>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="customizer_options"/>
						<input type="submit" value="<?php echo esc_html__( 'Customizer Options', 'tm-core' ); ?>" name="export"
						       class="button button-primary"/>
					</form>
					<br/>

					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
						<form method="post" action="">
							<input type="hidden" name="export_option" value="woocommerce"/>
							<input type="submit" value="<?php echo esc_html__( 'WooCommerce Settings', 'tm-core' ); ?>"
							       name="export"
							       class="button button-primary"/>
						</form>
						<br/>
					<?php } ?>

					<?php if ( class_exists( 'WooCommerce' ) && class_exists('Insight_Attribute_Swatches') ) { ?>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="isw"/>
						<input type="submit" value="<?php echo esc_html__( 'Insight Attribute Swatches', 'tm-core' ); ?>"
						       name="export"
						       class="button button-primary"/>
					</form>
					<br/>
					<?php } ?>

					<?php if ( class_exists( 'Essential_Grid' ) ) { ?>
						<form method="post" action="">
							<input type="hidden" name="export_option" value="essential_grid"/>
							<input type="submit" value="<?php echo esc_html__( 'Essential Grid', 'tm-core' ); ?>"
							       name="export" class="button button-primary"/>
						</form>
						<br/>
					<?php } ?>

					<?php if ( class_exists( 'RevSliderAdmin' ) ) { ?>
						<!--form method="post" action="">
							<input type="hidden" name="export_option" value="rev_sliders"/>
							<input type="submit" value="<?php echo esc_html__( 'Revolution Slider', 'tm-core' ); ?>"
							       name="export" class="button button-primary"/>
						</form-->
						<br/>
					<?php } ?>

					<form method="post" action="">
						<input type="hidden" name="export_option" value="media_package"/>
						<input type="text" name="demo" value="thememove01"/>
						<input type="submit" value="<?php echo esc_html__( 'Media Package', 'tm-core' ); ?>"
						       name="export" class="button button-primary"/>
					</form>
					<br/>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>