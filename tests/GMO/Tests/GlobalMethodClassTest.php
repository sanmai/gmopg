<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace {
    class GMO_Tests_GlobalMethodClassTest_Example extends \GMO\API\Call\Magic
    {
        public function getResponse()
        {
            return null;
        }
    }
}

namespace GMO\Tests {
    class GlobalMethodClassTest extends TestCase
    {
        public function testGlobalMethod()
        {
            $this->expectException(\GMO\Exception::class);
            $methods = new \GMO\API\MethodsSandbox();
            $methods->getUrl(new \GMO_Tests_GlobalMethodClassTest_Example());
        }
    }
}
