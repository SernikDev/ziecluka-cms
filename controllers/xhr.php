<?php

class Xhr extends Controller {

    function __construct() {
        parent::__construct();
        $this->validator = new Validator();
    }

    function SignToNewsletter() {
        print_r($_POST);
    }
    
    function ContactForm() {
        print_r($_POST);
    }

}