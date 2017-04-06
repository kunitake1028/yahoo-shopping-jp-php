<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Factory\UpdateItemStockFactory;
use Shippinno\YahooShoppingJp\HttpMethod;

class UpdateItemStockInfoApi extends AbstractApi
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
        return 'setStock';
    }

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        return $response['Result'];
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return true;
    }
}
