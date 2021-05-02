<?php
    class Song {

        private $con;
        private $id;
        private $sqlData;
        private $title;
        private $artistId;
        private $albumId;
        private $genreId;
        private $duration;
        private $path;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;

            $query = $con->prepare("SELECT * FROM musicify_songs WHERE id=:id");
            $query->bindParam(":id", $this->id);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            $this->title = $this->sqlData['title'];
            $this->artistId = $this->sqlData['artist'];
            $this->albumId = $this->sqlData['album'];
            $this->genreId = $this->sqlData['genre'];
            $this->duration = $this->sqlData['duration'];
            $this->path = $this->sqlData['path'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtist() {
            return new Artist($this->con, $this->artistId);
        }

        public function getAlbum() {
            return new Album($this->con, $this->albumId);
        }

        public function getGenre() {
            return $this->genreId;
        }

        public function getPath() {
            return $this->path;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getSqlData() {
            return $this->sqlData;
        }
    }
?>