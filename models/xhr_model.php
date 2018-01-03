<?php

class Xhr_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

}
