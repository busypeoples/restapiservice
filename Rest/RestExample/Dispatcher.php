<?php

namespace RestExample;

class Dispatcher {
	
        /**
         * 
         * @param \RestExample\Request $request
         * @param \RestExample\Response $response
         * @return \RestExample\AbstractController
         */
	public static function dispatch(Request $request, Response $response) {
                $controller_name = $request->getControllerName();
		$method = $request->getActionMethod();
		$controller = '\RestExample\Controller\\' . $controller_name;
		$controller = new $controller($request, $response);
		$controller->$method();
		return $controller;
	}
}
