<?php

namespace LodoFramework\Admin;

use LodoFramework\Install;

class Init {

	private $capability;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_page' ] );
		$this->capability = apply_filters( 'ldframework_admin_page_capability', 'manage_options' );
	}

	public function add_page() {

		$hook = add_menu_page(
			__( 'LodoThemes Framework', 'lodo-framework' ),
			__( 'Lodo Framework', 'lodo-framework' ),
			$this->capability,
			'lodo-framework',
			[ $this, 'admin_page_markup' ],
			'dashicons-tagcloud',
			66
		);

		add_action( 'load-' . $hook, [ $this, 'run_activation' ], 1 );

	}

	public function run_activation() {
		Install::run_activation_manually();
	}

	public function admin_page_markup() {
		echo '<h1>TEST</h1>';
	}
}