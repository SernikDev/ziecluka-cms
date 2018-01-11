<?php

class Page_Admin extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
    }

    function index() {
        Session::checkSession();

        $this->view->metaTitle = "Page";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/page/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

}
