<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce functions
 *
 * @package TM_Renovation_Framework
 * @since   3.0
 */
if ( ! class_exists( 'TM_Renovation_Woo' ) ) {

	class TM_Renovation_Woo {

		function __construct() {

			// Mini cart AJAX
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'get_cart_fragment' ) );
			add_action( 'wp_ajax_tm_renovation_remove_cart_item', array( $this, 'remove_cart_item' ) );
			add_action( 'wp_ajax_nopriv_tm_renovation_remove_cart_item', array( $this, 'remove_cart_item' ) );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		}

		/*
		 * Add .mini-cart__button to add to cart fragment
		 */
		function get_cart_fragment( $fragments ) {

			ob_start();

			echo TM_Renovation_Templates::minicart();
			$fragments['.mini-cart__button'] = ob_get_clean();

			return $fragments;
		}

		public function refresh_cart_fragments() {

			$cart_ajax = new WC_AJAX();
			$cart_ajax->get_refreshed_fragments();

			exit();
		}

		public function remove_cart_item() {

			$cart         = WC()->instance()->cart;
			$cart_item_key   = $_POST['cart_item_key'];

			$cart->remove_cart_item( $cart_item_key );

			$this->refresh_cart_fragments();
		}

		function related_products_args( $args ) {
			$args['posts_per_page'] = 3; // 3 related products
			$args['columns']        = 3; // arranged in 3 columns

			return $args;
		}
	}

	new TM_Renovation_Woo();
}