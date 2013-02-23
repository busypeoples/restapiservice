<?php

namespace RestExample;

class Request {
    
    /** @var array */
    protected $_request_params = array();
    
    /** @var string */
    protected $_resource_name;
    
    /** @var string */
    protected $_request_method = self::GET;
    
    /** @var string */
    protected $_http_accept = self::JSON;

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    
    const XML = 'xml';
    const JSON = 'json';
    const HTML = 'html';

    /**
     * Constructor...
     */
    public function __construct() {
        $this->_request_method = $_SERVER['REQUEST_METHOD'];
        $this->prepareHttpAccept();
        $this->prepareRequestParams();
        $url_path = explode('/', $_SERVER['PATH_INFO']);
        unset($url_path[0]);
        $this->_resource_name = array_shift($url_path);
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
    public function getResourceName() {
        return ucfirst($this->_resource_name);
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
     * Takes care of setting the correct request method.
     */
    protected function prepareRequestParams() {
        switch ($this->getRequestMethod()) {
            case self::GET :
            case self::POST : 
            case self::PUT :
                $data = trim(file_get_contents('php://input'));
                $data = $this->convertData($data);
                break;
            CASE self::DELETE :
            default : 
                $data = array();
        }
        $this->_request_params = $data;
    }

    protected function prepareHttpAccept() {
        if (strpos($_SERVER['HTTP_ACCEPT'], 'json')) {
            $this->_http_accept = self::JSON;
            return;
        }

        if (strpos($_SERVER['HTTP_ACCEPT'], 'html')) {
            $this->_http_accept = self::HTML;
            return;
        }

        if (strpos($_SERVER['HTTP_ACCEPT'], 'xml')) {
            $this->_http_accept = self::XML;
            return;
        }
    }

    /**
     * convert raw data input into an array
     * according to the http-accept value this can handle json, xml and text/html conversion
     *
     */
    protected function convertData($data) {
        switch ($this->getHttpAccept()) {
            case self::XML :
                if (isset($data)) {
                    return json_decode(json_encode((array)simplexml_load_string($data)),1); 
                }
                return array();
                break;
            case self::JSON :
                if (isset($data)) {
                    return json_decode($data, true);
                }
                return array();
                break;
            case self::HTML :
            default :
                parse_str($data, $request);
                return $request;
        }
    }
}
