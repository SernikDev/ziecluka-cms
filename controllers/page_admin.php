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
        $this->view->metaTitle = "Dodaj nową stronę";
        $this->view->javascript = URL . "plugins/ckeditor/ckeditor.js";
        $this->view->images = $this->model->getImages("gallery");
        $this->view->fileBrowser = "filebrowser";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/page/create/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function add() {
        Session::checkSession();

        $url = new UrlGenerator();

        /*
         * 1. If there is empty title in input field, then generate error
         * 2. Check if URL field is empty, if yes then generate URL only in Alias table from post Name, if its not empty check if URL is valid and check it database
         * 3. Insert into table Post Name, Post Content, Post Author, Creation Date, Seo title, Seo url, Seo description
         * 4. Insert into alias page/view controller with ID from Page and alias
         */

        if ($_POST["page-title"] == "" || $_POST["image"] == "") {
            header("Location: " . URL . "page_admin");
            Session::set("error", "Błąd numer 1. Coś poszło nie tak. Skontaktuj się z administratorem.");
            exit();
        } else {
            if ($_POST["seo-url"] == "" || $_POST["image"] == "") {
                $doUrl = $url->generateUrl($_POST["page-title"]);
                if ($this->model->checkPageUrl($doUrl) == true) {
                    $this->model->pageAdd($_POST["image"], $_POST["page-title"], $_POST["page-content"], $_SESSION["userid"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniquePageUrl($doUrl);
                    $this->model->pageAdd($_POST["image"], $_POST["page-title"], $_POST["page-content"], $_SESSION["userid"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            } else {
                $doUrl = $url->generateUrl($_POST["seo-url"]);
                if ($this->model->checkPageUrl($doUrl) == true) {
                    $this->model->pageAdd($_POST["image"], $_POST["page-title"], $_POST["page-content"], $_SESSION["userid"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniquePageUrl($doUrl);
                    $this->model->pageAdd($_POST["image"], $_POST["page-title"], $_POST["page-content"], $_SESSION["userid"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            }
        }
        header("Location: " . URL . "page_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function edit($id) {
        Session::checkSession();
        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkPageId($id) == false) {
            header("Location: " . URL . "page_admin");
            Session::set("error", "Strona o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }

        $this->view->metaTitle = "Edytuj stronę";
        $this->view->javascript = URL . "plugins/ckeditor/ckeditor.js";
        $this->view->fileBrowser = "../filebrowser";
        $this->view->images = $this->model->getImages("gallery");
        $this->view->pageData = $this->model->pageSingle($id);
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/page/edit/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function editSave($id) {
        Session::checkSession();

        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkPageId($id) == false) {
            header("Location: " . URL . "page_admin");
            Session::set("error", "Strona o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }

        $url = new UrlGenerator();

        /*
         * 1. If there is empty title in input field, then generate error
         * 2. Check if URL field is empty, if yes then generate URL only in Alias table from post Name, if its not empty check if URL is valid and check it database
         * 3. Insert into table Post Name, Post Content, Post Author, Creation Date, Seo title, Seo url, Seo description
         * 4. Insert into alias page/view controller with ID from Page and alias
         */

        if ($_POST["page-title"] == "" || $_POST["image"] == "") {
            header("Location: " . URL . "page_admin");
            Session::set("error", "Błąd numer 1. Coś poszło nie tak. Skontaktuj się z administratorem.");
            exit();
        } else {
            if ($_POST["seo-url"] == "") {
                $doUrl = $url->generateUrl($_POST["page-title"]);
                if ($this->model->checkPageUrl($doUrl) == true) {
                    $this->model->pageUpdate($id, $_POST["image"], $_POST["page-title"], $_POST["page-content"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniquePageUrl($doUrl);
                    $this->model->pageUpdate($id, $_POST["image"], $_POST["page-title"], $_POST["page-content"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            } else {
                $doUrl = $url->generateUrl($_POST["seo-url"]);
                if ($this->model->checkPageUrl($doUrl) == true) {
                    $this->model->pageUpdate($id, $_POST["image"], $_POST["page-title"], $_POST["page-content"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniquePageUrl($doUrl);
                    $this->model->pageUpdate($id, $_POST["image"], $_POST["page-title"], $_POST["page-content"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            }
        }
        header("Location: " . URL . "page_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function delete() {

        $id = $_POST["page-id"];

        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkPageId($id) == false) {
            header("Location: " . URL . "page_admin");
            Session::set("error", "Strona o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }

        $this->model->deletePage($id);
        header("Location: " . URL . "page_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function fileBrowser() {
        $this->view->images = $this->model->getImages("gallery");
        $this->view->render('panel/filebrowser/content');
    }

}
