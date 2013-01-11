<?php

class XMLTest extends PHPUnit_Framework_TestCase
{

	public function test_from()
	{
		$data = array(
			'Test',
			'Array',
		);
		$xml = <<<XML
<?xml version = '1.0' encoding = 'utf-8'?>
<data>
	<element>Test</element>
	<element>Array</element>
</data>
XML;
		$control = simplexml_load_string($xml);
		$test = \Micro\XML::from($data);
		$this->assertEquals($control, $test);
	}

}
