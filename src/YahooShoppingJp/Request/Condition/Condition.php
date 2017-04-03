<?php

namespace Shippinno\YahooShoppingJp\Request\Condition;

interface Condition
{
    public function apply(array $params): array;
}