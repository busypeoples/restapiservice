<?php


define ('APPLICATION_PATH', __DIR__);

// very basic autolaoder.
function autoloading($class_name) {
    $class = str_replace('\\', '/', $class_name);
    include APPLICATION_PATH . '/' . $class . '.php';
}

spl_autoload_register('autoloading');
