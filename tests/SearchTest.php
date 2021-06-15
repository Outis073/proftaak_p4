<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase 
{
	/*
	 * Test constructor, stel id, term en date in op het object, 
	 * en controleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$search = new Search();

		$search->set('id', '25');
		$search->set('term', 'motor');
		$search->set('date', '2021-06-15');
		
		$this->assertEquals($search->get('id'), '25');
		$this->assertEquals($search->get('term'), 'motor');

		$this->assertNotEquals($search->get('term'), 'fiets');
		$this->assertNotEquals($search->get('date'), '1999-01-01');
		
	}
		

}
