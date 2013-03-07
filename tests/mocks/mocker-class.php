<?php

namespace Micro\Tests;

class Mocker {
	private static $callbacks = array();

	public static function set( $function, $callback )
	{
		self::$callbacks[$function] = $callback;
	}

	public static function run( $function, array $args = array() )
	{
		if (
			!empty( self::$callbacks[$function] ) &&
			is_callable( self::$callbacks[$function] )
		) {
			return call_user_func_array( self::$callbacks[$function], $args );
		}
	}

	public static function reset()
	{
		self::$callbacks = array();
	}
}
