<?php

class Xhr extends Controller {

    function __construct() {
        parent::__construct();
        $this->validator = new Validator();
    }

    function signToNewsletter() {
        $keys = array('name', 'email');

        $q = $this->validator->checkPost($keys, $_POST);

        // Check if declared keys are equal to posted by form
        if ($q === true) {

            // Validation
            $this->validator->post('name')
                    ->post('email')
                    ->val('email');

            if ($this->validator->validationResult() === true) {

                $this->model->signToNewsletter($this->validator->returnData());

                $k = "success";
                $m = array("value" => "Poprawny zapis do newslettera!");
                $j = json_encode(array($k => $m));
                echo $j;
            } else {
                $k = "error";
                $m = array("value" => "Błędnie wypełniony formularz!");
                $j = json_encode(array($k => $m));
                echo $j;
            }
        } else {
            $k = "formerror";
            $m = array("value" => "Błąd formularz. Strona zostanie odświeżona!");
            $j = json_encode(array($k => $m));
            echo $j;
        }
    }

    function contactForm() {
        $keys = array('fkname', 'fkemail', 'fktopic', 'fkmessage');

        $q = $this->validator->checkPost($keys, $_POST);

        // Check if declared keys are equal to posted by form
        if ($q === true) {

            // Validation
            $this->validator->post('fkname')
                    ->post('fkemail')
                    ->val('email')
                    ->post('fktopic')
                    ->post('fkmessage');

            if ($this->validator->validationResult() === true) {

                $this->model->contactForm($this->validator->returnData());

                $k = "success";
                $m = array("value" => "Wiadomość wysłana poprawnie!");
                $j = json_encode(array($k => $m));
                echo $j;
            } else {
                $k = "error";
                $m = array("value" => "Błędnie wypełniony formularz!");
                $j = json_encode(array($k => $m));
                echo $j;
            }
        } else {
            $k = "formerror";
            $m = array("value" => "Błąd formularz. Strona zostanie odświeżona!");
            $j = json_encode(array($k => $m));
            echo $j;
        }
    }

}
