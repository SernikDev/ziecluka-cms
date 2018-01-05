<?php

class Xhr_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }
    
    public function signToNewsletter($data){
        
        $this->db->insert("INSERT INTO `news_user` (`name`, `email`, `create_date`) VALUES (:name, :email, NOW());", array(
            ':name' => $data['name'],
            ':email' => $data['email']
        ));
    }
    
    public function contactForm($data){
        
        $this->db->insert("INSERT INTO `message` (`name`, `email`, `topic`, `text`, `data_send`) VALUES (:name, :email, :topic, :text, NOW());", array(
            ':name' => $data['fkname'],
            ':email' => $data['fkemail'],
            ':topic' => $data['fktopic'],
            ':text' => $data['fkmessage']
        ));
    }
}
