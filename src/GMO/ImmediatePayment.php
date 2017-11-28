<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO;

use GMO\API\MethodsSandbox;
use GMO\API\Response\ErrorResponse;
use GMO\API\Call\EntryTran;
use GMO\API\Response\EntryTranResponse;
use GMO\API\Call\ExecTran;
use GMO\API\Response\ExecTranResponse;
use GMO\API\Call\AlterTran;
use GMO\API\Response\AlterTranResponse;

class ImmediatePayment
{
    /**
     * Unique ID for the payment.
     * @var int
     */
    public $paymentId;

    /**
     * Payment amount (Japanese yen only)
     * @var int
     */
    public $amount;

    /**
     * Card number to be credited from
     *
     * For testing use 4111111111111111
     *
     * @var string
     */
    public $cardNumber;

    /**
     * Card's expiration year (four digits, e.g. 2038)
     * @var string
     */
    public $cardYear;

    /**
     * Card's expiration month (from 1 to 12, not zero-padded)
     * @var string
     */
    public $cardMonth;

    /**
     * CVV code
     * @var string
     */
    public $cardCode;

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
     * @return boolean if a valid response received
     */
    public function execute()
    {
        foreach (['paymentId', 'amount', 'cardNumber', 'cardYear', 'cardMonth', 'cardCode'] as $requiredVar) {
            if (empty($this->$requiredVar)) {
                throw new Exception("Missing $requiredVar");
            }
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

        // setup card number and such
        $this->execTran->setCardNumber($this->cardNumber);
        $this->execTran->setCardExpiryYearMonth($this->cardYear, $this->cardMonth);
        $this->execTran->setCardSecurityCode($this->cardCode);
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

        if (!$this->verifyResponse($this->alterTranResponse)) {
            // @codeCoverageIgnoreStart
            return false; // this should never happen under normal circumstances
            // @codeCoverageIgnoreEnd
        }

        return true;
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

    public function getErrorCode()
    {
        return $this->errorCode;
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
}


