<?php

class Page_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }
    

    
}