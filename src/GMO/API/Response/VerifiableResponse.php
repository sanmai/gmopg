<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API\Response;

interface VerifiableResponse
{
    public function verifyWithPassword($password);
}
