<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/12/17
 * Time: 5:22 PM
 */

namespace LodoFramework\Admin;


class Notice {

	public function __construct() {
		add_action( 'admin_notices', [ $this, 'activation_notice'] );
	}

	public function activation_notice() {

		$current_screen = get_current_screen();

		if ( 'toplevel_page_lodo-framework' === $current_screen->id ) {

			$run_activation = ( isset( $_GET['run-activation'] ) ) ? sanitize_text_field( $_GET['run-activation'] ) : false;
			$get_nonce = ( isset( $_GET['nonce'] ) ) ? sanitize_text_field( $_GET['nonce'] ) : '';

			if ( false === get_option( 'ldframework_version') ) {

				$nonce = wp_create_nonce( 'lodo-activation' );
				$url = add_query_arg( array( 'page' => $current_screen->parent_file, 'nonce' => $nonce, 'run-activation' => 'true' ), admin_url( 'admin.php' ) );

				echo '<div class="notice notice-error">';
				echo '<p>' . esc_html__( 'It looks like the plugin activation never ran.', 'lodo-framework' ) . ' ';
				echo '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Click Here', 'lodo-framework' ) . '</a> ';
				echo esc_html__( 'to run the activation manually.', 'lodo-framework' );
				echo '</p>';
				echo '</div>';

			} else if ( 'true' === $run_activation && wp_verify_nonce( $get_nonce, 'lodo-activation' ) ) {

				echo '<div class="notice notice-success">';
				echo '<p>' . esc_html__( 'Plugin activation successfully ran.', 'lodo-framework' ) . '</p>';
				echo '</div>';

			}

		}

	}
}