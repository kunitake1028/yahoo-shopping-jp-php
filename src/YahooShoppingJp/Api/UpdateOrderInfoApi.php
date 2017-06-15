<?php

namespace Shippinno\YahooShoppingJp\Api;

use Shippinno\YahooShoppingJp\HttpMethod;

/**
 * Class UpdateOrderInfoApi
 *
 * @package Shippinno\YahooShoppingJp\Api
 */
class UpdateOrderInfoApi extends AbstractApi
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
        return 'orderChange';
    }

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
    public function expectsFormFields(): bool
    {
        return false;
    }

}