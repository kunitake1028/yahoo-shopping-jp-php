<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

abstract class AbstractApi
{
    /**
     * @return string
     */
    abstract public function httpMethod(): HttpMethod;

    /**
     * @return string
     */
    abstract public function path(): string;
}
