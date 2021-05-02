<?php
    class Artist {

        private $con;
        private $id;
        private $name;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;

            $query = $con->prepare("SELECT * FROM musicify_artists WHERE id=:id");
            $query->bindParam(":id", $this->id);
            $query->execute();

            $artistData = $query->fetch(PDO::FETCH_ASSOC);
            $this->name = $artistData["name"];
        }

        public function getName() {
            return $this->name;
        }

    }
?>