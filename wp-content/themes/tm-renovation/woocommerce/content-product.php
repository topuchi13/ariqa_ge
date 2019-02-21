<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

$classes = 'col-sm-' . ceil(12/$woocommerce_loop['columns']);
?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

  <div class="product-thumb">

    <a href="<?php the_permalink(); ?>" class="product-thumb-link">

      <?php
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
      ?>

      <?php

      /**
       * woocommerce_after_shop_loop_item hook
       *
       * @hooked woocommerce_template_loop_add_to_cart - 10
       */
      do_action( 'woocommerce_after_shop_loop_item' );

      ?>

    </a>

  </div>

  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

  <?php
  /**
   * woocommerce_after_shop_loop_item_title hook
   *
   * @hooked woocommerce_template_loop_rating - 5
   * @hooked woocommerce_template_loop_price - 10
   */
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
  add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
  add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
  do_action( 'woocommerce_after_shop_loop_item_title' );
  ?>

</div>
