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
     * @var string
     */
    const UNSHIPPABLE = '0';

    /**
     * @var string
     */
    const SHIPPABLE = '1';

    /**
     * @var string
     */
    const WAITING = '2';

    /**
     * @var string
     */
    const SHIPPED = '3';

    /**
     * @var string
     */
    const DELIVERED = '4';
}
