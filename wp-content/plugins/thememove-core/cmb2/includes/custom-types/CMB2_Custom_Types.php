<?php

wp_enqueue_style( 'cmb2-custom-types', plugins_url( 'css/cmb2-custom-types.css', __FILE__ ) );

require_once( trailingslashit( dirname( __FILE__ ) ) . 'TM_CMB2_Type_Number.php' );
require_once( trailingslashit( dirname( __FILE__ ) ) . 'TM_CMB2_Type_RGBa_Picker.php' );
require_once( trailingslashit( dirname( __FILE__ ) ) . 'TM_CMB2_Type_Post_Search.php' );
require_once( trailingslashit( dirname( __FILE__ ) ) . 'TM_CMB2_Type_Select2.php' );