<?php

/**
 * Class for Main Functions
 */
class Main extends Bootstrap {

    function __construct() {
        $this->db = new Database();
    }

    public function getSeo($id) {
        return $this->db->select("SELECT B.`pid`, B.`title`, B.`description` FROM `alias` A LEFT JOIN `seo` B ON A.`id` = B.`pid` AND A.`id` = :id;", array(
            ":id" => $id
        ));
    }
    
    public function getBlogId($id) {
        $sql = "SELECT `id` FROM `alias` WHERE `controller` = :id;";
        $binds = array(":id" => "blog/view/{$id}");
        
        if($this->db->numRows($sql, $binds)->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function getTitle($id) {
        $test = $this->getSeo($id);
        return $test[0]['title'];
    }

    public function getId($id) {
        $test = $this->getSeo($id);
        return $test[0]['pid'];
    }

    public function getDescription($id) {
        $test = $this->getSeo($id);
        return $test[0]['description'];
    }

    public function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getIniUploadMaxFilesize() {
        $i = ini_get("upload_max_filesize");
        $l = strlen($i);
        $unit = substr($i, -1);
        $bytes = substr($i, 0, $l - 1);

        switch (strtolower($unit)) {
            case "k": $bytes *= 1024;
            case "m": $bytes *= 1024;
            case "g": $bytes *= 1024;
        }

        return $bytes;
    }

    public function getIniPostMaxSize() {
        $i = ini_get("post_max_size");
        $l = strlen($i);
        $unit = substr($i, -1);
        $bytes = substr($i, 0, $l - 1);

        switch (strtolower($unit)) {
            case "k": $bytes *= 1024;
            case "m": $bytes *= 1024;
            case "g": $bytes *= 1024;
        }

        return $bytes;
    }

}
