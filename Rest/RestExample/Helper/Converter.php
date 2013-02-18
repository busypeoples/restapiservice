<?php

namespace RestExample\Helper;

use RestExample\Request as Request;

class Converter {

    const APPLICATION_XML  = 'application/xml; charset=utf-8';
    const APPLICATION_HTML = 'text/html; charset=utf-8';
    const APPLICATION_JSON = 'application/json; charset=utf-8';

    /**
     * simply returns a valid content header depending on the request method.
     *
     */
    public static function getContentType($request_method) {
        switch ($request_method) {
            case Request::XML :
                return self::APPLICATION_XML;
                break;
            case Request::HTML :
                return self::APPLICATION_HTML;
                break;
            case Request::JSON : 
            default :
                return self::APPLICATION_JSON;
        }
    }
}
