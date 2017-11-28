<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call;

use GMO\API\Defaults;
use GMO\API\MethodsAbstract;
use GMO\API\Response\Basic;
use GMO\API\Exception\FailedRequirement;
use GMO\API\Response\VerifiableResponse;
use GMO\API\Constants;

abstract class Magic
{
    private $ShopID;
    private $ShopPass;
    private $TdTenantName;

    public $User =  Constants::API_USER;
    public $Version = Constants::API_VERSION;

    public function setShop($shopId, $shopPassword, $name)
    {
        $this->ShopID = $shopId;
        $this->ShopPass = $shopPassword;
        $this->TdTenantName = base64_encode($name);

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
            'ShopID' => $this->ShopID,
            'ShopPass' => $this->ShopPass,
            'TdTenantName' => $this->TdTenantName
        ];
    }

    public function withRequired()
    {
        foreach (func_get_args() as $val) {
            if (empty($val)) {
                throw new FailedRequirement("Failed requirement");
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
