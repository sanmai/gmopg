<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API;

use GMO\API\Call\Magic;
use GMO\API\Response\ErrorResponse;
use GuzzleHttp\Client;
use GMO\Exception;

abstract class MethodsAbstract
{
	private $reflection;

	public function getUrl(Magic $class)
	{
		// expected format is "GMO\API\Call\Example"
		if (!preg_match('#\\\([^\\\]+)$#', get_class($class), $matched)) {
			throw new Exception("Invalid class name: must be within a namespace");
		}

		list (, $className) = $matched;

		$this->reflection || $this->reflection = new \ReflectionClass($this);
		return $this->reflection->getConstant($className);
	}

	public function getQuery(Magic $class)
	{
	    return array_merge($class->getRequestBase(), get_object_vars($class));
	}

	private static $guzzleClient;

	public function dispatch(Magic $call)
	{
	    self::$guzzleClient = new Client();
	    $response = self::$guzzleClient->request('POST', $this->getUrl($call), [
	        'form_params' => $this->getQuery($call),
	    ]);

	    parse_str($response->getBody(), $rawResponse);

	    if (isset($rawResponse['ErrCode'])) {
            $response = new ErrorResponse();
	    } else {
	        $response = $call->getResponse();
	    }

	    foreach ($rawResponse as $key => $value) {
	        $response->{$key} = $value;
	    }

	    if ($response instanceof ErrorResponse) {
	        $response->splitErrors();
	    }

	    return $response;
	}
}
