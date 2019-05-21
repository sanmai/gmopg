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

namespace GMO\API\Call;

use GMO\API\Call\Traits\SettableAccessIDTrait;
use GMO\API\Response\ExecTranResponse;

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
    public $Token;
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

    public function setToken($token)
    {
        $this->Token = $token;

        return $this;
    }

    public function dispatch()
    {
        $this->withRequired($this->OrderID, $this->AccessID, $this->AccessPass);

        if (!isset($this->Token)) {
            $this->withRequired($this->CardNo, $this->Expire, $this->SecurityCode);
        }

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
