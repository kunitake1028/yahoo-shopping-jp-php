<?php

namespace Shippinno\YahooShoppingJp\Request\Condition;

use DateTimeImmutable;
use InvalidArgumentException;
use LogicException;

class OrderedBetween implements Condition
{
    private $from;
    private $to;

    public function __construct(DateTimeImmutable $from, DateTimeImmutable $to)
    {
        if (null === $from && null === $to) {
            throw new InvalidArgumentException('Both from and to are null.');
        }

        $this->from = $from;
        $this->to = $to;
    }

    public function apply(array $params): array
    {
        if (isset($params['Search']['Condition']['OrderTimeFrom'])) {
            throw new LogicException('OrderTimeFrom is already set.');
        }

        if (isset($params['Search']['Condition']['OrderTimeTo'])) {
            throw new LogicException('OrderTimeTo is already set.');
        }

        if (null !== $this->from) {
            $params['Search']['Condition']['OrderTimeFrom'] = $this->from->format('YmdHis');
        }

        if (null !== $this->to) {
            $params['Search']['Condition']['OrderTimeTo'] = $this->to->format('YmdHis');
        }

        return $params;
    }
}
