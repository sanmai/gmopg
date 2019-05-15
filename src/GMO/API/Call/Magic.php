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

use GMO\API\Constants;
use GMO\API\Defaults;
use GMO\API\Exception\FailedRequirement;
use GMO\API\MethodsAbstract;
use GMO\API\Response\Basic;
use GMO\API\Response\VerifiableResponse;

abstract class Magic
{
    private $ShopID;
    private $ShopPass;
    private $TdTenantName;

    public $User = Constants::API_USER;
    public $Version = Constants::API_VERSION;

    public function setShop($shopId, $shopPassword, $name)
    {
        $this->ShopID = $shopId;
        $this->ShopPass = $shopPassword;
        // This should be no longer than 25 bytes in decoded form
        $this->TdTenantName = base64_encode(mb_convert_encoding($name, 'EUC-JP'));

        return $this;
    }

    private $methods;

    public function setMethods(MethodsAbstract $methods)
    {
        $this->methods = $methods;

        return $this;
    }

    public function setupOther(Magic $method)
    {
        // calling order must be exactly such
        $method->setMethods($this->getMethods());
        $method->setShop($this->ShopID, $this->ShopPass, $this->TdTenantName);
    }

    public function verifyResponse(VerifiableResponse $response)
    {
        return $response->verifyWithPassword($this->ShopPass);
    }

    /** @return MethodsAbstract */
    private function getMethods()
    {
        // @codeCoverageIgnoreStart
        if (empty($this->methods)) {
            $this->setDefaultShop();
        }
        // @codeCoverageIgnoreEnd

        return $this->methods;
    }

    /**
     * @codeCoverageIgnore
     */
    public function setDefaultShop()
    {
        Defaults::setupCall($this);
    }

    public function getRequestBase()
    {
        // @codeCoverageIgnoreStart
        if (empty($this->ShopID)) {
            // use defaults if needed
            $this->setDefaultShop();
        }
        // @codeCoverageIgnoreEnd

        return [
            'ShopID'       => $this->ShopID,
            'ShopPass'     => $this->ShopPass,
            'TdTenantName' => $this->TdTenantName,
        ];
    }

    public function withRequired()
    {
        foreach (func_get_args() as $val) {
            if (empty($val)) {
                throw new FailedRequirement('Failed requirement');
            }
        }

        return $this;
    }

    /** @return Basic */
    public function dispatch()
    {
        return $this->getMethods()->dispatch($this);
    }

    abstract public function getResponse();
}
