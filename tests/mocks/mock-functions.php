<?php

namespace Micro {
	function setcookie(){
		return \Micro\Tests\Mocker::run( 'setcookie', func_get_args() );
	}
}
