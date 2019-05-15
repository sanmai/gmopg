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
