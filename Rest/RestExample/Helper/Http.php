<?php

namespace RestExample\Helper;

class Http {

	const STATUS_CODE_200 = "200 Ok";
	const STATUS_CODE_201 = "201 CREATED";
	const STATUS_CODE_202 = "202 ACCEPTED";
	const STATUS_CODE_203 = "203 NON-AUTHORITATIVE INFORMATION";
	const STATUS_CODE_204 = "204 NO CONTENT";
	const STATUS_CODE_205 = "205 RESET CONTENT";
	const STATUS_CODE_206 = "206 PARTIAL CONTENT";

	const STATUS_CODE_300 = "300 MULTIPLE CHOICES";
	const STATUS_CODE_301 = "301 MOVED PERMANENTLY";
	const STATUS_CODE_302 = "302 FOUND";
	const STATUS_CODE_303 = "303 SEE OTHER";
	const STATUS_CODE_304 = "304 NOT MODIFIED";
	const STATUS_CODE_305 = "305 USE PROXY";
	const STATUS_CODE_307 = "307 TEMPORARY REDIRECT";

	const STATUS_CODE_400 = "400 BAD REQUEST";
	const STATUS_CODE_401 = "401 UNAUTHORIZED";
	const STATUS_CODE_402 = "402 PAYMENT REQUIRED";
	const STATUS_CODE_403 = "403 FORBIDDEN";
	const STATUS_CODE_404 = "404 NOT FOUND";
	const STATUS_CODE_405 = "405 METHOD NOT ALLOWED";
	const STATUS_CODE_406 = "406 NOT ACCEPTABLE";
	const STATUS_CODE_407 = "407 Proxy Authentication Required";

	const STATUS_CODE_500 = "500 INTERNAL SERVER ERROR";
	const STATUS_CODE_501 = "501 NOT IMPLEMENTED";
	const STATUS_CODE_502 = "502 BAD GATEWAY";
	const STATUS_CODE_503 = "503 SERVICE UNAVAILABLE";
	const STATUS_CODE_504 = "504 GATEWAY TIMEOUT";
	const STATUS_CODE_505 = "505 HTTP VERSION NOT SUPPORTED";

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
