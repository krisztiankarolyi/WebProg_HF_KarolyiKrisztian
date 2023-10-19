<?php

function autoloader($class) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    $classPath = '..'.DIRECTORY_SEPARATOR.$classPath;
    if (file_exists($classPath)) {
        require_once($classPath);
    }
}

spl_autoload_register('autoloader');