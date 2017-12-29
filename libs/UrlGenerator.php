<?php

class UrlGenerator {
    
    private $_url;
    
    public function generateUrl($data){
        $this->replacePolishLetters($data);
        $this->lowerCharacters($this->_url);
        $this->allowOnlyCharactersAndDigits($this->_url);
        $this->cleanUrlFromWhiteSpace($this->_url);
        
        return $this->_url;
    }

    function cleanUrlFromWhiteSpace($data) {
        $replaceWhiteSpace = str_replace(" ", "-", $data);
        $removeDash = preg_replace("/-+/", "-", $replaceWhiteSpace);
        $cleaned = trim($removeDash, "-");
        $this->_url = $cleaned;
    }

    function replacePolishLetters($data) {
        $replace = array(
            'ę' => 'e',
            'Ę' => 'E',
            'ó' => 'o',
            'Ó' => 'O',
            'ą' => 'a',
            'Ą' => 'A',
            'ś' => 's',
            'Ś' => 'S',
            'ł' => 'l',
            'Ł' => 'L',
            'ż' => 'z',
            'Ż' => 'Z',
            'ź' => 'z',
            'Ź' => 'Z',
            'ć' => 'c',
            'Ć' => 'C',
            'ń' => 'n',
            'Ń' => 'N'
        );
        
        $cleaned = str_replace(array_keys($replace), $replace, $data);
        $this->_url = $cleaned;
    }

    function lowerCharacters($data) {
        $this->_url = strtolower($data);
    }

    function allowOnlyCharactersAndDigits($data) {
        $url = preg_replace("/[^a-z0-9\-\_\ ]/", "", $data);
        $this->_url = $url;
    }

}
