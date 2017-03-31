<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

class OrderCount extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    public function httpMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    public function path(): string
    {
        return 'orderCount';
    }

}
