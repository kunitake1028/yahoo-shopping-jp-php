<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\SearchOrdersApi;
use Shippinno\YahooShoppingJp\Request\SearchOrdersRequest;

class SearchOrdersFactory implements AbstractFactory
{
    /**
     * @return SearchOrdersApi
     */
    public function api()
    {
        return new SearchOrdersApi;
    }

    /**
     * @return SearchOrdersRequest
     */
    public function request()
    {
        return new SearchOrdersRequest;
    }
}
