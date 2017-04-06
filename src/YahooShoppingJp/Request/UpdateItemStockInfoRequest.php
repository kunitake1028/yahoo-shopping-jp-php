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
    public function setItemCode(string $itemCode): self
    {
        if (isset($this->params['item_code'])) {
            throw new LogicException('item_code is already set.');
        }

        $this->params['item_code'] = $itemCode;

        return $this;
    }

    /**
     * @param string $quantity
     * @return self
     */
    public function setQuantity(string $quantity): self
    {
        if (isset($this->params['quantity'])) {
            throw new LogicException('quantity is already set.');
        }

        $this->params['quantity'] = $quantity;

        return $this;
    }

    /**
     * @param int $allowOverdraft
     * @return self
     */
    public function setAllowOverdraft(int $allowOverdraft): self
    {
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
        if (! (isset($this->params['seller_id']) && isset($this->params['item_code']) && isset($this->params['quantity']))) {
            throw new InvalidRequestException;
        }
    }
}
