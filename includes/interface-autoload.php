<?php

define('INTERFACE_PATH', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'interfaces/');
spl_autoload_register("autoloadInterface");

function loadInterface($file) {

    if (!file_exists($file)) {
        return false;
    }

    include_once $file;
}

function autoloadInterface($interfaceName) {

    $extension = '.interface.php';
    $fileName = INTERFACE_PATH . $interfaceName . $extension;
    loadInterface($fileName);
}
