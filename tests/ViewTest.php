<?php

include_once __DIR__ . '/mocks/View.php';

class ViewTest extends PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		$this->view = new View('default');
	}

	/**
	 * @dataProvider set_provider
	 */
	public function test_set($data)
	{
		$this->view->set($data);
		foreach($data as $k => $v)
		{
			$this->assertObjectHasAttribute($k, $this->view);
			$this->assertEquals($v, $this->view->$k);
		}
	}

	public function set_provider()
	{
		return array( array( array(
					'a' => 'z',
					'b' => 'y',
					'c' => 'z'
				)));
	}

	public function test___to_string()
	{
		$this->assertEquals('Default View', trim($this->view));
	}

}
