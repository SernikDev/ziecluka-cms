<?php

/**
 * Nie jestem pewien czy nie trzeba extendować model
 */
class Bootstrap {

    /**
     * $_url array - stores url array, null for homepage
     * $_controller - stores controller name, null for homepage
     */
    public $_url = null;
    private $_controller = null;

    /**
     * Don't change it if no need
     * 
     * defined $_controllerPath - path to controllers
     * defined $_modelPath - path to models
     * defined $_errorFile - name of 404 error file
     * defined $_defaultFile - name of default file page
     */
    private $_controllerPath = CONTROLLERS;
    private $_modelPath = MODELS;
    private $_errorFile = ERROR_FILE;
    private $_defaultFile = START_PAGE;

    function __construct() {
        
    }

    /**
     * Start Bootstrap
     */
    public function init() {

        // Sets protected url
        $this->_getUrl();
        
        // Sets protected url after checking in DB alias
        $this->_returnUrl();

        // Load default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        //Load controller and then method
        $this->_loadExistController();
        $this->_loadControllerMethod();
    }

    /**
     * (Optional) Set the path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set the path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set the path to error file for example error.php
     * @param string $path
     */
    public function setErrorFile($path) {
        $this->_errorFile = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set the path to default file for example index.php
     * @param string $path
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, '/') . '/';
    }

    /**
     * Array of url explode by "/" for example, http://localhost/product/create - array([0]=>product, [1]=>create)
     * Also handling ? sign in URL
     */
    private function _getUrl() {
        $value = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
        $value = str_replace(SUBFOLDER, '', $value);
        $value = rtrim($value, '/');
        $value = ltrim($value, '/');
        $value = filter_var($value, FILTER_SANITIZE_URL);
        $temp = explode('?', $value);
        $value = array_shift($temp);
        $this->_url = $value;
    }

    /**
     * If SEO Link matches in database we return system URL, if there is no result then we got normal route
     * @return array
     */
    private function _returnUrl() {
        foreach ($this->_checkForAlias() as $key => $value) {
            $alias = $value['controller'];
        }

        if (isset($alias)) {
            $alias = rtrim($alias, '/');
            $alias = filter_var($alias, FILTER_SANITIZE_URL);
            $this->_url = explode('/', $alias);
        } else {
            return $this->_url = explode('/', $this->_url);
        }
    }

    /**
     * Check in database for system specific URL - SEO Links
     * @return mixed system url name
     */
    private function _checkForAlias() {
        $this->db = new Database();

        return $this->db->select("SELECT `controller` FROM `alias` WHERE `alias` = :alias LIMIT 1;", array(
            ":alias" => $this->_url));
    }

    /**
     * Load default controller, homepage in this case
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Homepage();
        $this->_controller->loadModel(START_PAGE_MODEL, $this->_modelPath);
        $this->_controller->index();
    }

    /**
     * Load exist controller based on url and then method, if not exist it would generate a error page
     */
    private function _loadExistController() {
        $file = $this->_controllerPath . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0], $this->_modelPath);
        } else {
            $this->_error();
            return false;
        }
    }

    /**
     * Load Controller Method
     */
    private function _loadControllerMethod() {

        // We check for number a objects stored in array based on url
        $length = count($this->_url);

        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }

        switch ($length) {

            case 5:
                // Controller->Method(param1, param2, param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                // Controller->Method(param1, param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                // Controller->Method(param1)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                // Controller->Method
                $this->_controller->{$this->_url[1]}();
                break;
            // Controller, it would generate error, something goes wrong
            default:
                $this->_controller->index();
                break;
        }
    }

    /**
     * Load error 404
     */
    private function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $controller = new CustomError();
        $controller->index();
        exit;
    }
}
