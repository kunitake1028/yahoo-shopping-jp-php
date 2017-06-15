<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * 返金ステータス
 *
 * @method static RefundStatus UNNECESSARY()
 * @method static RefundStatus NECESSARY()
 * @method static RefundStatus REFUNDED()
 */
class RefundStatus extends Enum
{

    /**
     * @var string UNNECESSARY 不要
     */
    const UNNECESSARY = '0';

    /**
     * @var string UNNECESSARY 必要
     */
    const NECESSARY = '1';

    /**
     * @var string UNNECESSARY 返金済み
     */
    const REFUNDED = '2';

}
