<?php

namespace RestExample;

use RestExample\Exception\ResourceNotFound;

class Dispatcher {

	/**
	 * @param Request $request
	 * @param Response $response
	 * @return mixed
	 * @throws \RestExample\Exception\ResourceNotFound
	 */
	public static function dispatch(Request $request, Response $response) {
        $controller_name = $request->getControllerName();
		$method = $request->getActionMethod();
		$controller = '\RestExample\Controller\\' . $controller_name;
                if (! class_exists($controller)) {
                   throw new ResourceNotFound('Class Not Found');
		}
		$controller = new $controller($request, $response);
		$controller->$method();
		return $controller;
	}
}
