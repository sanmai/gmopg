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

class CallTest extends TestCase
{
    public function testEnvironment()
    {
        $this->assertArrayHasKey('SANDBOX_SHOP_ID', $_SERVER, "SANDBOX_SHOP_ID must be defined in the environment");
        $this->assertArrayHasKey('SANDBOX_PASSWORD', $_SERVER, "SANDBOX_PASSWORD must be defined in the environment");
        $this->assertArrayHasKey('SANDBOX_SHOP_NAME', $_SERVER, "SANDBOX_SHOP_NAME must be defined in the environment");
    }

    public function testGetMethods()
    {
        return new MethodsSandbox();
    }

    public function testGetExampleCall()
    {
        return new Example();
    }

    /**
     * @depends testGetMethods
     * @depends testGetExampleCall
     */
    public function testExample(MethodsAbstract $methods, Magic $method)
    {
        $this->assertInstanceOf(Example::class, $method);
        $this->assertInstanceOf(ExampleResponse::class, $method->getResponse());
        $this->assertEquals($methods->getUrl($method), $methods::Example);
    }

    public function testCreateEntryTran()
    {
        return new EntryTran();
    }

    /**
     * @depends testGetMethods
     * @depends testCreateEntryTran
     * @depends testEnvironment
     */
    public function testSetupCall(MethodsAbstract $methods, EntryTran $method)
    {
        $this->assertEquals($methods->getUrl($method), $methods::EntryTran);

        $method->setMethods($methods);
        $method->setShop($_SERVER['SANDBOX_SHOP_ID'], $_SERVER['SANDBOX_PASSWORD'], $_SERVER['SANDBOX_SHOP_NAME']);

        return $method;
    }

    /**
     * @depends testSetupCall
     */
    public function testMissingRequirementCall(EntryTran $method)
    {
        $this->expectException(\GMO\API\Exception\FailedRequirement::class);
        $method->dispatch();
    }

    /**
     * @depends testSetupCall
     */
    public function testFailedCall(EntryTran $method)
    {
        $method->OrderID = 1;
        $method->Amount = 1;

        $response = $method->dispatch();
        $this->assertTrue($response instanceof ErrorResponse);
        $this->assertTrue($response->hasError());
        $this->assertContains(Errors::DUPLICATE_ORDER_ID, $response->ErrInfo);

        return $method;
    }

    /**
     * @depends testFailedCall
     */
    public function testSearchTrade(EntryTran $method)
    {
        $searchMethod = new SearchTrade();
        $searchMethod->OrderID = $method->OrderID;
        $method->setupOther($searchMethod);

        $response = $searchMethod->dispatch();
        $this->assertInstanceOf(SearchTradeResponse::class, $response);

        $this->assertFalse($response->hasError());
        $this->assertNotEmpty($response->getAccessID());
        $this->assertNotEmpty($response->getAccessPass());
    }

    private $orderId;

    private function getOrderId()
    {
        if ($this->orderId) {
            return $this->orderId;
        }
        return $this->orderId = time();
    }

    /**
     * @depends testSetupCall
     */
    public function testEntryTran(EntryTran $method)
    {
        $method->OrderID = $this->getOrderId();
        $method->Amount = 5000;

        $response = $method->dispatch();
        $this->assertTrue($response instanceof EntryTranResponse);

        return $response;
    }

    /**
     * @depends testSetupCall
     * @depends testEntryTran
     */
    public function testExecTrans(EntryTran $entryTran, AccessIDInterface $response)
    {
        $method = new ExecTran();
        $entryTran->setupOther($method);

        $method->OrderID = $entryTran->OrderID;
        $method->setAccessID($response);

        $method->setCardNumber('4111111111111111');
        $method->setCardExpiryYearMonth(date('Y') + 2, 1);
        $method->setCardSecurityCode('123');

        $execResponse = $method->dispatch();

        if ($execResponse instanceof ErrorResponse) {
            if ($execResponse->hasErrorWithCode(Errors::NO_FULL_CARD_NUMBERS_ALLOWED)) {
                $this->markTestIncomplete("Payment with a complete card number is not enabled for the test environment");
            }

            foreach ($execResponse->ErrInfo as $code) {
                $this->fail(Errors::getDescription($code));
            }
        }

        $this->assertInstanceOf(ExecTranResponse::class, $execResponse);
        $this->assertTrue($method->verifyResponse($execResponse));

        return $response;
    }

    /**
     * @depends testSetupCall
     * @depends testExecTrans
     */
    public function testAlterTranFinally(EntryTran $entryTran, EntryTranResponse $response)
    {
        $method = new AlterTran();
        $entryTran->setupOther($method);

        $this->assertTrue($response instanceof AccessIDInterface);

        $method->setAccessID($response);
        $method->setActualSaleAmount($entryTran->Amount);
        $response = $method->dispatch();

        $this->assertTrue($response instanceof AlterTranResponse);
    }
}
