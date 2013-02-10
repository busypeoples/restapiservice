<?php

namespace RestExample;

class View {
    
    /** @var array */
    protected $_params = array();
    
    /** @var Request */
    protected $_request;
    
    /** @var Response */
    protected $_response;
    
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
     * Handles the view rendering.
     * And sets the body content.
     * 
     * @throws \Exception
     */
    public function render() {
        $file_name = BASE_PATH . '/View/' . $this->getRequest()->getHttpAccept() . '/' . strtolower($this->getRequest()->getControllerName()) . '.php'; 
        if (!file_exists($file_name)) {
            throw new \Exception("No file found with the name $file_name");
        }
        ob_start();
        include_once $file_name;
        $data = ob_get_clean();
        $this->getResponse()->setBody($data);
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
     * @return Request
     */
    public function getRequest() {
        return $this->_request;
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return \RestExample\View
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
}

