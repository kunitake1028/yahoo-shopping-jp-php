<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Exception\DistillationException;
use Shippinno\YahooShoppingJp\HttpMethod;

class GetItemStockInfoApi extends AbstractApi
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
        return 'getStock';
    }

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        if(! isset($response['ResultSet'])) {
            throw new DistillationException;
        }

        return $response['ResultSet'];
    }
}
