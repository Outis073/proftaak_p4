<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{	

	/*
	 * Test constructor, stel email en wachtoord in op het object, 
	 * en controlleer met assertEquals en assertNotEquals.
	 */
	public function testConstructor()
	{
		$user = new User();
		$user->set('email', 'unittest@test.com');
		$user->set('password', 'NepWachtwoord1');

		$this->assertEquals($user->get('email'), 'unittest@test.com');
		$this->assertEquals($user->get('password'), 'NepWachtwoord1');
		$this->assertNotEquals($user->get('email'), 'fake@fake.nl');
		$this->assertNotEquals($user->get('password'), 'W@chtW00rd');
				
	}

	/*
	 * Test login methode, maak een user object aan.
	 * Zorg dat de gebruiker in de database bestaat met alle attributen ingevuld.
	 * Controleer ook id van de gebruiker en pas het eventueel aan in de test.
	 * Stel email en wachtoord in op het object, 
	 * en controlleer met assertEquals door data van de user op te vragen.
	 */
	public function testLogin()
	{
		$user = new User();
		$user->set('email', 'unittest@test.com');
		$user->set('password', 'NepWachtwoord1');

		$row = $user->login();

		$this->assertEquals($row->id, 15);
		$this->assertEquals($row->email, 'unittest@test.com');
		$this->assertEquals($row->first_name, 'Unit');
		$this->assertEquals($row->last_name, 'Test');
		$this->assertEquals($row->street, 'Teststraat');
		$this->assertEquals($row->house_number, '99');
		$this->assertEquals($row->postal_code, '1234AA');
		$this->assertEquals($row->city, 'Testdorp');
		$this->assertEquals($row->phone, '+31 111 111111');
		$this->assertEquals($row->active, '1');
		$this->assertEquals($row->function, 'customer');


	}
    
	/*
	 * Test registreren van een gebruiker, maak een user object aan.
	 * Stel email en wachtoord in op het object, 
	 * en controlleer met assertEquals door het id van de nieuwe user op te vragen.
	 * 
	 * LET OP!!!!
	 * Om deze test te laten slagen:
	 * 
	 * Voer onderstaande query uit om het nieuwe autoincrement id te vinden:
	 *      SELECT auto_increment AS NEXT_ID
	 *      FROM   `information_schema`.`tables`
	 *      WHERE  table_name = "users" AND table_schema = "vitaebikes"
	 * 
	 * Uit de query komt een getal. dit is het volgende id wat wordt gebruikt bij
	 * het aanmaken van een nieuwe gebruiker.
	 * Vul dit getal in als resultaat voor de assertEquals methode.
	 * 
	 * Voor de test uit. Deze moet OK als resultaat geven.
	 * Verwijder de aangemaakte test gebruiker weer uit de database, zodat je
	 * onderstaande gebruiker bij een volgende test weer kunt gebruiken.
	 * 
	*/
	public function testRegister()
	{
		$user = new User();

		$user->set('email','unittest2@test.com');
		$user->set('password','NepWachtwoord2');
		$user->set('firstname','Unit 2');
		$user->set('lastname','Test');
		$user->set('street','Testerlaan');
		$user->set('houseNumber','125');
		$user->set('postalCode','9999ZZ');
		$user->set('city','Testerdam');
		$user->set('telephone','+31 222 222222');
		$user->set('active','1');
		$user->set('function','admin');
		
		$newUser = $user->register();

		$this->assertEquals($newUser, 16);

	}

		/*
		 * Test setAll methode.
		 * Maakt een user object aan.
		 * Stel alle attributen van het user object in (behalve function en active), 
		 * en controlleer met assertEquals door data van de user op te vragen.
		 */
	public function testSetAll(){

		$user = new User();

		$user->setAll('unittest2@test.com','Unit 2','Test','Testerlaan','125',
					  '9999ZZ', 'Testerdam','+31 222 222222','NepWachtwoord2');

		$this->assertEquals($user->get('email'),'unittest2@test.com');
		$this->assertNotEquals($user->get('email'),'fakeemail@dummy.com');
		$this->assertEquals($user->get('street'),'Testerlaan');
		$this->assertNotEquals($user->get('street'),'Foutstraat');
		$this->assertEquals($user->get('postalCode'),'9999ZZ');
		$this->assertNotEquals($user->get('postalCode'),'1111AA');
		$this->assertEquals($user->get('telephone'),'+31 222 222222');
		$this->assertNotEquals($user->get('telephone'),'+31 111 111111');
	}

		/*
		 * Test findUserByEmail methode.
		 * zorg dat de gebruiker unittest@test.com in de database bestaat.
		 * Maakt een user object aan.
		 * Stel een email adres in die voorkomt in de user tabel van de database.
		 * Controlleer met assertTrue en assertFalse door methode aan te roepen.
		 */
	public function testFindUserByEmail(){
		$user = new User;

		$email = 'unittest@test.com';

		$this->assertTrue($user->findUserByEmail($email));
		$this->assertFalse($user->findUserByEmail('dummy@test.com'));
	}
}