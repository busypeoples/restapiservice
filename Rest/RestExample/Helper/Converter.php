<?php

namespace RestExample\Helper;

class Converter {

	const APPLICATION_XML  = 'application/xml';
	const APPLICATION_HTML = 'text/html';
	const APPLICATION_JSON = 'application/json';

	const XML = 'xml';
	const JSON = 'json';
	const HTML = 'html';
	
	/**
	 * simply returns a valid content header depending on the request method.
	 *
	 */
	public static function getContentType($request_method) {
		switch ($request_method) {
			case self::XML :
				return self::APPLICATION_XML;
				break;
			case self::HTML :
				return self::APPLICATION_HTML;
				break;
			case self::JSON : 
			default :
				return self::APPLICATION_JSON;
		}
	}
	
	/**
	 * convert raw data input into an array
	 * according to the http-accept value this can handle json, xml and text/html conversion
	 *
	 */
	public static function convertData($data, $request) {
		switch ($request->getHttpAccept()) {
			case self::XML :
				if (isset($data)) {
			    	return json_decode(json_encode((array)simplexml_load_string($data)),1);	
				}
				return array();
				break;
			case self::JSON :
				if (isset($data)) {
					return json_decode($data, true);
				}
				return array();
				break;
			case self::HTML :
			default :
				parse_str($data, $request);
				return $request;
		}
	}
}
