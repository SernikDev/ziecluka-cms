<?php

class Blog extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $this->main = new Main();
        $this->validator = new Validator();
    }

    public function view($id) {
        /**
         * If there is no param in database it will generate an error
         */
        if (empty($this->main->getBlogId($id))) {
            $this->view->render('error/index');
        } else {
            $this->view->blog = $this->model->blogInfo($id);
            
            $this->view->render('header');
            $this->view->render('blog/index');
            $this->view->render('footer');
        }
        
    }

}
