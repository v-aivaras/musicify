<?php
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = Array();
        }

        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            } else {
                return false;
            }
        }

        public function login($un, $pw) {
            $pw = hash("sha512", $pw);
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
            $query->bindParam(":un", $un);
            $query->bindParam(":pw", $pw);
            $query->execute();

            if($query->rowCount() !== 0) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw){
            $pw = hash("sha512", $pw);
            $profilePic = "assets/images/prifile-pics/default.png";
            $date = date("Y-m-d H:i:s");

            $query = $this->con->prepare("INSERT INTO users (username, firstName, lastName, email, password, signUpDate, profilePic) 
                                    VALUES (:un, :fn, :ln, :em, :pw, :d, :pic)");
            $query->bindParam(":un", $un);
            $query->bindParam(":fn", $fn);
            $query->bindParam(":ln", $ln);
            $query->bindParam(":em", $em);
            $query->bindParam(":pw", $pw);
            $query->bindParam(":d", $date);
            $query->bindParam(":pic", $profilePic);
            
            return $query->execute();
        }


        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function validateUsername($un) {
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            $query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
            $query->bindParam(":un", $un);
            $query->execute();
            
            if($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
            }
        }
        
        private function validateFirstName($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }
        
        private function validateLastName($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }
        
        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
            $query->bindParam(":em", $em);
            $query->execute();
            
            if($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
            }
        }
        
        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if(strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }

    }


?>