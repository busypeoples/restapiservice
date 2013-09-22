<?php

namespace RestExample;

class RegistryTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @testdox RestExample\Registry set / get Test
     * 
     * @dataProvider prepareParameters
     * 
     */
    public function testSetGet($key, $value) {
        /** @var $registry Registry */
        $registry = Registry::getInstance();
        
        $registry->set($key, $value);
        
        $this->assertSame($value, $registry->get($key));
    }

    /**
     * 
     * @testdox RestExample\Registry::has
     * 
     * @dataProvider prepareParameters
     * 
     */
    public function testHas($key, $value) {
        /** @var $registry Registry */
        $registry = Registry::getInstance();
        
        $registry->set($key, $value);
        
        $this->assertTrue($registry->has($key));
    }
    
    /**
     * 
     * @return array
     * 
     */
    public function prepareParameters() {
        return array(
            array('integer', 1),
            array('string', 'random'),
            array('boolean', false),
            array('null', null),
            array('object', $this->getMock('View', array(), array(), '', false)),
            array('array', array('id' => 1))
        );
    }

}
