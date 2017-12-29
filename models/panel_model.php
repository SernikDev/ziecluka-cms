<?php

class Panel_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    public function checkAuth($login = null, $password) {
        
        $pass = null;
        $hash = null;
        
        $account = $this->db->select("SELECT A.`salt`, A.`pass`, A.`id`, A.`fname`, A.`lname`, B.`path` FROM `user` A LEFT JOIN `upload` B ON A.`image_id` = B.`id` WHERE A.`login` = :login;", array(
            ":login" => $login
        ));
        if(!empty($account)){
            
        
        $pass = $password . $account[0]["salt"];
        $hash = $account[0]["pass"];
        }
        
        if(password_verify($pass, $hash)){
            Session::init();
            Session::set("loggedIn", true);
            Session::set("fname", $account[0]["fname"]);
            Session::set("lname", $account[0]["lname"]);
            Session::set("userid", $account[0]["id"]);
            Session::set("avatar", $account[0]["path"]);
            Session::set("error", "");
            Session::set("success", "");
            Session::set("warning", "");
            header("Location: " . URL . "panel");
        }
        else {
            return false;
        }
    }
}
