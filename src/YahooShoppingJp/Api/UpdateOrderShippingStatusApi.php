<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\Exception\DistillationException;
use Shippinno\YahooShoppingJp\HttpMethod;

class UpdateOrderShippingStatusApi extends AbstractApi
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
        return 'orderShipStatusChange';
    }

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        if(! isset($response['Result']['Status'])
        || $response['Result']['Status'] !== 'OK') {
            throw new DistillationException;
        }

        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return false;
    }
}