<?php
/**
 * This code is licensed under the MIT License.
 *
 * Copyright (c) 2015-2017 Alexey Kopytko
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

namespace GMO;

use GMO\API\Call\AlterTran;
use GMO\API\Call\EntryTran;
use GMO\API\Call\ExecTran;
use GMO\API\Call\Magic;
use GMO\API\Errors;
use GMO\API\MethodsSandbox;
use GMO\API\Response\AlterTranResponse;
use GMO\API\Response\EntryTranResponse;
use GMO\API\Response\ErrorResponse;
use GMO\API\Response\ExecTranResponse;

class ImmediatePayment
{
    /**
     * Unique ID for the payment.
     *
     * @var int
     */
    public $paymentId;

    /**
     * Payment amount (Japanese yen only).
     *
     * @var int
     */
    public $amount;

    /**
     * Card number to be credited from.
     *
     * For testing use 4111111111111111
     *
     * @var string
     */
    public $cardNumber;

    /**
     * Card's expiration year (four digits, e.g. 2038).
     *
     * @var string
     */
    public $cardYear;

    /**
     * Card's expiration month (from 1 to 12, not zero-padded).
     *
     * @var string
     */
    public $cardMonth;

    /**
     * CVV code.
     *
     * @var string
     */
    public $cardCode;

    /**
     * Payment token.
     *
     * @var string
     */
    public $token;

    private $errorShortCode;
    private $errorCode;

    /** @var EntryTran */
    private $entryTran;

    /** @var EntryTranResponse */
    private $entryTranResponse;

    /** @var ExecTran */
    private $execTran;

    /** @var ExecTranResponse */
    private $execTranResponse;

    /** @var AlterTran */
    private $alterTran;

    /** @var AlterTranResponse */
    private $alterTranResponse;

    // Test details
    public $testShopId;
    public $testShopPassword;
    public $testShopName;

    /**
     * Proceeds with a payment. Can be done just once for a single payment ID.
     *
     * @return bool if a valid response received
     */
    public function execute()
    {
        $this->checkRequiredVars([
            'paymentId',
            'amount',
        ]);

        if (isset($this->token)) {
            $this->checkRequiredVars(['token']);
        } else {
            $this->checkRequiredVars([
                'cardNumber',
                'cardYear',
                'cardMonth',
                'cardCode',
            ]);
        }

        // Setup transaction details (password etc)
        $this->entryTran = new EntryTran();

        if ($this->testShopId) {
            // Use sandbox methods if requested
            $this->entryTran->setMethods(new MethodsSandbox());
            $this->entryTran->setShop($this->testShopId, $this->testShopPassword, $this->testShopName);
        }

        $this->entryTran->OrderID = $this->paymentId;
        $this->entryTran->Amount = $this->amount;
        $this->entryTranResponse = $this->entryTran->dispatch();

        if (!$this->verifyResponse($this->entryTranResponse)) {
            return false;
        }

        $this->execTran = new ExecTran();
        // configure this request using earlier request's data
        $this->entryTran->setupOther($this->execTran);
        // payment ID must be the same as before
        $this->execTran->OrderID = $this->paymentId;
        // copy the access keys for the transaction
        $this->execTran->setAccessID($this->entryTranResponse);

        if (!isset($this->token)) {
            // setup card number and such
            $this->execTran->setCardNumber($this->cardNumber);
            $this->execTran->setCardExpiryYearMonth($this->cardYear, $this->cardMonth);
            $this->execTran->setCardSecurityCode($this->cardCode);
        } else {
            $this->execTran->setToken($this->token);
        }

        $this->execTranResponse = $this->execTran->dispatch();

        if (!$this->verifyResponse($this->execTranResponse)) {
            // @codeCoverageIgnoreStart
            return false; // this should never happen under normal circumstances
            // @codeCoverageIgnoreEnd
        }

        // verify the checksum
        if (!$this->execTran->verifyResponse($this->execTranResponse)) {
            // @codeCoverageIgnoreStart
            return false; // this should never happen under normal circumstances
            // @codeCoverageIgnoreEnd
        }

        $this->alterTran = new AlterTran();
        // configure this request using earlier request's data
        $this->entryTran->setupOther($this->alterTran);
        // copy the access keys
        $this->alterTran->setAccessID($this->entryTranResponse);
        // confirm the payment amount
        $this->alterTran->setActualSaleAmount($this->amount);

        $this->alterTranResponse = $this->alterTran->dispatch();

        // this should never return false under normal circumstances
        return $this->verifyResponse($this->alterTranResponse);
    }

    /**
     * Returns payment details. These should be stored in the database for the future use.
     *
     * @return \GMO\API\Response\ExecTranResponse
     */
    public function getResponse()
    {
        return $this->execTranResponse;
    }

    /**
     * Array of error codes.
     *
     * @return array
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Returns an array of maching error codes and descriptions.
     */
    public function getErrors()
    {
        $result = [];
        foreach ($this->errorCode as $code) {
            $result[$code] = Errors::getDescription($code);
        }

        return $result;
    }

    public function setupOther(Magic $method)
    {
        return $this->entryTran->setupOther($method);
    }

    private function verifyResponse($response)
    {
        if ($response instanceof ErrorResponse) {
            $this->errorShortCode = $response->ErrCode;
            $this->errorCode = $response->ErrInfo;

            return false;
        }

        return true;
    }

    private function checkRequiredVars($vars)
    {
        foreach ($vars as $requiredVar) {
            if (empty($this->{$requiredVar})) {
                throw new Exception("Missing $requiredVar");
            }
        }
    }
}
