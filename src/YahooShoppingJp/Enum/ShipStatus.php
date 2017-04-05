<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ShipStatus UNSHIPPABLE()
 * @method static ShipStatus SHIPPABLE()
 * @method static ShipStatus WAITING()
 * @method static ShipStatus SHIPPED()
 * @method static ShipStatus DELIVERED()
 */
class ShipStatus extends Enum
{
    /**
     * @var integer
     */
    const UNSHIPPABLE = 0;

    /**
     * @var integer
     */
    const SHIPPABLE = 1;

    /**
     * @var integer
     */
    const WAITING = 2;

    /**
     * @var integer
     */
    const SHIPPED = 3;

    /**
     * @var integer
     */
    const DELIVERED = 4;
}
