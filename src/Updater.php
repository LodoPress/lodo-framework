<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/12/17
 * Time: 8:45 PM
 */

namespace LodoFramework;


use LodoFramework\Utilities\Version;

class Updater {

	public function __construct() {
		add_action( 'after_setup_theme', 'run_updates' );
	}
	
	public function run_updates() {
		if ( Version::__isset() && Version::__get() !== LODOFRAMEWORK_VERSION ) {
			do_action( 'ldfrmwrk_update', LODOFRAMEWORK_VERSION, Version::__get() );
		}
	}
}