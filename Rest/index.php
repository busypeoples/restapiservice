<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');
$request = new \RestExample\Request();
$response = new \RestExample\Response();

$service = new RestExample\ResourceService($request, $response);

try {
    $controller = \RestExample\ResourceService::dispatch($request, $response);
    $body = $controller->execute();
        $status_code = \RestExample\Response::STATUS_CODE_200;
    if ($request->getRequestMethod() == 'POST') {
        $status_code = \RestExample\Response::STATUS_CODE_201;
        // add Location header...
        $response->addHeader('Location', 'newly created resouce uri');
    }
} catch(\Exception $e) {
    $status_code = $e->getCode();
    $body = $e->getMessage(); 
}

// prepare the response and then execute...
$response->setStatusCode($status_code);
$response->setBody($body);
$response->output();
