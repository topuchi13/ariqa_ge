<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="product-share-buttons">
	<span><?php echo esc_html__( 'Share on:', 'tm-renovation' ); ?></span>
	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
	   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
		<i class="fa fa-facebook"></i>
	</a>
	<a href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo rawurlencode(the_title('', '', false)); ?>%20-%20<?php the_permalink(); ?>"
	   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
		<i class="fa fa-twitter"></i>
	</a>
	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
	   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
		<i class="fa fa-google-plus"></i>
	</a>
</div>

