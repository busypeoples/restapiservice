<?php

namespace RestExample\Helper;

class ConverterTest extends\PHPUnit_Framework_TestCase {
    
    /**
     * @testdox test getConfigurationType
     *
     * @dataProvider prepareContentTypes
     * 
     */
    public function testGetConfigurationType($expected, $type) {
        $this->assertSame($expected, Converter::getContentType($type));
    }
    
    public function prepareContentTypes() {
        return array(
            array('application/json; charset=utf-8', 'json'),
            array('application/xml; charset=utf-8', 'xml'),
            array('text/html; charset=utf-8', 'html'), 
            array('application/json; charset=utf-8', 'random')
        );
    }
            
}