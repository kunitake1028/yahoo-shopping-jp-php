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
        $data = [];
        if(isset($response['Search']['OrderInfo'])) {
            $data = $response['Search']['OrderInfo'];
            if ((int) $response['Search']['TotalCount'] === 1) {
                $data = [$response['Search']['OrderInfo']];
            }
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return false;
    }
}
