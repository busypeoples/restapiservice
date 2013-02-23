<?php

namespace RestExample;

use RestExample\Exception\ResourceNotFound;
use RestExample\Exception\MethodNotAllowed;

class ResourceService {
    
    public function run() {
        $request = new Request();
        $response = new Response();
       
        try {
            $resource = $this->loadResource($request, $response);
            $this->callRequestMethod($request, $resource);
            $response->addHeader('Content-Type', $request->getHttpAccept());
            $response->setBody($resource->getRepresentation());
        } catch(\Exception $e) {
            $response->setStatusCode($e->getCode());
            $response->setBody($e->getMessage());
        }
        
        $response->output();   
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     * @throws \RestExample\Exception\ResourceNotFound
     */
    public function loadResource(Request $request, Response $response) {
        $resource_name = $request->getResourceName();
        $resource = '\RestExample\Resource\\' . $resource_name;
        if (! class_exists($resource, true)) {
           throw new ResourceNotFound($resource);
        }
        $resource = new $resource($request, $response);
        return $resource;
    }
    
    public function callRequestMethod(Request $request, Resource $resource) {
        $method = $request->getRequestMethod() . 'Action';
        if (!method_exists($resource, $method)) {
            throw new MethodNotAllowed();
        }
        
        $resource->$method();
    }
}
