<?php

class Blog_Admin extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
        $this->validator = new Validator();
    }

    /*
     * Profile module
     */

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

        $this->view->blogList = $this->model->blogList();
        $this->view->metaTitle = "Blog";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/blog/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function create() {
        Session::checkSession();
        $this->view->metaTitle = "Dodaj nowy artykuł";
        $this->view->javascript = URL . "plugins/ckeditor/ckeditor.js";
        $this->view->images = $this->model->getImages("gallery");
        $this->view->fileBrowser = "filebrowser";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/blog/create/content');
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
         * 4. Insert into alias blog/view controller with ID from Blog and alias
         */
        $s = mb_substr($_POST["blog-short-text"], 0, 200);

        if ($_POST["blog-title"] == "" || $_POST["image"] == "") {
            header("Location: " . URL . "blog_admin");
            Session::set("error", "Błąd numer 1. Coś poszło nie tak. Skontaktuj się z administratorem.");
            exit();
        } else {
            if ($_POST["seo-url"] == "") {
                $doUrl = $url->generateUrl($_POST["blog-title"]);
                if ($this->model->checkBlogUrl($doUrl) == true) {
                    $this->model->blogAdd($s, $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_SESSION["userid"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniqueBlogUrl($doUrl);
                    $this->model->blogAdd($s, $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_SESSION["userid"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            } else {
                $doUrl = $url->generateUrl($_POST["seo-url"]);
                if ($this->model->checkBlogUrl($doUrl) == true) {
                    $this->model->blogAdd($s, $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_SESSION["userid"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniqueBlogUrl($doUrl);
                    $this->model->blogAdd($s, $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_SESSION["userid"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            }
        }
        header("Location: " . URL . "blog_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function edit($id) {
        Session::checkSession();       
        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkBlogId($id) == false) {
            header("Location: " . URL . "blog_admin");
            Session::set("error", "Artykuł o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }

        $this->view->metaTitle = "Edytuj artykuł";
        $this->view->javascript = URL . "plugins/ckeditor/ckeditor.js";
        $this->view->fileBrowser = "../filebrowser";
        $this->view->images = $this->model->getImages("gallery");
        $this->view->blogData = $this->model->blogSingle($id);
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/blog/edit/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function editSave($id) {
        Session::checkSession();

        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkBlogId($id) == false) {
            header("Location: " . URL . "blog_admin");
            Session::set("error", "Artykuł o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }

        $url = new UrlGenerator();

        /*
         * 1. If there is empty title in input field, then generate error
         * 2. Check if URL field is empty, if yes then generate URL only in Alias table from post Name, if its not empty check if URL is valid and check it database
         * 3. Insert into table Post Name, Post Content, Post Author, Creation Date, Seo title, Seo url, Seo description
         * 4. Insert into alias blog/view controller with ID from Blog and alias
         */

        if ($_POST["blog-title"] == "" || $_POST["image"] == "") {
            header("Location: " . URL . "blog_admin");
            Session::set("error", "Błąd numer 1. Coś poszło nie tak. Skontaktuj się z administratorem.");
            exit();
        } else {
            if ($_POST["seo-url"] == "") {
                $doUrl = $url->generateUrl($_POST["blog-title"]);
                if ($this->model->checkBlogUrl($doUrl) == true) {
                    $this->model->blogUpdate($id, $_POST["blog-short-text"], $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniqueBlogUrl($doUrl);
                    $this->model->blogUpdate($id, $_POST["blog-short-text"], $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            } else {
                $doUrl = $url->generateUrl($_POST["seo-url"]);
                if ($this->model->checkBlogUrl($doUrl) == true) {
                    $this->model->blogUpdate($id, $_POST["blog-short-text"], $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_POST["seo-title"], $doUrl, $_POST["seo-description"]);
                } else {
                    $newUrl = $this->model->setUniqueBlogUrl($doUrl);
                    $this->model->blogUpdate($id, $_POST["blog-short-text"], $_POST["image"], $_POST["blog-title"], $_POST["blog-content"], $_POST["seo-title"], $newUrl, $_POST["seo-description"]);
                }
            }
        }
        header("Location: " . URL . "blog_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function delete() {
        
        $id = $_POST["article-id"];

        /**
         * Check if id of blog exist, if no it will generate error and stop script
         */
        if ($this->model->checkBlogId($id) == false) {
            header("Location: " . URL . "blog_admin");
            Session::set("error", "Artykuł o numerze {$id} nie istnieje. Skontaktuj się z administratorem.");
            exit();
        }
        
        $this->model->deleteArticle($id);
        header("Location: " . URL . "blog_admin");
        Session::set("success", "Operacja zakończona pomyślnie.");
    }

    function fileBrowser() {
        $this->view->images = $this->model->getImages("gallery");
        $this->view->render('panel/filebrowser/content');
    }

}
