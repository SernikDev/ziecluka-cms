<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
        $this->main = new Main();
    }
    
    function index() {
        $this->view->render('error/index');
    }

    function view($id = null) {
        /**
         * If there is no param in database it will generate an error
         */
        if (empty($this->main->getPageId($id))) {
            $this->view->render('error/index');
        } else {
            $this->view->render('page/view');
        }
    }

}
