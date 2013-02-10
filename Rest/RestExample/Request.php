<?php

namespace RestExample;

class Request {
    
    /** @var array */
    protected $_request_params = array();
    
    /** @var string */
    protected $_controller;
    
    /** @var string */
    protected $_request_method;
    
    /** @var string */
    protected $_action_method;
    
    /** @var string */
    protected $_format;
    
    /** @var string */
    protected $_content_type;
    
    /** @var string */
    protected $_http_accept;
    
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_REQUEST_METHOD = 'GET';
    const DEFAULT_CONTENT_TYPE = 'json';
    const GET = 'get';
    const POST = 'add';
    const PUT = 'update';
    const DELETE = 'delete';
    
    /**
     * Constructor...
     */
    public function __construct() {
        $this->_request_params = $_REQUEST;
        $url_path = array_reverse(explode('/', $_SERVER['REQUEST_URI']));
        $this->_controller = array_shift($url_path);
        $this->_request_method = $_SERVER['REQUEST_METHOD'];
        $this->_http_accept = (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'html';
        isset($_SERVER['CONTENT_TYPE'])? 
            $this->_content_type = $_SERVER['CONTENT_TYPE'] : self::DEFAULT_CONTENT_TYPE;
        $this->prepareRequestParams();
    }
    
    /**
     * 
     * @param type $key
     * @return mixed|null
     */
    public function getParam($key) {
        if (! $this->hasParam($key)) {
            return null;
        }
        return $this->_request_params[$key];
    }
    
    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function hasParam($key) {
        if (array_key_exists($key, $this->_request_params)) {
            return true; 
        }
        return false;
    }
    
    /**
     * 
     * @return array
     */
    public function getAllParams() {
        return $this->_request_params;
    }
    
    /**
     * 
     * @return string
     */
    public function getControllerName() {
        if (!$this->_controller) {
            return self::DEFAULT_CONTROLLER;
        }
        return ucfirst($this->_controller);
    }

    /**
     * 
     * @return array|null
     */
    public function getAuthentificationData() {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            return null;
        }
        return array('user' => $_SERVER['PHP_AUTH_USER'], 'password' => $_SERVER['PHP_AUTH_PW']);
    }
    
    /**
     * 
     * @return string
     */
    public function getHttpAccept() {
        return $this->_http_accept;
    }

    /**
     * 
     * @return string
     */
    public function getRequestMethod() {
        return $this->_request_method;
    }
    
    /**
     * 
     * @return string
     */
    public function getActionMethod() {
        return $this->_action_method;
    }
    
    /**
     * 
     * @return string
     */
    public function getContentType() {
        return $this->_content_type;
    }
    
    /**
     * Takes care of setting the correct request method.
     */
    protected function prepareRequestParams() {
        $data = null;
        switch ($this->getRequestMethod()) {
            case 'GET' : 
                $data = $_GET;
                $this->_action_method = self::GET;
                break;
            case 'POST' : 
                $data = $_POST;
                $this->_action_method = self::POST;
                break;
            case 'PUT' :
                parse_str(file_get_contents('php://input'), $data);
                $this->_action_method = self::PUT;
                break;
            case 'DELETE' :
                parse_str(file_get_contents('php://input'), $data);
                $this->_action_method = self::DELETE;
                break;
            default : 
                // do nothing...
        }
        
        $this->_request_params = $data;
    }
}
