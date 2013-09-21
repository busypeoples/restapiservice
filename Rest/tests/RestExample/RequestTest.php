<?php

namespace RestExample;

class RequestTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Request
     */
    protected $request;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        
        // define default $_SERVER['REQUEST_METHOD'];
        // define default $_SERVER['HTTP_ACCEPT'];
        // define default $_SERVER['PATH_INFO'];
        
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_ACCEPT'] = 'html';
        $_SERVER['PATH_INFO'] = 'index';
        
        $this->request = new Request();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     *
     * @testdox RestExample\Request setter/getter params test
     * 
     * @dataProvider prepareParameters
     * 
     */
    public function testGetParam($key, $value) {
        $this->request->setParam($key, $value);
        
        $this->assertSame($value, $this->request->getParam($key));
    }

    /**
     * @testdox RestExample\Request::hasParam
     * 
     * @dataProvider prepareParameters
     * 
     */
    public function testHasParam($key, $value) {
        $this->request->setParam($key,$value);
        
        $this->assertTrue($this->request->hasParam($key));
    }

    /**
     * @testdox RestExample\Request::getAllParams
     */
    public function testGetAllParams() {
        $params = $this->prepareParameters();
        
        foreach ($params as $keyValue) {
            $this->request->setParam($keyValue[0], $keyValue[1]);
        }
        
        $this->assertCount(5, $this->request->getAllParams());
    }

    /**
     * 
     * @testdox RestExample\Request::getControllerName
     * 
     */
    public function testGetControllerName() {
        // fake global $_SERVER path_info
         $_SERVER['PATH_INFO'] = 'index/user';
         
         $request = new Request();
         
         $this->assertSame('User', $request->getControllerName());
    }

    /**
     * @covers RestExample\Request::getAuthentificationData
     * @todo   Implement testGetAuthentificationData().
     */
    public function testGetAuthentificationData() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * 
     * @testdox RestExample\Request::getHttpAccept
     * 
     */
    public function testGetHttpAccept() {
        $this->assertSame('json', $this->request->getHttpAccept());
    }

    /**
     * 
     * @testdox RestExample\Request::getRequestMethod
     * 
     * @dataProvider prepareRequestMethods
     * 
     */
    public function testGetRequestMethod($method) {
        $_SERVER['REQUEST_METHOD'] = $method;
        
        $request = new Request();
       
        $this->assertSame($method, $request->getRequestMethod());
    }
     
    /** 
     * 
     * @testdox RestExample\Request::getActionMethod
     * 
     * @dataProvider prepareRequestMethods
     * 
     */
    public function testGetActionMethod($method, $expected) {
       $_SERVER['REQUEST_METHOD'] = $method;
       
       $request = new Request();
       
       $this->assertSame($expected, $request->getActionMethod());
    }

    /**
     * 
     * @testdox RestExample\Request::getContentType
     * 
     */
    public function testGetContentType() {
        $this->assertNull($this->request->getContentType());
    }

    /**
     * 
     * @covers RestExample\Request::isGet
     * 
     */
    public function testIsGet() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $request1 = new Request();
        
        $this->assertTrue($request1->isGet());
        
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        
        $request2 = new Request();
        
        $this->assertFalse($request2->isGet());
    }

    /**
     * 
     * @testdox RestExample\Request::isPost
     * 
     */
    public function testIsPost() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        $request1 = new Request();
        
        $this->assertTrue($request1->isPost());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $request2 = new Request();
        
        $this->assertFalse($request2->isPost());
    }

    /**
     * @testdox RestExample\Request::isPut
     */
    public function testIsPut() {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        
        $request1 = new Request();
        
        $this->assertTrue($request1->isPut());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $request2 = new Request();
        
        $this->assertFalse($request2->isPut());
    }

    /**
     * 
     * @testdox RestExample\Request::isDelete
     * 
     */
    public function testIsDelete() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        
        $request1 = new Request();
        
        $this->assertTrue($request1->isDelete());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $request2 = new Request();
        
        $this->assertFalse($request2->isDelete());
    }
    
    public function prepareParameters() {
        return array(
            array('test', '101'),
            array('test2', null),
            array('test3', 103),
            array('test4', 104)
        );
    }
    
    public function prepareRequestMethods() {
        return array(
            array('GET', 'get'),
            array('POST', 'add'),
            array('PUT', 'update'),
            array('DELETE', 'delete')
        );
    }

}
