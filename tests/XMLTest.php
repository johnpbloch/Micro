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
		$data = array(
			'Test',
			'Array',
		);
		$xml = <<<XML
<?xml version = '1.0' encoding = 'utf-8'?>
<foo>
	<bar>Test</bar>
	<bar>Array</bar>
</foo>
XML;
		$control = simplexml_load_string($xml);
		$test = \Micro\XML::from($data, 'foo', NULL, 'bar');
		$this->assertEquals($control, $test);
		$data = array(
			'Test',
			'Array',
			'baz' => 'Bat',
		);
		$xml = <<<XML
<?xml version = '1.0' encoding = 'utf-8'?>
<data>
	<element>Test</element>
	<element>Array</element>
	<baz>Bat</baz>
</data>
XML;
		$control = simplexml_load_string($xml);
		$test = \Micro\XML::from($data);
		$this->assertEquals($control, $test);
		$data = array(
			'Test',
			'Array',
			'baz' => array(
				'foo' => 'bar',
				'baz' => 'bat',
			),
		);
		$xml = <<<XML
<?xml version = '1.0' encoding = 'utf-8'?>
<data>
	<element>Test</element>
	<element>Array</element>
	<baz>
		<foo>bar</foo>
		<baz>bat</baz>
	</baz>
</data>
XML;
		$control = simplexml_load_string($xml);
		$test = \Micro\XML::from($data);
		$this->assertEquals($control, $test);
	}

}
