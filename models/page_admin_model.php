<?php

class Page_Admin_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

}
