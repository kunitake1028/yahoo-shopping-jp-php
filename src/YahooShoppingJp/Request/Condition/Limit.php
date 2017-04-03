<?php

namespace Shippinno\YahooShoppingJp\Request\Condition;

use LogicException;

class Limit implements Condition
{
    private $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function apply(array $params): array
    {
        if (isset($params['Search']['Result'])) {
            throw new LogicException('Result is already set.');
        }

        $params['Search']['Result'] = $this->limit;

        return $params;
    }
}
