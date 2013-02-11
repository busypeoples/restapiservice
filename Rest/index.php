<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');
$request = new \RestExample\Request();
$response = new \RestExample\Response();
$response->addHeader('Content-Type', \RestExample\Helper\StatusCode::getContentType($request->getHttpAccept()));

try {
	$controller = \RestExample\Dispatcher::dispatch($request, $response);
	$data = $controller->execute();
} catch(\RuntimeException $e) {
	$response->setStatusCode(\RestExample\Helper\StatusCode::STATUS_CODE_404);
	$response->setBody(null);
} catch(\Exception $e) {
	$response->setStatusCode(\RestExample\Helper\StatusCode::STATUS_CODE_404);
	$response->setBody(null);
}



$response->execute();
