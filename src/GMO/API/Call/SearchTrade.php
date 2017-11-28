<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Call;

use GMO\API\Response\SearchTradeResponse;

class SearchTrade extends Magic
{
    public $OrderID;

    public function dispatch()
    {
        $this->withRequired($this->OrderID);

        return parent::dispatch();
    }

    /** @return SearchTradeResponse */
    public function getResponse()
    {
        return new SearchTradeResponse();
    }
}
