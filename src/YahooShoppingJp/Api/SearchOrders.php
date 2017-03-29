<?php

namespace Shippinno\YahooShoppingJp\Api;

class SearchOrders extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    public function path(): string
    {
        return 'orderList';
    }
}