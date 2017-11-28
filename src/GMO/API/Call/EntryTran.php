<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call;

use GMO\API\Response\EntryTranResponse;
use GMO\API\Constants;

class EntryTran extends Magic
{
    public $OrderID;
    public $JobCd = Constants::JOB_CD_AUTH;
    public $ItemCode = Constants::ITEM_CODE;
    public $Amount;
    public $Tax = 0;
    public $TdFlag = 0;

    public function dispatch()
    {
        $this->withRequired($this->OrderID, $this->Amount);

        return parent::dispatch();
    }

    public function getResponse()
    {
        return new EntryTranResponse();
    }
}