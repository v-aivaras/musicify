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

        public function getSongIds() {
            $query = $this->con->prepare("SELECT id FROM musicify_songs WHERE artist=:id ORDER BY plays DESC");
            $query->bindParam(":id", $this->id);
            $query->execute();

            $songArray  = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($songArray, $row['id']);
            }

            return $songArray;
        }
    }
?>