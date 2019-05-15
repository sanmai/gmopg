<?php
/**
 * This code is licensed under the MIT License.pyright (c) 2015-2017 Alexey Kopytko
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace GMO\API;

use GMO\API\Call\Magic;
use GMO\API\Response\ErrorResponse;
use GMO\Exception;
use GuzzleHttp\Client;

abstract class MethodsAbstract
{
    private $reflection;

    public function getUrl(Magic $class)
    {
        // expected format is "GMO\API\Call\Example"
        if (!preg_match('#\\\([^\\\]+)$#', get_class($class), $matched)) {
            throw new Exception('Invalid class name: must be within a namespace');
        }

        list(, $className) = $matched;

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
