<?php

/*
 * Global Defines
 */
require "config/define.php";

function __autoload($class){
    require LIBS . $class . ".php";
}

$bootstrap = new Bootstrap();
$bootstrap->init();