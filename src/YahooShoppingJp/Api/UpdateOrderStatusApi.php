<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

class UpdateOrderStatusApi extends AbstractApi
{

    /**
     * {@inheritdoc}
     */
    public function distillResponse(array $response): array
    {
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
