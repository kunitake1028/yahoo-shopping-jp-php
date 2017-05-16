<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\UpdateOrderStatusApi;
use Shippinno\YahooShoppingJp\Request\UpdateOrderStatusRequest;

class UpdateOrderStatusFactory implements AbstractFactory
{

    /**
     * @return UpdateOrderStatusApi
     */
    public function api()
    {
        return new UpdateOrderStatusApi;
    }

    /**
     * @return UpdateOrderStatusRequest
     */
    public function request()
    {
        return new UpdateOrderStatusRequest;
    }

}
