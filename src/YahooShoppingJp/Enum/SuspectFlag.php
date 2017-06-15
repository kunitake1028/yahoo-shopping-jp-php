<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * 悪戯フラグ
 *
 * @method static SuspectFlag NONSUSPECT()
 * @method static SuspectFlag SUSPECTING()
 * @method static SuspectFlag UNSUSPECT()
 */
class SuspectFlag extends Enum
{
    /**
     * @var string UNSUSPECTING 非悪戯注文
     */
    const UNSUSPECTING = '0';

    /**
     * @var string SUSPECTING 悪戯注文
     */
    const SUSPECTING = '1';

    /**
     * @var string UNSUSPECTED 悪戯解除済注文
     */
    const UNSUSPECTED = '2';

}
