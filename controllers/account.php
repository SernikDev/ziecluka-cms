<?php

class Account extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
        $this->validator = new Validator();
    }

    /*
     * Account module
     */

    function index() {
        Session::checkSession();
        header("Location: " . URL . "panel");
    }

    function profile() {
        Session::checkSession();
        $this->view->accountProfile = $this->model->accountProfile($_SESSION['userid']);
        $this->view->age = $this->model->age($_SESSION['userid']);
        $this->view->metaTitle = "Profil";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/account/profile/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function settings() {
        Session::checkSession();

        if ($_SESSION["error"] != "") {
            $this->view->error = $_SESSION["error"];
            Session::set("error", "");
        }
        if ($_SESSION["success"] != "") {
            $this->view->success = $_SESSION["success"];
            Session::set("success", "");
        }

        $this->view->accountProfile = $this->model->accountProfile($_SESSION['userid']);
        $this->view->metaTitle = "Ustawienia konta";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/account/settings/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function changeLogin() {
        Session::checkSession();

        $data = $this->main->cleanInput($_POST["login"]);
        $id = $_SESSION["userid"];

        if (empty($_POST["login"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeLogin($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changeFirstName() {
        Session::checkSession();

        $data = $this->main->cleanInput($_POST["first-name"]);
        $id = $_SESSION["userid"];

        if (empty($_POST["first-name"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeFirstName($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changeLastName() {
        Session::checkSession();

        $data = $this->main->cleanInput($_POST["last-name"]);
        $id = $_SESSION["userid"];

        if (empty($_POST["last-name"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeLastName($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changeEMail() {
        Session::checkSession();

        $data = $this->main->cleanInput($_POST["e-mail"]);
        $id = $_SESSION["userid"];

        if (empty($_POST["e-mail"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeEMail($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changeGender() {
        Session::checkSession();

        $data = $_POST["gender"];
        $id = $_SESSION["userid"];

        if (empty($_POST["gender"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeGender($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changeBornDate() {
        Session::checkSession();

        $data = $this->main->cleanInput($_POST["born-date"]);
        $id = $_SESSION["userid"];

        if (empty($_POST["born-date"])) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Pole nie zostało wypełnione. Spróbuj ponownie.");
        } else {
            $this->model->changeBornDate($id, $data);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
    }

    function changePassword() {
        Session::checkSession();

        $oldpassword = $_POST["old-password"];
        $newpassword = $_POST["new-password"];
        $ver = $this->model->verifyPassword($_SESSION["userid"], $oldpassword);

        if ($ver === 1) {
            $this->model->changePassword($_SESSION["userid"], $newpassword);
            header("Location: " . URL . "account/settings");
            Session::set("success", "Dane zostały pomyślnie zmienione.");
        }
        if ($ver === 2) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Operacja zakończona niepowodzeniem. Podane hasło jest nieprawidłowe. Spróbuj ponownie.");
        }
    }

    function addAvatar() {
        Session::checkSession();

        if ($_SERVER["CONTENT_LENGTH"] > $this->main->getIniPostMaxSize()) {
            header("Location: " . URL . "account/settings");
            Session::set("error", "Wybrany plik zajmuje powyżej 60MB. Nie udało się go wysłać na serwer.");
            exit();
        }

        $this->upload = new Uploader();
        $this->upload->setPath("/upload/images/avatar/");
        $this->upload->setType("avatar");
        $this->upload->fileValidation("image");
        $this->model->setAvatar($this->upload->getModel(), $_SESSION["userid"]);
        $message = $this->upload->getMessages();
        header("Location: " . URL . "account/settings");
        Session::set("{$message[1]}", "{$message[2]}");
    }

}
