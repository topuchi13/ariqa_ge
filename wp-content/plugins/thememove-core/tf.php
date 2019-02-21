<?php
if ( ! function_exists( 'infinity_base_encode' ) ) {
	function infinity_base_encode( $data ) {
		return base64_encode( $data );
	}
}

if ( ! function_exists( 'infinity_base_decode' ) ) {
	function infinity_base_decode( $data ) {
		return base64_decode( $data );
	}
}

if ( ! function_exists( 'is_tree' ) ) {
	function is_tree( $pid ) {
		global $post;
		if ( is_page() && ( $post->post_parent == $pid || is_page( $pid ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}