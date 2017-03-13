<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/12/17
 * Time: 5:14 PM
 */

namespace LodoFramework;


class Install {

	public function __construct() {
		register_activation_hook( LODOFRAMEWORK_PLUGIN_FILE, [ $this, 'activation' ] );
	}

	public static function activation() {
		update_option( 'ldframework_version', LODOFRAMEWORK_VERSION, true );
	}

	public static function run_activation_manually() {

		$current_screen = get_current_screen();

		if ( 'toplevel_page_lodo-framework' === $current_screen->id ) {

			$run_activation = ( isset( $_GET['run-activation'] ) ) ? sanitize_text_field( $_GET['run-activation'] ) : false;
			$nonce = ( isset( $_GET['nonce'] ) ) ? sanitize_text_field( $_GET['nonce'] ) : '';

			if ( 'true' === $run_activation && false !== wp_verify_nonce( $nonce, 'lodo-activation' ) ) {
				self::activation();
			}
		}

	}

}