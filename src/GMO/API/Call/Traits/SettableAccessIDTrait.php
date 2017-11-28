<?php
/*
 * Copyright © 2016 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call\Traits;
use GMO\API\Response\AccessIDInterface;

trait SettableAccessIDTrait
{
    public function setAccessID(AccessIDInterface $response)
    {
        $this->AccessID = $response->getAccessID();
        $this->AccessPass = $response->getAccessPass();
        return $this;
    }
}