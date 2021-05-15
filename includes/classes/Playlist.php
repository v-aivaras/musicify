<?php
    class Playlist {

        private $con;
        private $id;
        private $name;
        private $owner;

        public function __construct($con, $data) {

            if(!is_array($data)) {
                $query = $con->prepare("SELECT * FROM musicify_playlists WHERE id=:id");
                $query->bindValue(":id", $data);
                $query->execute();
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }
            $this->con = $con;
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->owner = $data['owner'];
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getOwner() {
            return $this->owner;
        }

        public function getNumberOfSongs() {
            $query = $this->con->prepare("SELECT songId FROM musicify_playlistSongs WHERE playlistId=:id");
            $query->bindValue(":id", $this->id);
            $query->execute();
            return $query->rowCount();
        }

        public function getSongIds() {
            $query = $this->con->prepare("SELECT songId FROM musicify_playlistSongs WHERE playlistid=:id ORDER BY playlistOrder ASC");
            $query->bindParam(":id", $this->id);
            $query->execute();

            $songArray  = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($songArray, $row['songId']);
            }

            return $songArray;
        }

        public static function getPlaylistDropdown($con, $username) {
            $dropdown = '<select class="item playlist">
                            <option value="">Add to playlist</option>';
            $query = $con->prepare("SELECT id, name FROM musicify_playlists WHERE owner=:username");
            $query->bindValue(":username", $username);
            $query->execute();   
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $name = $row['name'];
                $dropdown .= "<option value='{$id}'>{$name}</option>";
            }
            
            return $dropdown . '</select>';
        }
    }
?>