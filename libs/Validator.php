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
    public function fetch($fieldName = false) {
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

    public function submit() {
        if (empty($this->_error)) {
            return true;
        } else {
            return $this->_error;
        }
    }

    public function minlength($data, $arg) {

        if (strlen($data) < $arg) {
            return "Your string can only be $arg long.";
        }
    }

    public function maxlength($data, $arg) {

        if (strlen($data) > $arg) {
            return "Your string can only be $arg long.";
        }
    }
    
    public function testlogin($data) {
        if (preg_match_all('/[:alnum:]{6,20}/', $data)){
            return true;
        } else
            return 'Pole login może zawierać litery lub cyfry, minimalna liczba znaków to 6, a maksymalna to 20.';
    }

}
