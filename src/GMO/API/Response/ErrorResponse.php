<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

class ErrorResponse extends Basic
{
    public $ErrCode;
    public $ErrInfo;

    public function hasError()
    {
        return !empty($this->ErrCode);
    }

    public function splitErrors()
    {
        if (!is_array($this->ErrCode)) {
            $this->ErrCode = explode('|', $this->ErrCode);
        }
        if (!is_array($this->ErrInfo)) {
            $this->ErrInfo = explode('|', $this->ErrInfo);
        }
    }
}
