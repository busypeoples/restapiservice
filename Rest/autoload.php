<?php


define ('APPLICATION_PATH', __DIR__);

// very basic autolaoder.
function autoloading($class_name) {
    if (strpos($class_name, 'RestExample') === false) return;
    $class = str_replace('\\', '/', $class_name);
    include APPLICATION_PATH . '/' . $class . '.php';
}

spl_autoload_register('autoloading');
