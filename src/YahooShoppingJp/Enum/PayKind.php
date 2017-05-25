<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * 支払い種別
 *
 * @method static PayKind CARD()
 * @method static PayKind NETBANK()
 * @method static PayKind CARRIER()
 * @method static PayKind CASHON()
 * @method static PayKind CONVENIENCE()
 * @method static PayKind ELECTRONIC()
 * @method static PayKind OTHER()
 */
class PayKind extends Enum
{

    /**
     * @var string CARD カード
     */
    const CARD = '0';

    /**
     * @var string NETBANK ネットバンキング
     */
    const NETBANK = '1';

    /**
     * @var string CARRIER キャリア決済
     */
    const CARRIER = '2';

    /**
     * @var string TRANSFER 振込
     */
    const TRANSFER = '3';

    /**
     * @var string CASHON 代引
     */
    const CASHON = '4';

    /**
     * @var string CONVENIENCE コンビニ
     */
    const CONVENIENCE = '5';

    /**
     * @var string ELECTRONIC 電子マネー
     */
    const ELECTRONIC = '6';

    /**
     * @var string OTHER その他
     */
    const OTHER = '7';

}
