<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
        $this->main = new Main();
    }

    function index() {
        $this->view->render('page/index');
    }

    function view($id) {
        $this->view->getTitle = $this->main->getTitle($id);
        $this->view->getId = $this->main->getId($id);
        $this->view->getDescription = $this->main->getDescription($id);

        /**
         * If there is no param in database it will generate an error
         */
        if (empty($this->main->getId($id))) {
            $this->view->render('error/index');
        } else {
            $this->view->render('page/view');
        }
    }

}
