<?php

class Page_Admin extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
    }

    function index() {
        Session::checkSession();

        if ($_SESSION["error"] != "") {
            $this->view->error = $_SESSION["error"];
            Session::set("error", "");
        }
        if ($_SESSION["success"] != "") {
            $this->view->success = $_SESSION["success"];
            Session::set("success", "");
        }

        $this->view->pageList = $this->model->pageList();
        $this->view->metaTitle = "Page";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/page/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function create() {
        Session::checkSession();
        $this->view->metaTitle = "Dodaj now stronę";
        $this->view->javascript = URL . "plugins/ckeditor/ckeditor.js";
        $this->view->images = $this->model->getImages("gallery");
        $this->view->fileBrowser = "filebrowser";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/page/create/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

}
