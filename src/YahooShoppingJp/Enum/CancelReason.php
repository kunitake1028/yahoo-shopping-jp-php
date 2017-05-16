<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * [Enum]キャンセル理由
 *
 * 1xx 注文者都合
 * 2xx ストア都合
 * 
 * @method static CancelReason CANCELLED()
 * @method static CancelReason RETURNED()
 * @method static CancelReason UNPAID()
 * @method static CancelReason ADDRESS_UNKNOWN()
 * @method static CancelReason REJECTED()
 * @method static CancelReason CONTACT_LOST()
 * @method static CancelReason DUPLICATED()
 * @method static CancelReason AUTHORIZATION_FAILED()
 * @method static CancelReason OTHER_CUSTOMER_REASON()
 * @method static CancelReason PAYMENT_METHOD_INVALID()
 * @method static CancelReason STOCKOUT()
 * @method static CancelReason SALES_SUSPENDED()
 * @method static CancelReason OTHER_STORE_REASON()
 */
class CancelReason extends Enum
{
    /**
     * @var string CANCELLED キャンセル
     */
    const CANCELLED = '100';

    /**
     * @var string RETURNED 返品
     */
    const RETURNED = '110';

    /**
     * @var string UNPAID 未入金
     */
    const UNPAID = '120';

    /**
     * @var string ADDRESS_UNKNOWN 住所不明
     */
    const ADDRESS_UNKNOWN = '130';

    /**
     * @var string REJECTED 受け取り拒否
     */
    const REJECTED = '140';

    /**
     * @var string CONTACT_LOST 連絡不通
     */
    const CONTACT_LOST = '150';

    /**
     * @var string DUPLICATED 重複注文
     */
    const DUPLICATED = '160';

    /**
     * @var string AUTHORIZATION_FAILED 決済審査不可
     */
    const AUTHORIZATION_FAILED = '170';

    /**
     * @var string OTHER_CUSTOMER_REASON その他
     */
    const OTHER_CUSTOMER_REASON = '180';

    /**
     * @var string PAYMENT_METHOD_INVALID 決済方法都合
     */
    const PAYMENT_METHOD_INVALID = '200';

    /**
     * @var string STOCKOUT 欠品
     */
    const STOCKOUT = '210';

    /**
     * @var string SALES_SUSPENDED 販売中止
     */
    const SALES_SUSPENDED = '220';

    /**
     * @var string OTHER_STORE_REASON その他
     */
    const OTHER_STORE_REASON = '230';

}
