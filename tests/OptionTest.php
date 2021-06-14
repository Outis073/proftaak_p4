<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase 
{
	/*
	 * Test constructor, stel id, name, price, category en image in op het object, 
	 * en controlleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$option = new Option();
		$option->set('id', '1');
		$option->set('name', 'fietstas');
		$option->set('price', '35.00');
		$option->set('category', 'Tassen');
		$option->set('image', 'fietstas.jpg');
		
		$this->assertEquals($option->get('id'), '1');
		$this->assertEquals($option->get('price'), '35.00');
		$this->assertEquals($option->get('image'), 'fietstas.jpg');

		$this->assertNotEquals($option->get('name'), 'xxxxx');
		$this->assertNotEquals($option->get('price'), '0.00');
		$this->assertNotEquals($option->get('category'), 'qqqqqq');
	}

}
