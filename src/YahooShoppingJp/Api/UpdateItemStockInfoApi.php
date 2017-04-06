<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Factory\UpdateItemStockFactory;
use Shippinno\YahooShoppingJp\HttpMethod;

class UpdateItemStockInfoApi extends AbstractApi
{
    /**
     * @return string
     */
    public function httpMethod(): HttpMethod
    {
        return HttpMethod::POST();
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return 'setStock';
    }

    /**
     * @param array $response
     * @return array
     */
    public function distillResponse(array $response): array
    {
        return $response['Result'];
    }

    /**
     * @return bool
     */
    public function expectsFormFields(): bool
    {
        return true;
    }
}
