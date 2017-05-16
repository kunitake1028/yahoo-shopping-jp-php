<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Factory\UpdateItemStockFactory;
use Shippinno\YahooShoppingJp\HttpMethod;
use YConnect\Exception\ApiException;

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
        if (! isset($response['@attributes']['totalResultsAvailable'])) {
            throw new ApiException('予期しないエラー');
        }

        return isset($response['Result']) ? $response['Result'] : [];
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return true;
    }
}
