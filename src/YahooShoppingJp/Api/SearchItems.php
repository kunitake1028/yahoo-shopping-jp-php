<?php

namespace Shippinno\YahooShoppingJp\Api;

use ErrorException;
use Shippinno\YahooShoppingJp\Exception\DistillationException;
use Shippinno\YahooShoppingJp\HttpMethod;

class SearchItems extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    public function httpMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    /**
     * {@inheritdoc}
     */
    public function path(): string
    {
        return 'myItemList';
    }

    /**
     * @param array $response
     * @return array
     */
    public function distillResponse(array $response): array
    {

    }
}