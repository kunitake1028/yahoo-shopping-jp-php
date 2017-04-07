<?php

namespace Shippinno\YahooShoppingJp\Request;

use LogicException;

class GetItemStockInfoRequest extends AbstractRequest
{
    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $itemCodeList = [];

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
    public function addItemCode(string $itemCode): self
    {
        if (strlen($itemCode) >= 99) {
            throw new LogicException('The itemCode must be less than 99 characters.');
        }

        if (count($this->itemCodeList) >= 1000) {
            throw new LogicException('The number of the itemCode must be less than 1000.');
        }

        $this->itemCodeList[] = $itemCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        $this->params['item_code'] = implode(',', $this->itemCodeList);

        return $this->params;
    }
}
