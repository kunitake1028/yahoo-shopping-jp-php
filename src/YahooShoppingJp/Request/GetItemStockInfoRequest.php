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
     * @param array $itemCodeList
     * @return self
     */
    public function setItemCodeList(array $itemCodeList): self
    {
        if (isset($this->params['item_code'])) {
            throw new LogicException('item_code is already set.');
        }

        if (count($itemCodeList) > 1000) {
            throw new LogicException('The number of elements of the itemCodeList array must be less than 1000.');
        }

        $this->params['item_code'] = implode(',', $itemCodeList);

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
