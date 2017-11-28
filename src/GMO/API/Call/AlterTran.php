<?php
 /*
  * Copyright © 2016 Alexey Kopytko.
  * Distributed under the MIT License.
  */

namespace GMO\API\Call;

use GMO\API\Response\AlterTranResponse;
use GMO\API\Call\Traits\SettableAccessIDTrait;

class AlterTran extends Magic
{
    use SettableAccessIDTrait;

    const JOB_CODE_SALES = 'SALES'; // 実売上
    const JOB_CODE_VOID = 'VOID'; // 取消
    const JOB_CODE_RETURN = 'RETURN'; // 返品
    const JOB_CODE_RETURNX = 'RETURNX'; // 月跨り返品

    public $AccessID;
    public $AccessPass;

    public $JobCd;
    /**
     * 利用金額 仮売上を実施した際の【取引登録】で指定した金額を設定します。
     * @var int
     */
    public $Amount;

    public function setActualSaleAmount($amount)
    {
        $this->Amount = $amount;
        $this->JobCd = self::JOB_CODE_SALES;

        return $this;
    }

    public function dispatch()
    {
        $this->withRequired($this->JobCd, $this->AccessID, $this->AccessPass);

        return parent::dispatch();
    }

    public function getResponse()
    {
        return new AlterTranResponse();
    }
}
