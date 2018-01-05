<?php

class Validator {

    /** @var array $_currentItem the immediately posted item */
    private $_currentItem = array();

    /** @var array $_posData stores the Posted Data */
    private $_postData = array();

    /** @var array $_val The validator object */
    private $_val = array();

    /** @var array $_error Holds the current form error */
    private $_error = array();

    
    /**
     * checkPost - compare POST keys with declared keys
     * @param type $data - array with declared keys
     * @param type $post - array with POST keys
     * @return boolean
     */
    public function checkPost($data = array(), $post) {
        $fields = array_fill_keys($data, '');
        
        if(array_diff_key($fields, $post)){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * post - this is to run $_POST
     */
    public function post($field) {
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;
        return $this;
    }

    /**
     * fetch - return the posted data
     * @param mixed $fieldName
     * @return mixed string or array
     */
    public function returnData($fieldName = false) {
        if ($fieldName) {
            if (isset($this->_postData[$fieldName])) {
                return $this->_postData[$fieldName];
            } else {
                return false;
            }
        } else {
            return $this->_postData;
        }
    }

    /**
     * val - this is to validate
     */
    public function val($typeOfValidator, $arg = null) {

        if ($arg == null) {
            $error = $this->$typeOfValidator($this->_postData[$this->_currentItem]);
        } else {
            $error = $this->$typeOfValidator($this->_postData[$this->_currentItem], $arg);
        }

        if ($error) {
            $this->_error[$this->_currentItem] = $error;
        }

        return $this;
    }

    public function validationResult() {
        if (empty($this->_error)) {
            return true;
        } else {
            return false;
        }
    }

    public function minlength($data, $arg) {

        if (strlen($data) < $arg) {
            return "Pole powinno zawierać minimalnie $arg znaków.";
        }
    }

    public function maxlength($data, $arg) {

        if (strlen($data) > $arg) {
            return "Pole powinno zawierać maksymalnie $arg znaków.";
        }
    }

    public function email($data) {
        
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
            return "Adres email $data jest niepoprawny.";
        }
    }

}
