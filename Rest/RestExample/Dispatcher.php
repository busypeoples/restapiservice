<?php

namespace RestExample;

class Dispatcher {

	/**
	 * @param Request $request
	 * @param Response $response
	 * @return mixed
	 * @throws \RuntimeException
	 */
	public static function dispatch(Request $request, Response $response) {
        $controller_name = $request->getControllerName();
		$method = $request->getActionMethod();
		$controller = '\RestExample\Controller\\' . $controller_name;
		if (! class_exists($controller)) {
			throw new \RuntimeException('Class Not Found');
		}
		$controller = new $controller($request, $response);
		$controller->$method();
		return $controller;
	}
}
