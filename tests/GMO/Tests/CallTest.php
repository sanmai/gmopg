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

        $this->assertTrue($execResponse instanceof ExecTranResponse);
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
