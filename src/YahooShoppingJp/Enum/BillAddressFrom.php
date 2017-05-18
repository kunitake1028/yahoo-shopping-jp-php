<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;


/**
 * ご請求先住所引用元
 *
 * @method static BillAddressFrom HOME()
 * @method static BillAddressFrom OFFICE()
 * @method static BillAddressFrom SHIP()
 * @method static BillAddressFrom OTHER1()
 * @method static BillAddressFrom OTHER2()
 * @method static BillAddressFrom OTHER3()
 * @method static BillAddressFrom OTHER4()
 * @method static BillAddressFrom OTHERINPUT()
 */
class BillAddressFrom extends Enum
{

    /**
     * @var string HOME ご登録自宅住所
     */
    const HOME = 'P';

    /**
     * @var string OFFICE ご登録勤務先住所
     */
    const OFFICE = 'B';

    /**
     * @var string SHIP お届け先と同じ
     */
    const SHIP = 'ship';

    /**
     * @var string OTHER1 その他1
     */
    const OTHER1 = '01';

    /**
     * @var string OTHER2 その他2
     */
    const OTHER2 = '02';

    /**
     * @var string OTHER3 その他3
     */
    const OTHER3 = '03';

    /**
     * @var string OTHER4 その他4
     */
    const OTHER4 = '04';

    /**
     * @var string OTHERINPUT その他で入力
     */
    const OTHERINPUT = '0';

}
