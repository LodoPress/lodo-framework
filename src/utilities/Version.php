<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/12/17
 * Time: 8:47 PM
 */

namespace LodoFramework\Utilities;


class Version {

	const option_name = 'ldframework_version';

	public static $version;

	public static function __get() {

		if ( null === self::$version ) {
			self::$version = get_option( self::option_name );
		}

		return self::$version;

	}

	public static function __set() {
		update_option( self::option_name, LODOFRAMEWORK_VERSION, true );
	}

	public static function __isset() {
		return (bool) self::__get();
	}

}