<?php

namespace LodoFramework\Admin;

class Init {

	private $capability;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_page' ] );
		$this->capability = apply_filters( 'lodoframework_admin_page_capability', 'manage_options' );
	}

	public function add_page() {

		add_menu_page(
			__( 'LodoThemes Framework', 'lodo-framework' ),
			__( 'Lodo Framework', 'lodo-framework' ),
			$this->capability,
			'lodo-framework',
			[ $this, 'admin_page_markup' ],
			'dashicons-tagcloud',
			66
		);

	}

	public function admin_page_markup() {
		echo '<h1>TEST</h1>';
	}
}