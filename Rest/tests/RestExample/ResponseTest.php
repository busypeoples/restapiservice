<?php

namespace RestExample;

class ResponseTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Response
     */
    protected $response;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->response = new Response();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * 
     * @testdox RestExample\Response setter/getter body
     * 
     */
    public function testSetGetBody() {
        $body = '<div>test</div>';
        
        $this->response->setBody($body);
        
        $this->assertSame($body, $this->response->getBody());
        
    }

    /**
     * 
     * @testdox RestExample\Response setter/getter status code
     * 
     */
    public function testGetStatusCode() {
        $this->response->setStatusCode(200);
        
        $this->assertSame(200, $this->response->getStatusCode());
    }

    /**
     * 
     * @testdox RestExample\Response setter/getter headers
     * 
     */
    public function testSetGetHeaders() {  
        $headers = array('string' => 'random', 'null' => null, 'integer' => 2);
        
        $this->response->setHeaders($headers);
        
        $this->assertSame($headers, $this->response->getHeaders());
    }
}
