<?php
define('BASE_PATH', __DIR__ . '/RestExample');
require_once('autoload.php');

$service = new RestExample\ResourceService();
$service->run();