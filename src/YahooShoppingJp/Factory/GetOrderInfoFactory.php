<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\GetOrderInfoApi;
use Shippinno\YahooShoppingJp\Request\GetOrderInfoRequest;
use Shippinno\YahooShoppingJp\Request\SearchOrdersRequest;

class GetOrderInfoFactory implements AbstractFactory
{
    /**
     * @return GetOrderInfoApi
     */
    public function api()
    {
        return new GetOrderInfoApi;
    }

    /**
     * @return GetOrderInfoRequest
     */
    public function request()
    {
        return new GetOrderInfoRequest;
    }
}
