<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\GetItemStockInfoApi;
use Shippinno\YahooShoppingJp\Request\GetItemStockInfoRequest;

class GetItemStockInfoFactory implements AbstractFactory
{
    /**
     * @return GetItemStockInfoApi
     */
    public function api()
    {
        return new GetItemStockInfoApi;
    }

    /**
     * @return GetItemStockInfoRequest
     */
    public function request()
    {
        return new GetItemStockInfoRequest;
    }
}
