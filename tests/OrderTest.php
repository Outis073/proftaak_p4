<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase 
{
	/*
	 * Test constructor, stel id, date, delivery_date, payment_option en status in op het object, 
	 * en controleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$order = new Order();
		$order->set('id', '1');
		$order->set('date', '2021-06-17');
		$order->set('delivery_date', '2021-09-21');
		$order->set('payment_option', 'iDeal');
		$order->set('status', 'closed');
		
		$this->assertEquals($order->get('id'), '1');
		$this->assertEquals($order->get('date'), '2021-06-17');

		$this->assertNotEquals($order->get('payment_option'), 'Visa');
		$this->assertNotEquals($order->get('status'), 'open');
		
	}
		

}
