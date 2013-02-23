<?php

namespace RestExample;

use RestExample\Exception\ResourceNotFound;

class ResourceService {
    
    const APPLICATION_XML  = 'application/xml; charset=utf-8';
    const APPLICATION_HTML = 'text/html; charset=utf-8';
    const APPLICATION_JSON = 'application/json; charset=utf-8';
    
    public function __construct($request, $response) {
        $response->addHeader('Content-Type', $this->getContentType($request->getHttpAccept()));
;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     * @throws \RestExample\Exception\ResourceNotFound
     */
    public static function dispatch(Request $request, Response $response) {
        $resource_name = $request->getResourceName();
        $method = $request->getActionMethod();
        $resource = '\RestExample\Resource\\' . $resource_name;
        if (! class_exists($resource, true)) {
           throw new ResourceNotFound($resource);
        }
        $resource = new $resource($request, $response);
        $resource->$method();
        return $resource;
    }
    
    /**
     * simply returns a valid content header depending on the request method.
     *
     */
    protected function getContentType($request_method) {
        switch ($request_method) {
            case Request::XML :
                return self::APPLICATION_XML;
                break;
            case Request::HTML :
                return self::APPLICATION_HTML;
                break;
            case Request::JSON : 
            default :
                return self::APPLICATION_JSON;
        }
    }
}
