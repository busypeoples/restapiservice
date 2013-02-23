<?php

namespace RestExample;

class Response {
    
    /** @var string */
    protected $_body;
    
    /** @var string */
    protected $_status_code = self::STATUS_CODE_200;
    
    /** @var array */
    protected $_headers = array();
    
    const STATUS_CODE_200 = "200 Ok";
    const STATUS_CODE_201 = "201 CREATED";
    const STATUS_CODE_202 = "202 ACCEPTED";
    const STATUS_CODE_203 = "203 NON-AUTHORITATIVE INFORMATION";
    const STATUS_CODE_204 = "204 NO CONTENT";
    const STATUS_CODE_205 = "205 RESET CONTENT";
    const STATUS_CODE_206 = "206 PARTIAL CONTENT";

    const STATUS_CODE_300 = "300 MULTIPLE CHOICES";
    const STATUS_CODE_301 = "301 MOVED PERMANENTLY";
    const STATUS_CODE_302 = "302 FOUND";
    const STATUS_CODE_303 = "303 SEE OTHER";
    const STATUS_CODE_304 = "304 NOT MODIFIED";
    const STATUS_CODE_305 = "305 USE PROXY";
    const STATUS_CODE_307 = "307 TEMPORARY REDIRECT";

    const STATUS_CODE_400 = "400 BAD REQUEST";
    const STATUS_CODE_401 = "401 UNAUTHORIZED";
    const STATUS_CODE_402 = "402 PAYMENT REQUIRED";
    const STATUS_CODE_403 = "403 FORBIDDEN";
    const STATUS_CODE_404 = "404 NOT FOUND";
    const STATUS_CODE_405 = "405 METHOD NOT ALLOWED";
    const STATUS_CODE_406 = "406 NOT ACCEPTABLE";
    const STATUS_CODE_407 = "407 Proxy Authentication Required";

    const STATUS_CODE_500 = "500 INTERNAL SERVER ERROR";
    const STATUS_CODE_501 = "501 NOT IMPLEMENTED";
    const STATUS_CODE_502 = "502 BAD GATEWAY";
    const STATUS_CODE_503 = "503 SERVICE UNAVAILABLE";
    const STATUS_CODE_504 = "504 GATEWAY TIMEOUT";
    const STATUS_CODE_505 = "505 HTTP VERSION NOT SUPPORTED";
    
    /**
     * 
     * @param string $body
     * @return \RestExample\Response
     */
    public function setBody($body) {
        $this->_body = $body;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getBody() {
        return $this->_body;
    }
    
    /**
     * 
     * @param string $code
     * @return \RestExample\Response
     */
    public function setStatusCode($code) {
        $this->_status_code = $code;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getStatusCode() {
        return $this->_status_code;
    }
    
    /**
     * 
     * @param string $name
     * @param string $value
     * @return \RestExample\Response
     */
    public function addHeader($name, $value) {
        $this->_headers[$name] = $value;
        return $this;
    }
    
    /**
     * 
     * @param array $headers
     * @return \RestExample\Response
     */
    public function setHeaders($headers) {
        $this->_headers = $headers;
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getHeaders() {
        return $this->_headers;
    }

    /**
     * Takes care of sending the correct status, headers and body.
     */    
    public function output() {
        header("HTTP/1.1 {$this->getStatusCode()}");
        
        foreach ($this->getHeaders() as $name => $value) {
            header( $name . ': ' . $value );
        }
        echo $this->getBody();
    }
}

