<?php

/**
 * Notes:
 * DIRECTORY_SEPARATOR provides the default separator for the operating system the project is executed on
 * dirname( __FILE__ , 2) - __FILE__ (gets the current folder path the file is executed on,
 * ( __FILE__ , 2) 2 denotes the number of directories to go back
 */

// get the root path of the project where the "classes" folder is located
define('CLASS_PATH', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'classes/');

// spl_autoload_register automatically includes the file. used for including the class.php files
spl_autoload_register("autoload");

// load the file if file exist
function load($fileName) {
    if (!file_exists($fileName)) {
        return false;
    }

    include_once $fileName;
}

function autoload($className) {

    $extension = '.class.php';
    $fileName = CLASS_PATH . $className . $extension;
    load($fileName);
}
