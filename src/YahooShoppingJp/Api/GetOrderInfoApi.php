<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Exception\DistillationException;
use Shippinno\YahooShoppingJp\HttpMethod;

class GetOrderInfoApi extends AbstractApi
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
        return 'orderInfo';
    }

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        if(! isset($response['Result']['OrderInfo'])) {
            throw new DistillationException;
        }

        return $response['Result']['OrderInfo'];
    }

    /**
     * {@inheritdoc}
     */
    public function expectsParamsAsUploadedData(): bool
    {
        return true;
    }
}
