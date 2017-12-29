<?php

class Media_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    public function insertFiles($data) {
        if (empty($data)) {
            return false;
        } else {
            foreach ($data as $key => $value) {
                $this->db->insert("INSERT INTO `upload` (`filename`, `size`, `path`, `type`, `upload_date`) VALUES (:filename, :size, :path, :type, NOW());", array(
                    ":filename" => $value["filename"],
                    ":size" => $value["size"],
                    ":path" => $value["path"] . $value["filename"],
                    ":type" => $value["type"]
                ));
            }
        }
    }
    
    public function showGallery($path) {
        return $this->db->select("SELECT * FROM `upload` WHERE `type` = :path;", array(
            ":path" => $path
        ));
    }
    
    public function deleteFile($data) {
        $this->db->delete("DELETE FROM `upload` WHERE `id` = :id;", array(
            ":id" => $data
        ));
    }
    
    public function getFilePath($data) {
        return $this->db->select("SELECT `id`, `path` FROM `upload` WHERE `id` = :id;", array(
            ":id" => $data
        ));
    }

}
