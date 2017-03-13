<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/12/17
 * Time: 12:14 AM
 */

namespace LodoFramework;

use LodoFramework\Admin\Notice;

class Load {

	public function __construct() {
		add_action( 'init', [ $this, 'load_admin' ] );
		add_action( 'init', [ $this, 'load_frontend' ] );
		add_action( 'init', [ $this, 'load_both' ] );
		$this->load_early();
	}
	
	public function load_admin() {
		if ( is_admin() ) {
			new Admin\Init();
			new Notice();
		}
	}

	public function load_frontend() {
		if ( ! is_admin() ) {

		}
	}

	public function load_both() {
		
	}

	private function load_early() {
		new Install();
		new Updater();
	}

}
