<?php

require_once(dirname(__DIR__) . '../../Rest/autoload.php');

/** @var $app \RestExample\Application */
$app = new \RestExample\Application();

/**
 *  simple as that...
 */
$app->run();