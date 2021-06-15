<?php
	// $lang = array(
	// 	"title" => "My Amazing Website",
	// 	"home" => "Home",
	// 	"pricing" => "Pricing",
	// 	"contact" => "Contact",
	// 	"lang_en" => "English",
	// 	"lang_nl" => "Dutch"
	// );

	// eerst lang + controller + variable 
	// Home pagina
	$langTitle                         = "Home";
	$langContent                       = "Welcome to VitaeBikes";

	// Navbar
	$langNavbarHome					   = 'Home';
	$langNavbarContact				   = 'Contact';
	$langNavbarSearch				   = 'Search..';
	$langNavbarRegister				   = 'Register';
	$langNavbarLogin				   = 'Login';
	$langNavbarLogoff				   = 'Logout';

	$langNavbarProducts				   = 'Products';
	$langNavbarOrders				   = 'Orders';
	$langNavbarSearchResults		   = 'Searches';

	// Contact pagina
	$langContactTitle			       = 'Contact';
	$langContactContent			       = 'Do you have a question or a remark? Contact us!';

	$langContactFirstName 		       = 'First name';
	$langContactLastName 	           = 'Last name';
	$langContactEmail 			       = 'Email';
	$langContactComment 		       = 'Comment';
	$langContactButton 			       = 'Submit';


	// User Login pagina
	$langUserLoginTitle                = 'Login';
	$langUserLoginContent              = 'Enter your credentials to logon';
	
	$langUserLoginEmail                = 'Username';
	$langUserLoginEmailPH              = 'E-mail address';
	$langUserLoginEmailErr             = [1 => 'Please enter E-mail address',
							              2 => 'Wrong email address. Use @ en .',
							              3 => 'User not found'];

	$langUserLoginPassword             = 'Password';
	$langUserLoginPasswordPH           = 'Password';
	$langUserLoginPasswordErr          = [1 => 'Please fill in password',
								          2 => 'Password incorrect'];

	$langUserLoginButton               = 'Logon';
	$langUserLoginRegister             = 'No account yet? Register';

	
	// User Registreer pagina
	$langUserRegisterTitle             = 'Register';
	$langUserRegisterContent           = 'Register as a new customer';
	
	$langUserRegisterEmail			   = 'E-mail address';
	$langUserRegisterEmailErr          = [ 1 => 'Please fill in password',
									       2 => 'incomplete email address, use @ and .',
									       3 => 'E-mail already in use'];

	$langUserRegisterFirstname         = 'First name';
	$langUserRegisterFirstnameErr      = 'Please enter your first name';

	$langUserRegisterLastname	       = 'Last name';
	$langUserRegisterLastnameErr       = 'Please enter your last name';

	$langUserRegisterStreet			   = 'Street';
	$langUserRegisterStreetErr		   = 'Please enter street';

	$langUserRegisterHouseNumber       = 'House number';
	$langUserRegisterHouseNumberErr    = 'Please enter house number';

	$langUserRegisterPostalcode	 	   = 'Postal Code';
	$langUserRegisterPostalcodeErr 	   = [1 => 'Please enter your postal code',
										2 => 'Please don\'t use spaces',
										3 => 'Postcal code maximum of 6 characters'];

	$langUserRegisterCity			   = 'City';
	$langUserRegisterCityErr		   = 'Please enter city';

	$langUserRegisterTelephone		   = 'Telephone';
	$langUserRegisterTelephoneErr	   = 'Please enter telephone number';
	
	$langUserRegisterPassword		   = 'Password';
	$langUserRegisterPasswordErr	   = [1 => 'Please enter a password',
										2 => 'Password needs to be minimal 6 characters long',
										3 => 'Password must contain a number',
										4 => 'Password must contain a letter',
										5 => 'Password must contain a uppercase letter'];
	
	$langUserRegisterPasswordCheck	   = 'Password check';
	$langUserRegisterPasswordCheckErr  = [1 => 'Please enter password for verification',
										2 => 'Passwords are not the same'];

	$langUserRegisterButton            = 'Register';
	$langUserRegisterLogin             = 'Already have an account? Logon'; 


	//Order pagina

	$langOrderGreeting 				  = 'Welcome';
	$langOrderInfo					  = 'Your order information:'
	
?>