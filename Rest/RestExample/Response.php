<?php

namespace RestExample;

class Response {
    
    /** @var string */
    protected $_body;
    
    /** @var string */
    protected $_status_code;
    
    /** @var array */
    protected $_headers = array();
    
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
        if (! $this->_status_code ) {
            return "200 OK";
        }
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
    public function execute() {
        header("HTTP/1.1 {$this->getStatusCode()}");
        
        foreach ($this->getHeaders() as $name => $value) {
            header( "{$name} . ' : ' . {$value}" );
        }
      
        echo $this->getBody();
        // one final thing
        $this->setBody(null);
        $this->setHeaders(array());
    }
}

