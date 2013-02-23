<?php

namespace RestExample;

use RestExample\Exception\RepresentationNotFound;
use RestExample\Request as Request;

class Resource {
    
    /** @var Request */
    protected $_request;
    
    /* @var Response */
    protected $_response;
    
    /** @var array */
    protected $_params = array();
    
    protected $_http_accept_to_folder = array(
        Request::APPLICATION_HTML => 'html',
        Request::APPLICATION_JSON => 'json',
        Request::APPLICATION_XML  => 'xml'
    );

    /**
     * 
     * @param \RestExample\Request $request
     * @param \RestExample\Response $response
     */
    public function __construct(Request $request, Response $response) {
        $this->_request = $request;
        $this->_response = $response;
    }
    
    /**
     * 
     * @param \RestExample\Request $request
     * @return \RestExample\Resource
     */
    public function setRequest(Request $request) {
        $this->_request = $request;
        return $this;
    }
    
    /**
     * 
     * @return Request
     */
    public function getRequest() {
        return $this->_request;
    }

    /**
     * 
     * @param \RestExample\Response $response
     * @return \RestExample\Resource
     */
    public function setResponse(Response $response) {
        $this->_response = $response;
        return $this;
    }
    
    /**
     * 
     * @return Response
     */
    public function getResponse() {
        return $this->_response;
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return Resource
     */
    public function setParam($key, $value) {
        $this->_params[$key] = $value;
        return $this;
    }
    
    /**
     * 
     * @param string $key
     * @return mixed|null
     */
    public function getParam($key) {
        if (! array_key_exists($key, $this->_params)) {
            return null;
        }
        return $this->_params[$key];
    }
    
    /**
     * Handles the view rendering.
     * And sets the body content.
     * 
     * 
     * @return string|null
     * @throws RepresentationNotFound
     */
    public function getRepresentation() {
        $file_name = BASE_PATH . '/Representation/' . 
                                 $this->_http_accept_to_folder[$this->getRequest()->getHttpAccept()] . 
                                 '/' . strtolower($this->getRequest()->getResourceName()) . '.php'; 
        if (!file_exists($file_name)) {
            throw new RepresentationNotFound();
        }
        ob_start();
        include_once $file_name;
        return $data = ob_get_clean();
    }
    
    public function getAction() {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200); 
    }
    
    public function postAction() {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_405); 
    }
    
    public function putAction() {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_405); 
    }
    
    public function deleteAction(){
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_405);
    }
}
