<?php

namespace RestExample;

/**
 * controller nase class
 * 
 * all action controllers must extend this base class
 * 
 * offers standard methods like set/get View
 * offers standard methods like set/get Request
 * offers standard methods like set/get Response
 * 
 */
abstract class AbstractController {
    
    /** @var Request */
    protected $_request;
    
    /* @var Response */
    protected $_response;
    
    /** @var string */
    protected $_data;
    
    /** @var View */
    protected $_view;

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
     * @param string $data
     * @return \RestExample\AbstractController
     */
    public function setData($data) {
        $this->_data = $data;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getData() {
        return $this->_data;
    }
    
    /**
     * 
     * @param \RestExample\Request $request
     * @return \RestExample\AbstractController
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
     * @return \RestExample\AbstractController
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
     * 
     * @param \RestExample\View $view
     * @return \RestExample\AbstractController
     */
    public function setView(View $view) {
        $this->_view = $view;
        return $this;
    }
    
    /**
     * 
     * @return View
     */
    public function getView() {
        if (! $this->_view) {
            $this->_view = new View($this->_request, $this->_response);
        }
        
        return $this->_view;
    }
    
    /**
     * Calls the view render method and passes the request and response.
     * 
     * @return string|null
     */
    public function execute() {
        return $this->getView()->render($this->_request, $this->_response);
    }
    
    abstract public function get();
    abstract public function add();
    abstract public function update();
    abstract public function delete();
}
