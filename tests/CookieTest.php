<?php

use \Micro\Tests\Mocker;
use \Micro\Cipher;
use \Micro\Cookie;

class CookieTest extends PHPUnit_Framework_TestCase
{
	private $backup = array();
	private $config = array(
		'key'      => 'Tt7*{&;@2o((3<_',
		'timeout'  => 0,
		'expires'  => 0,
		'path'     => '/',
		'domain'   => '',
		'secure'   => '',
		'httponly' => '',
	);

	public function setUp()
	{
		$this->backup = $_COOKIE;
		$_COOKIE = array();

		$this->config['timeout'] = time() + 60*60*4;
		Cookie::$settings = $this->config;

		Mocker::reset();
		Mocker::set( 'setcookie', function( $name, $value ) {
			if( $value )
				$_COOKIE[$name] = $value;
			else
				unset($_COOKIE[$name]);
		});
	}

	public function tearDown()
	{
		$_COOKIE = $this->backup;
		$this->backup = array();
		Mocker::reset();
	}

	public function test_set(){
		Cookie::set( 'test', 'Test Value' );
		$decoded = json_decode( Cipher::decrypt( base64_decode( $_COOKIE['test'] ), $this->config['key'] ) );
		$this->assertEquals( 'Test Value', $decoded[1] );
	}

	public function test_get(){
		$encoded = base64_encode( Cipher::encrypt( json_encode( array( time(), 'Test Value' ) ), $this->config['key'] ) );
		$_COOKIE['test'] = $encoded;
		$this->assertEquals( 'Test Value', Cookie::get( 'test' ) );
	}

	public function test_delete(){
		$_COOKIE['dummy'] = 'Some value';
		Cookie::set( 'dummy', '' );
		$this->assertArrayNotHasKey( 'dummy', $_COOKIE );
	}

	public function test_expired_cookie(){
		$encoded = base64_encode( Cipher::encrypt( json_encode( array( time() + 60*60*5, 'Test Value' ) ), $this->config['key'] ) );
		$_COOKIE['test'] = $encoded;
		$this->assertFalse( Cookie::get( 'test' ) );
	}
}
