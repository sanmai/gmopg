<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

class ExecTranResponse extends Basic implements VerifiableResponse
{
    public $ACS;
    public $OrderID;
    public $Forward;
    public $Method;
    public $PayTimes;
    public $Approve;
    public $TranID;
    public $TranDate;
    public $CheckString;

    public function verifyWithPassword($password)
    {
        return hash_equals(md5(implode([$this->OrderID, $this->Forward, $this->Method,
            $this->PayTimes, $this->Approve, $this->TranID, $this->TranDate, $password])), $this->CheckString);
    }
}