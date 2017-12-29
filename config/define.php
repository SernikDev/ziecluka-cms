<?php

/*
 * Global define for connection to database
 * 
 * DB_TYPE - database type for example mysql, sql, postgresql
 * DB_HOST - server name, if database is on same server with application you should stay with localhost, you can type here IP Address also
 * DB_NAME - user name for database
 * DB_PASS - password for database
 */
//define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "mvcproject");
define("DB_USER", "root");
define("DB_PASS", "");

/*
 * Global define for paths
 * 
 * TIP: Always try to type "/" at the end of path
 * 
 * URL - hostname of application
 * LIBS - default path to main libraries
 * CONTROLLERS - default path to controllers
 * MODELS - default path to model
 * ERROR_FILE - default name of file for 404 error
 * START_PAGE - name of default file page
 * 
 * SUBFOLDER - name of subfolder, if your application runs on address for example http://localhost/[name_of_subfolder]/
 */
define("URL", "http://localhost/mvcproject/");
define("LIBS", "libs/");
define("CONTROLLERS", "controllers/");
define("MODELS", "models/");
define("ERROR_FILE", "error.php");
define("START_PAGE", "homepage.php");
define("START_PAGE_MODEL", "homepage");
define("SUBFOLDER", "/mvcproject/");
define("SITE_NAME", "zieclukaCMS");
define("PANEL_LAYOUT", $_SERVER['DOCUMENT_ROOT'] . "/mvcproject/views/");
define("PAGE_LAYOUT", $_SERVER['DOCUMENT_ROOT'] . "/mvcproject/views/");