<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');
$request = new \RestExample\Request();
$response = new \RestExample\Response();
$response->addHeader('Content-Type', \RestExample\Helper\Converter::getContentType($request->getHttpAccept()));

try {
    $controller = \RestExample\Dispatcher::dispatch($request, $response);
    $body = $controller->execute();
        $status_code = \RestExample\Helper\Http::STATUS_CODE_200;
    if ($request->getRequestMethod() == 'POST') {
        $status_code = \RestExample\Helper\Http::STATUS_CODE_201;
        // add Location header...
        $response->addHeader('Location', 'newly created resouce uri');
    }
} catch(\RestExample\Exception\ResourceNotFound $e) {
    $status_code = \RestExample\Helper\Http::STATUS_CODE_404;
    $body = null;        
} catch(\RestExample\Exception\RepresentationNotFound $e) {
    $status_code = \RestExample\Helper\Http::STATUS_CODE_406;
    $body = null;
} catch(\Exception $e) {
    $status_code = \RestExample\Helper\Http::STATUS_CODE_404;
    $body = null;
}

// prepare the response and then execute...
$response->setStatusCode($status_code);
$response->setBody($body);
$response->execute();
