<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

class SearchOrders extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    public function httpMethod(): HttpMethod
    {
        return HttpMethod::POST();
    }

    /**
     * {@inheritdoc}
     */
    public function path(): string
    {
        return 'orderList';
    }
}