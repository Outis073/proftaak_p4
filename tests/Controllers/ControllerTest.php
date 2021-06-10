<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
	public function testConstructor()
	{
		$controller = new Controller("Product", "index");
		$result =  $controller->getController();

		$this->assertEquals('ProductController', $result);
	}
	
}