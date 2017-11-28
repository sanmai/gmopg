<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\Tests;

class ImmediatePaymentTest extends TestCase
{
    /** @var \GMO\ImmediatePayment */
    protected $payment;

    protected function setUp()
    {
        $this->assertArrayHasKey('SANDBOX_SHOP_ID', $_SERVER, "SANDBOX_SHOP_ID must be defined in the environment");
        $this->assertArrayHasKey('SANDBOX_PASSWORD', $_SERVER, "SANDBOX_PASSWORD must be defined in the environment");
        $this->assertArrayHasKey('SANDBOX_SHOP_NAME', $_SERVER, "SANDBOX_SHOP_NAME must be defined in the environment");

        // A wrapper object that does everything for you
        $this->payment = new \GMO\ImmediatePayment();
        $this->payment->testShopId = $_SERVER['SANDBOX_SHOP_ID'];
        $this->payment->testShopPassword = $_SERVER['SANDBOX_PASSWORD'];
        $this->payment->testShopName = $_SERVER['SANDBOX_SHOP_NAME'];
    }

    public function testExecuteWithError()
    {
        $payment = $this->payment;

        $payment->paymentId = 1; // ID is non-unique here on purpose
        $payment->amount = 4999;
        $payment->cardNumber = '4111111111111112';
        $payment->cardYear = '2020';
        $payment->cardMonth = '7';
        $payment->cardCode = '123';

        // should fail because of non-unique payment ID
        $this->assertFalse($payment->execute());
        $this->assertGreaterThan(0, $payment->getErrorCode());
    }

    public function testExecuteWithSuccess()
    {
        $payment = $this->payment;

        $payment->paymentId = time();
        $payment->amount = 4999;
        $payment->cardNumber = '4111111111111111';
        $payment->cardYear = date('Y') + 1;
        $payment->cardMonth = '7';
        $payment->cardCode = '123';

        $this->assertTrue($payment->execute());
        $this->assertInstanceOf(\GMO\API\Response\ExecTranResponse::class, $payment->getResponse());
    }
}
