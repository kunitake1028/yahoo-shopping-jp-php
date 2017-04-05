<?php

namespace Shippinno\YahooShoppingJp\Request;

abstract class AbstractRequest
{
    /**
     * @return string|array
     */
    abstract public function getParams();
}