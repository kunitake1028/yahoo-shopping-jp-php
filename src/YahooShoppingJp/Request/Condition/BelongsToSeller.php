<?php

namespace Shippinno\YahooShoppingJp\Request\Condition;

use LogicException;

class BelongsToSeller implements Condition
{
    private $sellerId;

    public function __construct(string $sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function apply(array $params): array
    {
        if (isset($params['SellerId'])) {
            throw new LogicException('SellerId is already set.');
        }

        $params['SellerId'] = $this->sellerId;

        return $params;
    }
}
