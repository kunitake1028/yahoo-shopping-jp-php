<?php

namespace Shippinno\YahooShoppingJp\Request;

use LogicException;

class GetItemStockInfoRequest extends AbstractRequest
{
    private $params = [];

    public function __construct()
    {
        //
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
     * @param array $itemCodes
     * @return self
     */
    public function setItemCodes(array $itemCodes): self
    {
        if (isset($this->params['item_code'])) {
            throw new LogicException('item_code is already set.');
        }

        if (count($this->params['item_code']) > 1000) {
            throw new LogicException('The number of elements of the item_code array must be less than 1000.');
        }

        $this->params['item_code'] = $itemCodes;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
