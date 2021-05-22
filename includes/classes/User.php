<?php
    class User {

        private $con;
        private $username;

        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getName() {
            $query = $this->con->prepare("SELECT concat(firstName, ' ', lastName) 
                    as 'name' FROM musicify_users WHERE username=:username");
            $query->bindParam(":username", $this->username);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['name'];
        }

        public function getEmail() {
            $query = $this->con->prepare("SELECT email FROM musicify_users WHERE username=:username");
            $query->bindParam(":username", $this->username);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['email'];
        }
    }
?>