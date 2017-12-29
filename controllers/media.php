<?php

class Media extends Controller {

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
        if ($_SESSION["warning"] != "") {
            $this->view->warning = $_SESSION["warning"];
            Session::set("warning", "");
        }

        $this->view->metaTitle = "Media";
        $this->view->javascript = "https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js";
        $this->view->media = $this->model->showGallery("gallery");
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/media/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function add() {
        Session::checkSession();

        if ($_SERVER["CONTENT_LENGTH"] > $this->main->getIniPostMaxSize()) {
            header("Location: " . URL . "media");
            Session::set("error", "Wybrane pliki zajmują powyżej 60MB. Nie udało się ich wysłać na serwer.");
            exit();
        }

        $this->upload = new Uploader();
        $this->upload->setPath("/upload/images/gallery/");
        $this->upload->setType("gallery");
        $this->upload->fileValidation("image");
        $this->model->insertFiles($this->upload->getModel());
        $message = $this->upload->getMessages();
        header("Location: " . URL . "media");
        Session::set("{$message[1]}", "{$message[2]}");
    }

    function delete() {
        Session::checkSession();

        $id = $_POST["file"];

        if (!empty($this->model->getFilePath($id))) {         
            unlink(getcwd() . "{$this->model->getFilePath($id)[0]["path"]}");
            $this->model->deleteFile($id);

            header("Location: " . URL . "media");
            Session::set("success", "Plik został pomyślnie usunięty.");
        } else {
            header("Location: " . URL . "media");
            Session::set("error", "Wystąpił nieoczekiwany błąd. Przekaż informację administratorowi.");
        }
    }

}
