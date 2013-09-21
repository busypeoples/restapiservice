<?php

namespace RestExample;

class ViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var View
     */
    protected $view;
    
    protected $request;
    
    protected $response;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->request = $this->getMock('\RestExample\Request', array(), array(), '', false);
        $this->response = $this->getMock('\RestExample\Response', array(), array(), '', false);
        
        $this->view = new View($this->request, $this->response);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * 
     * @testdox RestExample\View setter/getter request Test
     * 
     */
    public function testSetGetRequest() {
        $this->assertSame($this->request, $this->view->getRequest());
        
        // second test
        $request = $this->getMock('\RestExample\Request', array(), array(), '', false);
        
        $this->view->setRequest($request);
        
        $this->assertNotSame($this->request, $this->view->getRequest());
        
        $this->assertSame($request, $this->view->getRequest());
    }

    /**
     * 
     * @testdox RestExample\View setter/getter response Test
     * 
     */
    public function testSetGetResponse() {
         $this->assertSame($this->response, $this->view->getResponse());
        
        // second test
        $response = $this->getMock('\RestExample\Response', array(), array(), '', false);
        
        $this->view->setResponse($response);
        
        $this->assertNotSame($this->response, $this->view->getResponse());
        
        $this->assertSame($response, $this->view->getResponse());
    }

    /**
     * 
     * @testdox RestExample\View setter/getter params Test
     * 
     * @dataProvider prepareParameters
     * 
     */
    public function testSetGetParam($key, $value) {
        $this->view->setParam($key, $value);
        
        $this->assertSame($value, $this->view->getParam($key));
    }

    /**
     * @testdox RestExample\View::render
     */
    public function testRender() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
    
    /**
     * 
     * @return array
     */
    public function prepareParameters() {
        return array(
            array('integer', 1),
            array('string','a string'),
            array('null', null),
            array('boolean', true)
        );
    }
}
