<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

class SearchOrdersApi extends AbstractApi
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
        return 'orderList';
    }

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        if(! isset($response['Search']['OrderInfo'])) {
            return [];
        }

        return $response['Search']['OrderInfo'];
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return false;
    }
}
