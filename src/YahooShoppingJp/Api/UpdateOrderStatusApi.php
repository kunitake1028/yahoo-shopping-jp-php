<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;
use Shippinno\YahooShoppingJp\Exception\DistillationException;

class UpdateOrderStatusApi extends AbstractApi
{

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
        if (!isset($response['Result'])) {
            throw new DistillationException;
        }

        return $response;
    }

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
        return 'orderStatusChange';
    }

    /**
     * {@inheritdoc}
     */
    public function expectsFormFields(): bool
    {
        return false;
    }

}
