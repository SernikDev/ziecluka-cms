<?php

class Panel extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
        $this->validator = new Validator();
    }

    /*
     * Main dashboard panel page
     */

    function index() {
        Session::checkSession();
        $this->view->metaTitle = "Dashboard";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/dashboard/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    /**
     * Login Page
     */
    function login() {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $login = $this->main->cleanInput($_POST['login']);
            $password = $this->main->cleanInput($_POST['password']);

            if (!empty($login && $password)) {

                $this->model->checkAuth($login, $password);

                if ($this->model->checkAuth($login, $password) == false) {
                    $this->view->error = "Niepoprawny login lub hasło.";
                }
            } else {
                $this->view->error = "Niepoprawny login lub hasło.";
            }
        }

        $this->view->metaTitle = "Strona logowania";
        $this->view->render('panel/header');
        $this->view->render('panel/login/content');
        $this->view->render('panel/footer');
    }

    function messages() {
        Session::checkSession();
        $this->view->metaTitle = "Wiadomości";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/messages/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    function notifications() {
        Session::checkSession();
        $this->view->metaTitle = "Powiadomienia";
        $this->view->render('panel/header');
        $this->view->render('panel/layout/start');
        $this->view->render('panel/notifications/content');
        $this->view->render('panel/layout/end');
        $this->view->render('panel/footer');
    }

    /*
     * Logout process
     */

    function logout() {
        Session::destroy();
        header("Location: " . URL . "panel/login");
    }

}
