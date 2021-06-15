<?php

    class User extends Model {
        protected $id;
        protected $email;
        protected $firstName;
        protected $lastName;
        protected $street;
        protected $houseNumber;
        protected $postalCode;
        protected $city;
        protected $telephone;
        protected $password;
        
        public function __construct(string $email = '', string $firstName = '', string $lastName = '', string $street = '', string $houseNumber = '', string $postalCode = '', string $city = '', string $telephone = '', string $password = '', string $passwordCheck = '') {

            $this->email = $email;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->street = $street;
            $this->houseNumber = $houseNumber;
            $this->postalCode = $postalCode;
            $this->city = $city;
            $this->telephone = $telephone;
            $this->password = $password;
            $this->passwordCheck = $password;

        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setAll(string $email, string $firstName, string $lastName, string $street, string $houseNumber, 
                               string $postalCode, string $city, string $telephone , string $password) {

            $this->email = $email;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->street = $street;
            $this->houseNumber = $houseNumber;
            $this->postalCode = $postalCode;
            $this->city = $city;
            $this->telephone = $telephone;
            $this->password = $password;
        }

        public function register() : int {
            $pdo = DB::connect();	

            $query = 'INSERT INTO users (email, password_hash, first_name, last_name, street, house_number, postal_code, city, phone, active, function) 
                      VALUES (:email, :password, :firstName, :lastName, :street, :houseNumber, :postalCode, :city, :telephone, :active, :function)';
                
            try
                {
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([
                        ':email' => $this->email, 
                        ':password' => $this->password,
                        ':firstName' => $this->firstName,
                        ':lastName' => $this->lastName,
                        ':street' => $this->street,
                        ':houseNumber' => $this->houseNumber,
                        ':postalCode' => $this->postalCode,
                        ':city' => $this->city,
                        ':telephone' => $this->telephone,
                        ':active' => 1,
                        ':function' => 'customer'
                    ]);
                } catch (PDOException $e) {
                    throw new Exception('Database query error');
                }

            return $pdo->lastInsertId();
        }

        public function login(){

            $pdo = DB::connect();

            $query = 'SELECT * FROM users WHERE email = :email';
            $stmt = $pdo->prepare($query);

            $stmt->execute([
                ':email' => $this->email
            ]);

            $row = $stmt->fetch(\PDO::FETCH_OBJ);
            $hashed_password = $row->password_hash;

            if(password_verify($this->password,$hashed_password)) {
                return $row;
            } else {
                return false;
            }


        }

        // Find user by email
        public function findUserByEmail($email){

            $pdo = DB::connect();
            
            $query = 'SELECT * FROM users WHERE email = :email';
            $stmt = $pdo->prepare($query);

            $stmt->execute([
                ':email' => $email
            ]);

            // Check Row
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
        
    }

   