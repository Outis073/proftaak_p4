<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase 
{
	/*
	 * Test constructor, stel firstName, lastName, email en text in op het object, 
	 * en controlleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$contact = new Contact();
		$contact->set('firstName', 'Kees');
		$contact->set('lastName', 'de Tester');
		$contact->set('email', 'kdetester@dummy.com');
		$contact->set('text', 'Test contact formulier');

		$this->assertEquals($contact->get('firstName'), 'Kees');
		$this->assertEquals($contact->get('lastName'), 'de Tester');
		$this->assertEquals($contact->get('email'), 'kdetester@dummy.com');
		$this->assertEquals($contact->get('text'), 'Test contact formulier');
		$this->assertEquals($contact->get('firstName'), 'Kees');
		$this->assertEquals($contact->get('firstName'), 'Kees');
	}

}
