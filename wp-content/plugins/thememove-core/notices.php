<?php
if ( is_admin() && class_exists( 'Essential_Grid_Admin' ) ) {
	global $EssentialAsTheme;
	$EssentialAsTheme = true;
    remove_action( 'admin_notices', array( Essential_Grid_Admin::get_instance(), 'add_activate_notification' ) );
}

if ( is_admin() && class_exists( 'RevSliderAdmin' ) && isset( $productAdmin ) ) {
	global $revSliderAsTheme;
	$revSliderAsTheme = true;
    remove_action( 'admin_notices', array( $productAdmin, 'addActivateNotification' ) );

	if ( get_option( 'revslider-valid' ) == 'false' ) {
		update_option( 'revslider-valid', 'true' );
	}
}

if ( is_admin() && function_exists( 'vc_manager' ) ) {
    add_action( 'admin_print_scripts-post.php', 'infinity_vc_remove_notice', 15 );
    function infinity_vc_remove_notice() {
        remove_action( 'admin_notices', array( vc_manager()->license(), 'adminNoticeLicenseActivation', ) );
    }
}

if ( is_admin() ) {
	add_filter( 'vc_settings_tabs', 'infinity_remove_vc_setting_tab' );

	function infinity_remove_vc_setting_tab( $tabs ) {
		unset( $tabs['vc-updater'] );

		return $tabs;
	}
}

add_action( 'init', 'infinity_remove_vc_tgm_update_notice' );
function infinity_remove_vc_tgm_update_notice() {
 global $vc_manager;
 if ( ! empty( $vc_manager ) ) {
  $updater = $vc_manager->updater();
  remove_filter( 'upgrader_pre_download', array( $updater, 'preUpgradeFilter' ), 10 );

  remove_filter( 'pre_set_site_transient_update_plugins', array( $updater->updateManager() , 'check_update') );
 }
}