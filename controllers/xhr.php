<?php

class Xhr extends Controller {

    function __construct() {
        parent::__construct();
    }

    function SignToNewsletter() {
//        $obj = file_get_contents("php://input");
//        $a = json_decode($obj);
//        echo $a->email . $a->name;
        print_r($_POST);
    }

}