<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');
$request = new \RestExample\Request();
$response = new \RestExample\Response();
$controller = \RestExample\Dispatcher::dispatch($request, $response);
$controller->execute();
$response->execute();
