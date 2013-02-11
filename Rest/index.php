<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');
$request = new \RestExample\Request();
$response = new \RestExample\Response();
$response->addHeader('Content-Type', \RestExample\Helper\Http::getContentType($request->getHttpAccept()));

try {
	$controller = \RestExample\Dispatcher::dispatch($request, $response);
	$data = $controller->execute();
	if ($request->getRequestMethod() == 'POST') {
	    $response->setStatusCode(\RestExample\Helper\Http::STATUS_CODE_201);
	}
} catch(\RestExample\Exception\ResourceNotFound $e) {
	$response->setStatusCode(\RestExample\Helper\Http::STATUS_CODE_404);
	$response->setBody(null);
} catch(\RestExample\Exception\RepresentationNotFound $e) {
	$response->setStatusCode(\RestExample\Helper\Http::STATUS_CODE_406);
	$response->setBody(null);
} catch(\Exception $e) {
	$response->setStatusCode(\RestExample\Helper\Http::STATUS_CODE_404);
	$response->setBody(null);
}

$response->execute();
