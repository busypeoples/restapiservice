<?php

namespace RestExample\Helper;

class Converter {

	const APPLICATION_XML  = 'application/xml';
	const APPLICATION_HTML = 'text/html';
	const APPLICATION_JSON = 'application/json';

	public static function getContentType($request_method) {
		switch ($request_method) {
			case 'xml' :
				return self::APPLICATION_XML;
				break;
			case 'html' :
				return self::APPLICATION_HTML;
				break;
			case 'json' : 
			default :
				return self::APPLICATION_JSON;
		}
	}

	public static function convertData($data, $request) {
		switch ($request->getHttpAccept()) {
			case 'xml' :
				if (isset($data)) {
			    	return json_decode(json_encode((array)simplexml_load_string($data)),1);	
				}
				return null;
				break;
			case 'json' :
				if (isset($data)) {
					return (array)json_decode($data);
				}
				return null;
				break;
			case 'html' :
			default :
				return parse_str($data);
		}
	}
}
