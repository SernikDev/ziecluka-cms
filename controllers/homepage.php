<?php

class Homepage extends Controller {

    function __construct() {
        parent::__construct();
        $this->main = new Main();
    }

    function index() {
        $this->view->metaTitle = "Strona Główna - ziecluka.pl";
        $this->view->css = "public/css/main.css";
        $this->view->blog = $this->model->getBlog(4);
        $this->view->render('header');
        $this->view->render('layout/header');
        $this->view->render('homepage/content');
        $this->view->render('layout/footer');
    }

}
