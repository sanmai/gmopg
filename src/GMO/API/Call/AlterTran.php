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
