<?php

namespace Shippinno\YahooShoppingJp\Exception;

use Exception;

class DistillationException extends Exception
{

    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}


