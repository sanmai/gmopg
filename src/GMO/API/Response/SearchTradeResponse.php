<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

class SearchTradeResponse extends Basic implements AccessIDInterface
{
    public $AccessID;
    public $AccessPass;
    public $OrderID;
    public $Status;
    public $ProcessDate;
    public $JobCd;
    public $ItemCode;
    public $Amount;
    public $Tax;
    public $SiteID;
    public $MemberID;
    public $CardNo;
    public $Expire;
    public $Method;
    public $PayTimes;
    public $Forward;
    public $TranID;
    public $Approve;
    public $ClientField1;
    public $ClientField2;
    public $ClientField3;

    public function getAccessID()
    {
        return $this->AccessID;
    }

    public function getAccessPass()
    {
        return $this->AccessPass;
    }
}
