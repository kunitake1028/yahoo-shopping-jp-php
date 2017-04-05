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
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
