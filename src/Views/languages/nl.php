<?php
	// $lang = array(
	// 	"title" => "titel",
	// 	"home" => "Home",
	// 	"pricing" => "prijs",
	// 	"contact" => "contact",
	// 	"lang_en" => "Engels",
	// 	"lang_nl" => "Nederlands"
	// );
	
	// eerst lang + controller + variable 
	
	
	// Home pagina
	$langHomeTitle                         = 'Home';
	$langHomeContent                       = 'Welkom bij de site van Vita E-Bikes';
	
	$langHomeTableHeadName				   = 'Naam';
	$langHomeTableHeadImage				   = 'Afbeelding';
	$langHomeTableHeadDescription		   = 'Omschrijving';
	$langHomeTableHeadPrice				   = 'Prijs';
	
	$langHomeAddButton					   = 'Koop Nu Voor';

	$langHomeSaveButton					   = 'Sla winkelwagen op';
	$langHomeOrderButton				   = 'BESTEL NU!';
	

	// Navbar
	$langNavbarHome					   = 'Home';
	$langNavbarContact				   = 'Contact';
	$langNavbarSearch				   = 'Zoek..';
	$langNavbarRegister				   = 'Registreer';
	$langNavbarLogin				   = 'Login';
	$langNavbarLogoff				   = 'Uitloggen';
	
	$langNavbarProducts				   = 'Producten';
	$langNavbarOrders				   = 'Orders';
	$langNavbarSearchResults		   = 'Zoek opdrachten';

	// Contact pagina
	$langContactTitle			       = 'Contact';
	$langContactContent			       = 'Heb je een vraag of opmerking? Neem contact met ons op!';

	$langContactFirstName 		       = 'Voornaam';
	$langContactLastName 		       = 'Achternaam';
	$langContactEmail 			       = 'Email';
	$langContactComment 		       = 'Bericht';
	$langContactButton 			       = 'Verzend';

	// User Login pagina
	$langUserLoginTitle                = 'Inloggen';
	$langUserLoginContent              =  'Vul uw login gegevens in om aan te melden';
	
	$langUserLoginEmail                = 'Gebruikersnaam';
	$langUserLoginEmailPH              = 'E-mail adres';
	$langUserLoginEmailErr             = [1 => 'Vul aub email adres in',
										  2 => 'Onvolledig email adres, gebruik @ en .',
							              3 => 'Geen gebruiker gevonden'];
	
	$langUserLoginPassword             = 'Wachtwoord';
	$langUserLoginPasswordPH           = 'Wachtwoord';
	$langUserLoginPasswordErr          = [1 => 'Vul aub wachtwoord in',
								          2 => 'Wachtwoord niet correct'];
	
	$langUserLoginButton               = 'Inloggen';
	$langUserLoginRegister             = 'Nog geen account? Registreer';
	

	// User Registreer pagina
	$langUserRegisterTitle             = 'Registreer';
	$langUserRegisterContent           = 'Registreer als nieuwe klant';

	$langUserRegisterEmail			   = 'E-mail adres';
	$langUserRegisterEmailErr          = [ 1 => 'Vul aub email adres in',
										   2 => 'Onvolledig email adres, gebruik @ en .',
										   3 => 'Email al in gebruik'];

	$langUserRegisterFirstname         = 'Voornaam';
	$langUserRegisterFirstnameErr      = 'Vul aub voornaam in';

	$langUserRegisterLastname	       = 'Achternaam';
	$langUserRegisterLastnameErr       = 'Vul aub achternaam in';

	$langUserRegisterStreet			   = 'Straat';
	$langUserRegisterStreetErr		   = 'Vul aub woonplaats in';

	$langUserRegisterHouseNumber       = 'Huisnr';
	$langUserRegisterHouseNumberErr    = 'Vul aub huisnummer in';

	$langUserRegisterPostalcode	 	   = 'Postcode';
	$langUserRegisterPostalcodeErr 	   = [1 => 'Vul aub postcode in',
										  2 => 'Geen spaties in de postcode gebruiken',
										  3 => 'Postcode maximaal 6 karakters'];

	$langUserRegisterCity			   = 'Woonplaats';
	$langUserRegisterCityErr		   = 'Vul aub woonplaats in';

	$langUserRegisterTelephone		   = 'Telefoon';
	$langUserRegisterTelephoneErr	   = 'Vul aub telefoonnummer in';

	$langUserRegisterPassword		   = 'Wachtwoord';
	$langUserRegisterPasswordErr	   = [1 => 'Vul aub wachtwoord in',
									      2 => 'Wachtwoord moet minimaal 6 karakters zijn',
										  3 => 'Wachtwoord moet een cijfer bevatten',
										  4 => 'Wachtwoord moet een letter bevatten',
										  5 => 'Wachtwoord moet een hoofdletter bevatten'];
	
	$langUserRegisterPasswordCheck	   = 'Wachtwoord controle';
	$langUserRegisterPasswordCheckErr  = [1 => 'Vul aub wachtwoord ter controle in',
										  2 => 'Wachtwoorden zijn niet gelijk'];

	$langUserRegisterButton            = 'Registreer';
	$langUserRegisterLogin             = 'Al een account? Login'; 


	//Order pagina
	$langOrderGreeting 				   = 'Welkom';
	$langOrderInfo					   = 'Uw order informatie:';
	
	//Zoek pagina
	$langSearchTitle				   = 'Zoeken';
	$langSearchContent 				   = 'Zoekresultaten';

	$langSearchEmpty 				   = 'Geen zoekwaarde opgegeven. U ziet een overzicht van alle fietsen';
	$langSearchLabel				   = 'U heeft gezocht op:';
	$langSearchTableHeaderName 	       = 'Naam';
	$langSearchTableHeaderDescription  = 'Omschrijving';
	$langSearchNoResult 			   = 'Geen zoekresultaat gevonden...';
