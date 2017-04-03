<?php

namespace Shippinno\YahooShoppingJp\Request\Condition;

use LogicException;

class Offset implements Condition
{
    private $offset;

    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    public function apply(array $params): array
    {
        if (isset($params['Search']['Start'])) {
            throw new LogicException('Start is already set.');
        }

        $params['Search']['Start'] = $this->offset;

        return $params;
    }
}
