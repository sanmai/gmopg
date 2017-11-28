<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call;

use GMO\API\Response\ExampleResponse;

class Example extends Magic
{
    public function getResponse()
    {
        return new ExampleResponse();
    }
}
