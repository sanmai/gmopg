<?php
/*
 * Copyright © 2018 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\Tests;

use GMO\API\Errors;

class ErrorsTest extends TestCase
{
    public function testFindEnglish()
    {
        $this->assertContains('order ID', Errors::getDescription(Errors::DUPLICATE_ORDER_ID));
    }

    public function testFindJapanese()
    {
        $this->assertContains('Suica', Errors::getDescription('S01000002'));
    }

    public function testUnknownError()
    {
        $this->assertContains('unknown', Errors::getDescription('TEST123'));
    }

}