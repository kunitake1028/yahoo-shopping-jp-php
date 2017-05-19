<?php

namespace Shippinno\YahooShoppingJp\Request;

use InvalidArgumentException;
use LogicException;
use Shippinno\YahooShoppingJp\Api\GetItemStockInfoApi;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;
use Shippinno\YahooShoppingJp\Response\GetItemStockInfoResponse;

class GetItemStockInfoRequest extends AbstractRequest
{


    /**
     * @return GetItemStockInfoApi
     */
    public function api()
    {
        return new GetItemStockInfoApi;
    }

    /**
     * @return GetItemStockInfoResponse
     */
    public function response()
    {
        return new GetItemStockInfoResponse;
    }

    /**
     * @throws InvalidRequestException
     */
    protected function validateParams(): void
    {
        if (! isset($this->params['seller_id'])) {
            throw new InvalidRequestException('seller_id is not set.');
        }

        if (! isset($this->params['itemCodeList'])
            ||  !is_array($this->params['itemCodeList'])
            || count($this->params['itemCodeList']) == 0) {
            throw new InvalidRequestException('item_code is not set.');
        }

        if (count(array_unique($this->params['itemCodeList'])) < count($this->params['itemCodeList'])) {
            throw new LogicException('Some of item_code are duplicated.');
        }

        if (count($this->params['itemCodeList']) >= 1000) {
            throw new LogicException('The number of the item_code must be less than 1000.');
        }
    }

    /**
     * @param string $sellerId
     * @return self
     */
    public function setSellerId(string $sellerId): self
    {
        if (isset($this->params['seller_id'])) {
            throw new LogicException('seller_id is already set.');
        }

        $this->params['seller_id'] = $sellerId;

        return $this;
    }

    /**
     * @param string $itemCode
     * @return self
     */
    public function addItemCode(string $itemCode): self
    {
        if (strlen($itemCode) === 0) {
            throw new InvalidArgumentException('The item_code cannot be empty.');
        }

        if (strlen($itemCode) > 99) {
            throw new InvalidArgumentException('The item_code must be less than 99 characters.');
        }

        $this->params['itemCodeList'][] = $itemCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        $this->validateParams();

        $this->params['item_code'] = implode(',', $this->params['itemCodeList']);

        return $this->params;
    }


}
