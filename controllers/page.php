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
            $this->view->metaTitle = $this->model->pageInfo($id)[0]["page_seo_title"];
            $this->view->metaDescription = $this->model->pageInfo($id)[0]["page_seo_description"];
            $this->view->pageInfo = $this->model->pageInfo($id);
            $this->view->css = "public/css/main.css";
            $this->view->render('header');
            $this->view->render('layout/header');
            $this->view->render('page/view/content');
            $this->view->render('layout/footer');
            $this->view->render('footer');
        }
    }

}
