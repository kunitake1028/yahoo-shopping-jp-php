<?php

namespace Shippinno\YahooShoppingJp\Request;

use LogicException;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;

class UpdateItemStockInfoRequest extends AbstractRequest
{
    private $params = [];
    private $quantity = [];
    private $itemCode = [];
    private $allowOverdraft = [];
    private $key;

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

        if (! strlen($sellerId) > 0) {
            throw new InvalidRequestException;
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

        $this->key = $itemCode;

        if (strlen($subCode) ) {
            $this->key .= ':'.$subCode;
        }

        if (! isset($this->itemCode[$this->key])) {
            $this->itemCode[$this->key] = $this->key;
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

        if (! isset($this->key)) {
            throw new InvalidRequestException;
        }

        if (! preg_match('/^((\+|-)?[0-9]{1,9}|INI)$/', $quantity)) {
            throw new InvalidRequestException;
        }

        $this->quantity[$this->key] = is_int($quantity) ? strval($quantity) : $quantity;

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

        $this->allowOverdraft[$this->key] = $allowOverdraft;

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
        $itemCodeLength = count($this->itemCode);
        $quantityLength = count($this->quantity);
        $allowOverdraftLength = count($this->allowOverdraft);

        if ($itemCodeLength !== $quantityLength) {
            throw new InvalidRequestException;
        }

        if (0 < $allowOverdraftLength && $itemCodeLength !== $allowOverdraftLength) {
            throw new InvalidRequestException;
        }

        if (1000 < $itemCodeLength) {
            throw new InvalidRequestException;
        }

        $this->params['item_code'] = join(',', $this->itemCode);
        $this->params['quantity'] = join(',', $this->quantity);

        if (0 < $allowOverdraftLength) {
            $this->params['allow_overdraft'] = join(',', $this->allowOverdraft);
        }

        if (! isset($this->params['seller_id'])) {
            throw new InvalidRequestException;
        }

        if (! strlen($this->params['item_code']) > 0) {
            throw new InvalidRequestException;
        }

        if (! strlen($this->params['quantity']) > 0) {
            throw new InvalidRequestException;
        }
    }
}
