<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

class EntryTranResponse extends Basic implements AccessIDInterface
{
    public $AccessID;
    public $AccessPass;

    public function getAccessID()
    {
        return $this->AccessID;
    }

    public function getAccessPass()
    {
        return $this->AccessPass;
    }
}