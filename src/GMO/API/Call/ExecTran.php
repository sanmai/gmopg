<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call;

use GMO\API\Response\ExecTranResponse;
use GMO\API\Exception;
use GMO\API\Call\Traits\SettableAccessIDTrait;

class ExecTran extends Magic
{
    use SettableAccessIDTrait;

    const LUMP_SUM_PAYMENT = 1;

    public $AccessID;
    public $AccessPass;
    public $OrderID;
    public $Method = self::LUMP_SUM_PAYMENT;
    public $PayTimes = '';
    public $CardNo;
    public $Expire; // YYMM
    public $SecurityCode;
    public $HttpAccept;
    public $HttpUserAgent;
    public $DeviceCategory = 0;

    public function setCardNumber($number)
    {
        $this->CardNo = (string) $number;

        return $this;
    }

    public function setCardExpiryYearMonth($year, $month)
    {
        $date = new \DateTime();
        $date->setDate($year, $month, 1);
        $this->setCardExpiry($date);

        return $this;
    }

    public function setCardExpiry(\DateTime $date)
    {
        $this->Expire = $date->format('ym');

        return $this;
    }

    public function setCardSecurityCode($cvv)
    {
        $this->SecurityCode = $cvv;

        return $this;
    }

    public function dispatch()
    {
        $this->withRequired($this->OrderID, $this->AccessID, $this->AccessPass);
        $this->withRequired($this->CardNo, $this->Expire, $this->SecurityCode);

        // needed by the GMO PG for whatever reasons there are
        $this->HttpAccept = $_SERVER['HTTP_ACCEPT'];
        $this->HttpUserAgent = $_SERVER['HTTP_USER_AGENT'];

        return parent::dispatch();
    }

    /** @return ExecTranResponse */
    public function getResponse()
    {
        return new ExecTranResponse();
    }
}
