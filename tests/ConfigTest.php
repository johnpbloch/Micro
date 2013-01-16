<?php

class ConfigTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Config
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new \Micro\Config(__DIR__ . '/configs/base.php');
	}

	public function test__construct()
	{
		try {
			$config = new \Micro\Config(__DIR__ . '/configs/thisfileshouldntexist');
			$this->fail('No exception on bad file');
		} catch(\Exception $exc) {
			$this->assertTrue($exc instanceof \Exception);
		}
		$config = new \Micro\Config(__DIR__ . '/configs/empty.php');
		$this->assertEmpty($config->all());
		$this->assertInternalType('array', $config->all());
	}

	public function test__get()
	{
		$this->assertEquals('bar', $this->object->foo);
		$this->assertEquals('bat', $this->object->baz);
		$this->assertInternalType('array', $this->object->db);
	}

	public function testAll()
	{
		$expected = array(
			'foo' => 'bar',
			'baz' => 'bat',
			'db' => array(
				'name' => 'myDb',
				'user' => 'dbUser',
				'pass' => 'dbPass',
				'host' => 'localhost'
			)
		);
		$this->assertEquals($expected, $this->object->all());
	}

}
