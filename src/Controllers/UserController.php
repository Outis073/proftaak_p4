<?php

     class UserController {

        public function index() {

            // Standaard de login pagina
            $this->login();
        }

        public function register() {

            $user = new User();
            
            $view = new View('User/register');
            $view->set('title','Registreer');
            $view->set('content','Registreer als nieuwe klant');

            // Controleer of er een POST is binnengekomen anders leeg formulier tonen
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Controleer het ingevulde formulier
                // "Sanitize" de POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Initialiseer een array met data om te valideren en eventueel error messages aan te maken
                $data = [
                    'email' => trim($_POST['email']),
                    'firstName' => trim($_POST['firstName']),
                    'lastName' => trim($_POST['lastName']),
                    'street' => trim($_POST['street']),
                    'houseNumber' => trim($_POST['houseNumber']),
                    'postalCode' => trim($_POST['postalCode']),
                    'city' => trim($_POST['city']),
                    'telephone' => trim($_POST['telephone']),
                    'password' => trim($_POST['password']),
                    'passwordCheck' => trim($_POST['passwordCheck']),
                    'email_err' => '',
                    'firstName_err' => '',
                    'lastName_err' => '',
                    'street_err' => '',
                    'houseNumber_err' => '',
                    'postalCode_err' => '',
                    'city_err' => '',
                    'telephone_err' => '',
                    'password_err' => '',
                    'passwordCheck_err' => ''
                ];
             
                // Valideer Email
                $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
                
                if(empty($data['email'])) {
                    $data['email_err'] = 1; // Vul aub email adres in
                } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
                    $data['email_err'] = 2; // Onvolledig email adres, gebruik @ en .
                } else {
                    // Check of email adres al voorkomt in de database (email moet uniek zijn)
                    if($user->findUserByEmail($data['email'])) {
                        $data['email_err'] = 3; // Email al in gebruik
                    }
                }

                // Valideer firstName
                if(empty($data['firstName'])) {
                    $data['firstName_err'] = 1; // Vul aub voornaam in
                }

                // Valideer lastName
                if(empty($data['lastName'])) {
                    $data['lastName_err'] = 1; // Vul aub achternaam in
                }

                // Valideer street
                if(empty($data['street'])) {
                    $data['street_err'] = 1; // Vul aub woonplaats in
                }

                // Valideer houseNumber
                if(empty($data['houseNumber'])) {
                    $data['houseNumber_err'] = 1; // Vul aub huisnummer in
                }

                // Valideer postalCode
                if(empty($data['postalCode'])) {
                    $data['postalCode_err'] = 1; // Vul aub postcode in
                } elseif (!strpos($data['postalCode'], ' ') === false) {
                    $data['postalCode_err'] = 2; // Geen spaties in de postcode gebruiken
                } elseif (strlen($data['postalCode']) > 6){
                    $data['postalCode_err'] = 3; // Postcode maximaal 6 karakters
                }

                // Valideer city
                if(empty($data['city'])) {
                    $data['city_err'] = 1; // Vul aub woonplaats in
                }

                // Valideer telephone
                if(empty($data['telephone'])) {
                    $data['telephone_err'] = 1; // Vul aub telefoonnummer in
                }
              
                // Valideer wachtwoord
                // Moet bestaan uit minimaal 6 karakters, kleine letters, hoofdletters en cijfers
                if(empty($data['password'])) {
                    $data['password_err'] = 1; // Vul aub wachtwoord in
                } elseif ((strlen($data['password'])) < 6) {
                    $data['password_err'] = 2; // Wachtwoord moet minimaal 6 karakters zijn
                } elseif (!preg_match("#[0-9]+#", $data['password'] )) {
                    $data['password_err'] = 3; // Wachtwoord moet een cijfer bevatten
                } elseif (!preg_match("#[a-z]+#", $data['password'] )) {
                    $data['password_err'] = 4; // Wachtwoord moet een letter bevatten
                } elseif (!preg_match("#[A-Z]+#", $data['password'] )) {
                    $data['password_err'] = 5; // Wachtwoord moet een hoofdletter bevatten
                } 

                // Valideer controle Password
                if(empty($data['passwordCheck'])) {
                    $data['passwordCheck_err'] = 1; // Vul aub wachtwoord ter controle in
                } else {
                    if($data['password'] != $data['passwordCheck']) {
                        $data['passwordCheck_err'] = 2; // Wachtwoorden zijn niet gelijk
                    }
                }
                
                // Wanneer er geen errors zijn kan de user data naar de database toe
                if(empty($data['email_err']) && empty($data['firstName_err']) && empty($data['lastName_err']) 
                && empty($data['street_err']) && empty($data['houseNumber_err']) && empty($data['postalCode_err'])
                && empty($data['city_err']) && empty($data['telephone_err'])
                && empty($data['password_err']) && empty($data['passwordCheck_err'])) {
                    
                    // Formulier is ok, geen error in de invoer
                    
                    // Het Password versleutelen (hash)
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Vul het user object
                    $user->setAll($data['email'], $data['firstName'], $data['lastName'], $data['street'], $data['houseNumber'], 
                                     $data['postalCode'], $data['city'], $data['telephone'], $data['password']);

                    // User aan de database toegevoegen en, bij succes, naar inlog scherm gaan en bericht tonen via sessie variabele.
                    if($user->register()) {
                        $_SESSION['register_success'] = "Registratie geslaagd. U kunt nu inloggen";

                        header("Location: index.php?controller=user&action=login");

                    } else {
                        die('Error. Er is iets fout gegaan!!!');
                    }; 

                } else {
                    // Wanneer er errors in de input is, laat je de registratie pagina opnieuw zien

                    foreach($data as $key => $value)
                    {
                        $view->set($key,$value);
                    }
                    
                    $view->render();
                }

            } else {
                // Wanneer er nog geen POST is (eerste keer formulier openen), laat je een pagina met een leeg formulier zien

                // Array voor de data creëren
                $data = [
                    'email' => '',
                    'firstName' => '',
                    'lastName' => '',
                    'street' => '',
                    'houseNumber' => '',
                    'postalCode' => '',
                    'city' => '',
                    'telephone' => '',
                    'password' => '',
                    'passwordCheck' => '',
                    'email_err' => '',
                    'firstName_err' => '',
                    'lastName_err' => '',
                    'street_err' => '',
                    'houseNumber_err' => '',
                    'postalCode_err' => '',
                    'city_err' => '',
                    'telephone_err' => '',
                    'password_err' => '',
                    'passwordCheck_err' => ''
                ];

                // Variabelen instellen (leeg) en formulier tonen
                foreach($data as $key => $value)
                {
                    $view->set($key,$value);
                }
                
                $view->render();
            }
        }

        public function login() {
            
            $user = new User();

            $view = new View('User/login');
            //$view->set('title','Login');
            $view->set('content','Vul uw login gegevens in om aan te melden');

            // Controleer of er een POST is binnengekomen anders leeg formulier tonen
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // Controleer het ingevulde formulier

                // "Sanitize" de POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Initialiseer een array met data om te valideren en eventueel error messages aan te maken
                              
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];
                
                // Valideer Email
                $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
               
                if(empty($data['email'])) {
                    $data['email_err'] = 1; // Vul aub email adres in

                } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false){
                    $data['email_err'] = 2; // Onvolledig email adres, gebruik @ en .

                  // Controleer of gebruiker/email in de database voorkomt
                } elseif ($user->findUserByEmail($data['email'])) {
                     // Gebruiker gevonden
                     
                    } else {
                        // Geen gebruiker gevonden
                        $data['email_err'] = 3;
                }
            
                // Valideer controle Password
                if(empty($data['password'])) {
                    $data['password_err'] = 1; // Vul aub wachtwoord in
                }
                // Wanneer er geen errors zijn kan de user data naar de database toe
                if(empty($data['email_err']) && empty($data['password_err'])) {
                    
                    // Formulier is ok, geen error in de invoer
                    $user->setEmail($data['email']);
                    $user->setPassword($data['password']);


                    // Inloggen gebruiker
                   $loggedInUser = $user->login();

                    if($loggedInUser){
                        // Create Session
                        $this->createUserSession($loggedInUser);

                    } else {
                        $data['password_err'] = 2; // Wachtwoord niet correct

                        $view->set('email',$data['email']);
                        $view->set('password',$data['password']);
                        
                        $view->set('email_err',$data['email_err']);
                        $view->set('password_err',$data['password_err']);
                        
                        $view->render();
                    }
                    
                } else {

                    // Init data
                    // Wanneer er errors in de input zijn, laat je de registratie pagina opnieuw zien
                    $view->set('email',$data['email']);
                    $view->set('password',$data['password']);
                    
                    $view->set('email_err',$data['email_err']);
                    $view->set('password_err',$data['password_err']);
                    
                    $view->render();
                }

            } else {
                // Wanneer er nog geen POST is (eerste keer formulier openen), laat je een pagina met een leeg login formulier zien             

                // Array voor de data creëren
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Variabelen instellen (leeg) en formulier tonen
                //$view->set('email',$data['email']);
                $view->set('email','');
                $view->set('password','');

                $view->render();
            }

        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->first_name . ' ' . $user->last_name; //LET OP: variabelen zijn database namen!!!!
            $_SESSION['user_type'] = $user->function; // Admin of klant

            header("Location: index.php");
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['register_success']);

            session_destroy();

            header("Location: index.php?controller=Home");
        }

        public function isLoggedIn(){
            if(isset($_SESSION['user_id'])){
                return true;
            } else {
                return false;
            }
        }

        public function isAdmin(){
            if($_SESSION['user_type'] === 'Admin'){
                return true;
            } else {
                return false;
            }
        }

    }