<?php

namespace RestExample;

// test the abstract controller by extending
class ConcreteController extends AbstractController {
    public function add() {
        
    }

    public function delete() {
        
    }

    public function get() {
        
    }

    public function update() {
        
    }
}

class AbstractControllerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var AbstractController
     */
    protected $controller;
    
    protected $request;
    
    protected $reponse;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        
        $this->request = $this->getMock('\RestExample\Request', array(), array(), '', false);
        $this->response = $this->getMock('\RestExample\Response', array(), array(), '', false);
        
        $this->controller = new ConcreteController($this->request, $this->response);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * 
     * @testdox RestExample\AbstractController setter/getter data
     * 
     */
    public function testSetGetData() {
       $this->controller->setData('random');
       
       $this->assertSame('random', $this->controller->getData());
    }

    /**
     * 
     * @testdox RestExample\AbstractController setter/getter Request
     * 
     */
    public function testSetGetRequest() {
         $this->assertSame($this->request, $this->controller->getRequest());
        
        // second test
        $request = $this->getMock('\RestExample\Request', array(), array(), '', false);
        
        $this->controller->setRequest($request);
        
        $this->assertNotSame($this->request, $this->controller->getRequest());
        
        $this->assertSame($request, $this->controller->getRequest());
    }

    /**
     * 
     * @testdox RestExample\AbstractController setter/getter Response
     * 
     */
    public function testSetResponse() {
        $this->assertSame($this->response, $this->controller->getResponse());
        
        // second test
        $response = $this->getMock('\RestExample\Response', array(), array(), '', false);
        
        $this->controller->setResponse($response);
        
        $this->assertNotSame($this->response, $this->controller->getResponse());
        
        $this->assertSame($response, $this->controller->getResponse());  
    }

    /**
     * 
     * @testdox RestExample\AbstractController setter/getter View
     * 
     */
    public function testSetGetView() {
        $view = $this->getMock('\RestExample\View', array(), array(), '', false);
        
        $this->controller->setView($view);
        
        $this->assertSame($view, $this->controller->getView());
    }

    /**
     * 
     * @testdox RestExample\AbstractController::execute
     * .
     */
    public function testExecute() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
