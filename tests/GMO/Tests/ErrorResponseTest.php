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
