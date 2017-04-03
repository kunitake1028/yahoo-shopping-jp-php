<?php

namespace Shippinno\YahooShoppingJp\Request;

use Shippinno\YahooShoppingJp\Request\Condition\Condition;

class Parameters
{
    private $conditions = [];

    public function addCondition(Condition $condition)
    {
        $this->conditions[] = $condition;

        return $this;
    }

    public function toArray(): array
    {
        $params = [];

        foreach ($this->conditions as $condition) {
            $params = $condition->apply($params);
        }

        return $params;
    }
}
