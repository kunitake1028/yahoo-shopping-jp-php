<?php

namespace Shippinno\YahooShoppingJp\Factory;

use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Shippinno\YahooShoppingJp\Request\AbstractRequest;

interface AbstractFactory
{
    public function api();

    public function request();
}
