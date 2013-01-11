<?php

class CipherTest extends PHPUnit_Framework_TestCase
{

	public function test_encrypt()
	{
		$key = 'Lb|PBe8*vU)L2nX1h>,<mur+JBcgxvrO';
		$text = 'Some text';
		$encrypted_text = \Micro\Cipher::encrypt($text, $key);
		$this->assertNotEmpty($encrypted_text);
		$this->assertNotEquals($encrypted_text, $text);
	}

	public function test_decrypt()
	{
		$key = 'gC5|kt4HiJwUe7SS2do<0nb5016^sQ3D';
		$text = 'Some text';
		$encrypted_text = \Micro\Cipher::encrypt($text, $key);
		$decrypted_text = \Micro\Cipher::decrypt($encrypted_text, $key);
		$this->assertEquals($text, $decrypted_text);
	}

}

