<?php

namespace Shippinno\YahooShoppingJp\Request;

use LogicException;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;

class UpdateItemStockInfoRequest extends AbstractRequest
{
    private $params = [];

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

        if (strlen($sellerId) === 0) {
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

        if (! preg_match('/^[a-zA-Z0-9\-]{1,99}$/', $itemCode)) {
            throw new InvalidRequestException;
        }

        if (! preg_match('/^[a-zA-Z0-9\-]{0,99}$/', $subCode)) {
            throw new InvalidRequestException;
        }

        $this->params['item_code'] = $itemCode;

        if (strlen($subCode)) {
            $this->params['item_code'] = $this->params['item_code'].':'.$subCode;
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

        if (! preg_match('/^((\+|-)?[0-9]{1,9}|INI)$/', $quantity)) {
            throw new InvalidRequestException;
        }

        $this->params['quantity'] = is_int($quantity) ? strval($quantity) : $quantity;

        return $this;
    }

    /**
     * @param int $allowOverdraft
     * @return self
     * @throws InvalidRequestException
     */
    public function setAllowOverdraft(int $allowOverdraft): self
    {
        if (isset($this->params['allow_overdraft'])) {
            throw new LogicException('allow_overdraft is already set.');
        }

        if (! isset($this->key)) {
            throw new InvalidRequestException;
        }

        if (! ($allowOverdraft === 0 && $allowOverdraft === 1)) {
            throw new InvalidRequestException;
        }

        $this->params['allow_overdraft'] = $allowOverdraft;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        $this->validateRequest();

        return $this->params;
    }

    /**
     * @throws InvalidRequestException
     */
    private function validateRequest(): void
    {
        if (! isset($this->params['seller_id'])) {
            throw new InvalidRequestException;
        }

        if (! isset($this->params['item_code'])) {
            throw new InvalidRequestException;
        }

        if (! isset($this->params['quantity'])) {
            throw new InvalidRequestException;
        }
    }
}
