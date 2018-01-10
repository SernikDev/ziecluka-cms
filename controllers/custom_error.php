<?php

class CustomError extends Controller {

    function __construct() {
        parent::__construct();
        $this->main = new Main();
    }

    function index() {
        $this->view->render('error/index');
    }

}
