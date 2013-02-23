<?php

namespace RestExample;

abstract class Resource {
    
    /** @var Request */
    protected $_request;
    
    /* @var Response */
    protected $_response;
    
    /** @var array */
    protected $_params = array();

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
     * Calls the view render method and passes the request and response.
     * 
     * @return string|null
     */
    public function execute() {
        return $this->createRepresentation();
    }
    
    /**
     * Handles the view rendering.
     * And sets the body content.
     * 
     * 
     * @return string|null
     * @throws RepresentationNotFound
     */
    public function createRepresentation() {
        $file_name = BASE_PATH . '/representation/' . $this->getRequest()->getHttpAccept() . '/' . strtolower($this->getRequest()->getResourceName()) . '.php'; 
        if (!file_exists($file_name)) {
            throw new RepresentationNotFound();
        }
        ob_start();
        include_once $file_name;
        return $data = ob_get_clean();
    }
    
    abstract public function get();
    
    public function add() {
        $this->_response->setStatusCode(Response::STATUS_CODE_405); 
    }
    
    public function update() {
        $this->_response->setStatusCode(Response::STATUS_CODE_405); 
    }
    
    public function delete(){
        $this->_response->setStatusCode(Response::STATUS_CODE_405);
    }
}
