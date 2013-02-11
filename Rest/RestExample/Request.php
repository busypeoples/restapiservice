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
    protected $_http_accept = 'json';

	protected $_map_request_to_action = array(
		'GET' 	 => 'get',
		'POST'	 => 'add',
		'PUT'	 => 'update',
		'DELETE' => 'delete'
	);

    
    const DEFAULT_CONTROLLER = 'Index';
    
    /**
     * Constructor...
     */
    public function __construct() {
		$this->_request_method = $_SERVER['REQUEST_METHOD'];
        $this->prepareHttpAccept();
        $this->prepareRequestParams();
		$url_path = explode('/', $_SERVER['PATH_INFO']);
		unset($url_path[0]);
		$this->_controller = array_shift($url_path);
		$this->setParam('id', array_shift($url_path));

    }

    /**
     * @param $key
     * @param $value
     * @return Request
     */
    public function setParam($key, $value) {
            $this->_request_params[$key] = $value;
            return $this;
    }

    /**
     * 
     * @param string $key
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
		return $this->_map_request_to_action[$this->getRequestMethod()];
    }
    
    /**
     * Takes care of setting the correct request method.
     */
    protected function prepareRequestParams() {
        switch ($this->getRequestMethod()) {
            case 'POST' : 
                $data = $_POST;
                break;
            case 'PUT' :
                parse_str(file_get_contents('php://input'), $data);
                break;
            CASE 'GET' :
			CASE 'DELETE' :
			default : 
                // do nothing when GET or DELETE, as we don't accept any data from these two request methods...
        }
        
        $this->_request_params = isset($data)? $data :null;
    }

	protected function prepareHttpAccept() {
		if (strpos($_SERVER['HTTP_ACCEPT'], 'json')) {
			$this->_http_accept = 'json';
			return;
		}

		if (strpos($_SERVER['HTTP_ACCEPT'], 'html')) {
			$this->_http_accept = 'html';
			return;
		}

		if (strpos($_SERVER['HTTP_ACCEPT'], 'xml')) {
			$this->_http_accept = 'xml';
			return;
		}
	}
}
