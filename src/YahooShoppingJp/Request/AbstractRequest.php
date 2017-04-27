<?php

namespace Shippinno\YahooShoppingJp\Request;

use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;
use Shippinno\YahooShoppingJp\Response\AbstractResponse;

abstract class AbstractRequest
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @return AbstractApi
     */
    abstract public function api();

    /**
     * @return AbstractResponse
     */
    abstract public function response();

    /**
     * @return void
     */
    abstract protected function validateParams();

    /**
     * @return string|array
     */
    public function getParams()
    {
        $this->validateParams();

        return $this->params;
    }

    /**
     * @param string $paramKey
     * @throws InvalidRequestException
     */
    public function requires($paramKey) {
        if (! isset($this->params[$paramKey])) {
            throw new InvalidRequestException($paramKey.' is required');
        }
    }
}
