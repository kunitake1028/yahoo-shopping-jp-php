<?php

namespace Shippinno\YahooShoppingJp\Request;

use InvalidArgumentException;
use LogicException;
use Shippinno\YahooShoppingJp\Api\UpdateItemStockInfoApi;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;
use Shippinno\YahooShoppingJp\Response\UpdateItemStockInfoResponse;

class UpdateItemStockInfoRequest extends AbstractRequest
{
    /**
     * @return UpdateItemStockInfoApi
     */
    public function api()
    {
        return new UpdateItemStockInfoApi;
    }

    /**
     * @return UpdateItemStockInfoResponse
     */
    public function response()
    {
        return new UpdateItemStockInfoResponse;
    }

    /**
     * @throws InvalidRequestException
     */
    protected function validateParams(): void
    {
        if (!isset($this->params['seller_id'])) {
            throw new InvalidRequestException('seller_id is not set.');
        }

        if (!isset($this->params['item_code'])) {
            throw new InvalidRequestException('item_code is not set.');
        }

        if (!isset($this->params['quantity'])) {
            throw new InvalidRequestException('quantity is not set.');
        }
    }

    /**
     * @param string $sellerId
     * @return self
     * @throws InvalidRequestException
     */
    public function setSellerId(string $sellerId): self
    {
        if (isset($this->params['seller_id'])) {
            throw new LogicException('seller_id is already set.');
        }

        if (!preg_match('/^[a-z0-9\-]{3,20}$/', $sellerId)) {
            throw new InvalidArgumentException;
        }

        $this->params['seller_id'] = $sellerId;

        return $this;
    }

    /**
     * @param string $itemCode
     * @param string $subCode
     * @return self
     * @throws InvalidRequestException
     */
    public function setItemCode(string $itemCode, string $subCode = ''): self
    {
        if (isset($this->params['item_code'])) {
            throw new LogicException('item_code is already set.');
        }

        if (!preg_match('/^[a-zA-Z0-9\-]{1,99}$/', $itemCode)) {
            throw new InvalidRequestException('item_code error.');
        }
        $this->params['item_code'] = $itemCode;

        if (strlen($subCode)) {
            if (!preg_match('/^[a-zA-Z0-9\-]{1,99}$/', $subCode)) {
                throw new InvalidRequestException('sub_code error.');
            }
            $this->params['item_code'] = $this->params['item_code'] . ':' . $subCode;
        }

        return $this;
    }

    /**
     * @param int|string $quantity
     * @return self
     * @throws InvalidRequestException
     */
    public function setQuantity($quantity): self
    {
        if (isset($this->params['quantity'])) {
            throw new LogicException('quantity is already set.');
        }

        if (!preg_match('/^((\+|-)?[0-9]{1,9}|INI)$/', $quantity)) {
            throw new InvalidRequestException('Only number or INI can be set.');
        }

        $this->params['quantity'] = is_int($quantity) ? strval($quantity) : $quantity;

        return $this;
    }

    /**
     * @param bool $allowOverdraft
     * @return self
     */
    public function setAllowOverdraft(bool $allowOverdraft): self
    {
        if (isset($this->params['allow_overdraft'])) {
            throw new LogicException('allow_overdraft is already set.');
        }

        $this->params['allow_overdraft'] = (int)$allowOverdraft;

        return $this;
    }

}
