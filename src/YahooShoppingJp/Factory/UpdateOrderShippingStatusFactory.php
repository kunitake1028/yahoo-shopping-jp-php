<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\UpdateOrderShippingStatusApi;
use Shippinno\YahooShoppingJp\Request\UpdateOrderShippingStatusRequest;

class UpdateOrderShippingStatusFactory implements AbstractFactory
{
    /**
     * @return UpdateOrderShippingStatusApi
     */
    public function api()
    {
        return new UpdateOrderShippingStatusApi();
    }

    /**
     * @return UpdateOrderShippingStatusRequest
     */
    public function request()
    {
        return new UpdateOrderShippingStatusRequest();
    }
}
