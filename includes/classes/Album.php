<?php
    class Album {

        private $con;
        private $id;
        private $title;
        private $artistId;
        private $genreId;
        private $artworkPath;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;

            $query = $con->prepare("SELECT * FROM albums WHERE id=:id");
            $query->bindParam(":id", $this->id);
            $query->execute();

            $albumtData = $query->fetch(PDO::FETCH_ASSOC);
            $this->title = $albumtData["title"];
            $this->artistId = $albumtData["artist"];
            $this->genreId = $albumtData["genre"];
            $this->artworkPath = $albumtData["artworkPath"];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtist() {
            return new Artist($this->con, $this->artistId);
        }

        public function getArtworkPath() {
            return $this->artworkPath;
        }

        public function getGenre() {
            return $this->genreId;
        }

        public function getNumberOfSongs() {
            $query = $this->con->prepare("SELECT id FROM songs WHERE album=:id");
            $query->bindParam(":id", $this->id);
            $query->execute();

            return $query->rowCount();
        }
    }
?>