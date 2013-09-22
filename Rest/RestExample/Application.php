<?php

namespace RestExample;

/**
 * 
 * Main entry point
 * 
 */
class Application {
    
    /** @var $config array */
    protected $config;
   
    /** @var Request $request */
    protected $request;
    
    /** @var Response $response */
    protected $response;


    public function __construct($config = array()) {
        $this->config = $config;
        $this->prepare();
    }
    
    /**
     * 
     * Takes of configuring the Application
     * 
     */
    public function prepare() {
        $this->request = new \RestExample\Request();
        $this->response = new \RestExample\Response();
        $this->response->addHeader('Content-Type', \RestExample\Helper\Converter::getContentType($this->request->getHttpAccept()));
    }
    
    public function run() {
        try {
            /** @var \RestExample\AbstractController $controller */
            $controller = \RestExample\Dispatcher::dispatch($this->request, $this->response);
            $body = $controller->execute();
            $status_code = \RestExample\Helper\Http::STATUS_CODE_200;
            
            if ($this->request->getRequestMethod() == 'POST') {
                $status_code = \RestExample\Helper\Http::STATUS_CODE_201;
                // add Location header...
                $this->response->addHeader('Location', 'newly created resouce uri');
            }
        } catch(\RestExample\Exception\ResourceNotFound $e) {
            $status_code = \RestExample\Helper\Http::STATUS_CODE_404;
            $body = null;        
        } catch(\RestExample\Exception\RepresentationNotFound $e) {
            $status_code = \RestExample\Helper\Http::STATUS_CODE_406;
            $body = null;
        } catch(\Exception $e) {
            $status_code = \RestExample\Helper\Http::STATUS_CODE_404;
            $body = null;
        }

        // prepare the response and then execute...
        $this->handleResponse($status_code, $body);
    }
    
    /**
     * 
     * @param integer $status_code
     * 
     * @param string $body
     */
    protected function handleResponse($status_code, $body) {
        $this->response->setStatusCode($status_code);
        $this->response->setBody($body);
        $this->response->output();
    }
}
