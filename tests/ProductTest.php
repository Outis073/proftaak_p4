<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase 
{
	/*
	 * Test constructor, stel id, name, description, price en image in op het object, 
	 * en controleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$product = new Product();
		$product->set('id', '99');
		$product->set('name', 'Vita-XL');
		$product->set('description', 'Luxe uitvoering');
		$product->set('price', '2100.00');
		$product->set('image', 'vitaxl.jpg');
		
		$this->assertEquals($product->get('id'), '99');
		$this->assertEquals($product->get('name'), 'Vita-XL');

		$this->assertNotEquals($product->get('price'), '0.00');
		$this->assertNotEquals($product->get('image'), 'bike.jpg');
		
	}
		

}
