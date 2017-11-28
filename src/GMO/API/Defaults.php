<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API;


use GMO\API\Call\Magic;

/**
 * Site-wide defaults for all API operations.
 *
 * @codeCoverageIgnore
 */
class Defaults
{
    const GMO_SHOP_ID = 'GMO_SHOP_ID';
    const GMO_SHOP_PASSWORD = 'GMO_SHOP_PASSWORD';
    const GMO_SHOP_NAME = 'GMO_SHOP_NAME';
    const GMO_TRIAL_MODE = 'GMO_TRIAL_MODE';

    private static $shopId;
    private static $password;
    private static $name;
    private static $methods;

    public static function setShopID($shopId)
    {
        self::$shopId = $shopId;
    }

    public static function setPassword($password)
    {
        self::$password = $password;
    }

    public static function setShopName($name)
    {
        self::$name = $name;
    }

    public static function setMethods($methods)
    {
        self::$methods = $methods;
    }

    public static function setupCall(Magic $call)
    {
        if (empty(self::$shopId)) {
            // set the defaults from known constants
            self::setShopID(constant(self::GMO_SHOP_ID));
            self::setPassword(constant(self::GMO_SHOP_PASSWORD));
            self::setShopName(constant(self::GMO_SHOP_NAME));
        }

        if (empty(self::$methods)) {
            // use sandbox methods if a trial mode was requested
            if (!defined(self::GMO_TRIAL_MODE)) {
                self::setMethods(new MethodsActual());
            } else {
                self::setMethods(constant(self::GMO_TRIAL_MODE) ? new MethodsSandbox() : new MethodsActual());
            }
        }

        $call->setShop(self::$shopId, self::$password, self::$name);
        $call->setMethods(self::$methods);

        return $call;
    }
}