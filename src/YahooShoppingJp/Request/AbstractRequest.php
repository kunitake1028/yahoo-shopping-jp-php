<?php

namespace Shippinno\YahooShoppingJp\Request;

abstract class AbstractRequest
{
    /**
     * @return array
     */
    abstract public function getParams(): array;
}