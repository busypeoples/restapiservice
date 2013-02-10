<?php

// very basic autolaoder.

function autoloading($class_name) {
    $class = str_replace('\\', '/', $class_name);
    include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
}

spl_autoload_register('autoloading');
