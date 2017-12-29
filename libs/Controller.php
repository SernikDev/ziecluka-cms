<?php

class Controller {

    function __construct() {
        $this->view = new View();
    }
    
    /**
     * @param string $name - Name of the model
     * @param string $modelPath - Path of the model
     */
    public function loadModel($name, $modelPath) {

        $path = $modelPath . $name . '_model.php';
        if (file_exists($path)) {
            require $modelPath . $name . '_model.php';
            $modelName = $name . '_model';
            $this->model = new $modelName();
        }
    }
}