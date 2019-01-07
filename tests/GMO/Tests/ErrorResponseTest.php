<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\Tests;

use GMO\API\MethodsAbstract;
use GMO\API\MethodsSandbox;
use GMO\API\Call\EntryTran;
use GMO\API\Response\EntryTranResponse;
use GMO\API\Response\ErrorResponse;
use GMO\API\Errors;
use GMO\API\Call\SearchTrade;
use GMO\API\Response\SearchTradeResponse;
use GMO\API\Call\ExecTran;
use GMO\API\Response\ExecTranResponse;
use GMO\API\Call\AlterTran;
use GMO\API\Response\AlterTranResponse;
use GMO\API\Response\AccessIDInterface;
use GMO\API\Call\Example;
use GMO\API\Call\Magic;
use GMO\API\Response\ExampleResponse;

class ErrorResponseTest extends TestCase
{
    public function testErrorNoError()
    {
        $response = new ErrorResponse();
        $this->assertFalse($response->hasError());
        $this->assertFalse($response->hasErrorWithCode('TEST123'));
    }

    public function testErrorResponseHasNoCode()
    {
        $response = new ErrorResponse();
        $response->ErrInfo = 'TEST123|FOO123';
        $response->splitErrors();

        $this->assertTrue($response->hasErrorWithCode('TEST123'));
        $this->assertTrue($response->hasErrorWithCode('FOO123'));
        $this->assertFalse($response->hasErrorWithCode('BAR123'));
    }
}
