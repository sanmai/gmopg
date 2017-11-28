<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

abstract class Basic
{
    public function hasError()
    {
        return false;
    }
}
