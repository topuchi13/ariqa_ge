<?php
/**
 * Show options for ordering
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="col-sm-6 end-sm">
	<form class="woocommerce-ordering" method="get">
		<h4><?php esc_html_e('Shop filter', 'tm-renovation'); ?></h4>
		<select name="orderby" class="orderby">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option
					value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<input type="hidden" name="paged" value="1" />
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
	</form>
</div>