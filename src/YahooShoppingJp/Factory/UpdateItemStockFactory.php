<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\UpdateItemStockInfoApi;
use Shippinno\YahooShoppingJp\Request\UpdateItemStockInfoRequest;

class UpdateItemStockFactory implements AbstractFactory
{
    /**
     * @return UpdateItemStockInfoApi
     */
    public function api()
    {
        return new UpdateItemStockInfoApi;
    }

    /**
     * @return UpdateItemStockInfoRequest
     */
    public function request()
    {
        return new UpdateItemStockInfoRequest;
    }
}
