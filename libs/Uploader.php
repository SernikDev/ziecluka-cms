<?php

class Uploader {

    function __construct() {
        $this->db = new Database();   
    }

    private $_files = array();
    private $_message = array();
    private $_path = null;
    private $_status = array();
    private $_model = array();
    private $_modelpath = null;
    private $_modeltype = null;

    public function setPath($path) {
        $this->_modelpath = $path;
        return $this->_path = getcwd() . $path;
    }
    
    public function setType($data) {
        return $this->_modeltype = $data;
    }

    public function fileValidation($file) {
        $this->_files = $_FILES[$file];

        for ($i = 0; $i < count($this->_files["tmp_name"]); $i++) {

            //check for error
            if ($this->_files["error"][$i] !== UPLOAD_ERR_OK) {
                $this->_message["error"][$i]["name"] = $this->_files["name"][$i];
                switch ($this->_files["error"][$i]) {
                    case 1:
                        $this->_message["error"][$i]["status"] = "Wybrany plik ma powyżej 6MB. Nie został on wysłany na serwer.";
                        break;
                    case 3:
                        $this->_message["error"][$i]["status"] = "Wybrany plik nie został w całości wysłany. Spróbuj wysłać go ponownie.";
                        break;
                    case 4:
                        $this->_message["error"][$i]["status"] = "Nie wybrano żadnego z plików. Spróbuj ponownie.";
                        break;
                    case 6:
                        $this->_message["error"][$i]["status"] = "Error 6: Skontaktuj się z administratorem.";
                        break;
                    case 7:
                        $this->_message["error"][$i]["status"] = "Error 7: Skontaktuj się z administratorem.";
                        break;
                    case 8:
                        $this->_message["error"][$i]["status"] = "Error 8: Skontaktuj się z administratorem.";
                        break;
                }
            } else {
                //check for file type
                if ($this->checkType($i) === false) {
                    $this->_message["error"][$i]["name"] = $this->_files["name"][$i];
                    $this->_message["error"][$i]["status"] = "Wybrany plik ma nieprawidłowe rozszerzenie.";
                } else {
                    $this->_message["success"][$i]["name"] = $this->_files["name"][$i];
                    $this->_message["success"][$i]["status"] = "Wysyłanie pliku zakończone sukcesem.";
                    
                    // Set unique name, for example if there is a 1.jpg it will generate 1-1.jpg, 1-2.jpg
                    $newname = $this->setUniqueName($this->_modelpath, $this->_files["name"][$i]);
                    
                    $this->sendFile($this->_files["tmp_name"][$i], $this->_path . $newname);                   
                    $this->_model[$i] = ["filename" => $newname, "size" => $this->_files["size"][$i], "path" => $this->_modelpath, "type" => $this->_modeltype]; 
                }
            }
        }
    }
    
    /**
     * Function checking in database if file with that name exists and set unique name if its in database
     * @param string $path - path where file will be moved
     * @param string $name - just file name
     * @return string - return unique file name
     */
    public function setUniqueName($path, $name){
        $x=1;
        $f = explode(".",$name)[0];
        $c = explode(".",$name)[0];
        $e = explode(".",$name)[1];
        $newname = null;
        $select = $this->db->numRows("SELECT * FROM `upload` WHERE `path` = :filepath;", array(
            ":filepath" => $path . $name
        ));
        
        // check for exact name
        if($select->rowCount() == 0){
            $newname = $name;
        } else {
            do {
            $h = $f . "-" . $x . "." . $e;
            $try = $this->db->numRows("SELECT * FROM `upload` WHERE `path` = :filepath;", array(
                ":filepath" => $path . $h
            ));
            
            $newname = $c . "-" . $x . "." . $e;
            $x++;
        } while($try->rowCount() == 1);
        }
        return $newname;        
    }

    /**
     * Function that checking if file is a image
     * @param int $id - file number from posted array
     * @return boolean
     */
    public function checkType($id) {
        $this->types = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($this->_files["type"][$id], $this->types, true)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMessages() {

        //only error
        if (isset($this->_message["error"]) && !isset($this->_message["success"])) {
            $this->_status = [1 => "error"];
            $message = "";
            foreach ($this->_message["error"] as $key => $value) {
                $message .= $value["name"] . " - " . $value["status"] . "<br/><br/>";
            }
            array_push($this->_status, $message);
            return $this->_status;
            exit();
        }
        //only success
        if (isset($this->_message["success"]) && !isset($this->_message["error"])) {
            $this->_status = [1 => "success"];
            $message = "";
            foreach ($this->_message["success"] as $key => $value) {
                $message .= $value["name"] . " - " . $value["status"] . "<br/><br/>";
            }
            array_push($this->_status, $message);
            return $this->_status;
            exit();
        }
        //warning contains both error and success
        if (isset($this->_message["error"]) && isset($this->_message["success"])) {
            $this->_status = [1 => "warning"];
            $message = "";
            foreach ($this->_message["success"] as $key => $value) {
                $message .= $value["name"] . " - " . $value["status"] . "<br/><br/>";
            }
            foreach ($this->_message["error"] as $key => $value) {
                $message .= $value["name"] . " - " . $value["status"] . "<br/><br/>";
            }
            array_push($this->_status, $message);
            return $this->_status;
            exit();
        }
    }

    /**
     * Function that sends file to server
     * @param mixed $temp_name - temporary name of file on server
     * @param mixed $file - file name to send to server
     */
    public function sendFile($temp_name, $file) {
        move_uploaded_file($temp_name, $file);
    }
    
    public function getModel() {
        return $this->_model;
    }
    
}
