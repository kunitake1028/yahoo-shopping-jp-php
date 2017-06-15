<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * きょうつく、あすつく
 *
 * @method static SuspectFlag NORMAL()
 * @method static SuspectFlag KYOUTSUKU()
 * @method static SuspectFlag ASUTSUKU()
 */
class ArriveType extends Enum
{
    /**
     * @var string NORMAL 通常
     */
    const NORMAL = '0';

    /**
     * @var string KYOUTSUKU きょうつく注文
     */
    const KYOUTSUKU = '1';

    /**
     * @var string ASUTSUKU あすつく注文
     */
    const ASUTSUKU = '2';

}
