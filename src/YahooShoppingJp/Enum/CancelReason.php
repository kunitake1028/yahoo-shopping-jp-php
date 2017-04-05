<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static CancelReason CANCELLED()
 * @method static CancelReason RETURNED()
 * @method static CancelReason UNPAID()
 * @method static CancelReason ADDRESS_UNKNOWN()
 * @method static CancelReason REJECTED()
 * @method static CancelReason CONTACT_LOST()
 * @method static CancelReason DUPLICATED()
 * @method static CancelReason AUTHORIZATION_FAILED()
 * @method static CancelReason OTHER_CUSTOMER_REASON()
 * 
 * @method static CancelReason PAYMENT_METHOD_INVALID()
 * @method static CancelReason STOCKOUT()
 * @method static CancelReason SALES_SUSPENDED()
 * @method static CancelReason OTHER_STORE_REASON()
 */
class CancelReason extends Enum
{

    /**
     * @var string CANCELLED 注文者都合 キャンセル
     */
    const CANCELLED = '100';

    /**
     * @var string RETURNED 注文者都合 返品
     */
    const RETURNED = '110';

    /**
     * @var string UNPAID 注文者都合 未入金
     */
    const UNPAID = '120';

    /**
     * @var string ADDRESS_UNKNOWN 注文者都合 住所不明
     */
    const ADDRESS_UNKNOWN = '130';

    /**
     * @var string REJECTED 注文者都合 受け取り拒否
     */
    const REJECTED = '140';

    /**
     * @var string CONTACT_LOST 注文者都合 連絡不通
     */
    const CONTACT_LOST = '150';

    /**
     * @var string DUPLICATED 注文者都合 重複注文
     */
    const DUPLICATED = '160';

    /**
     * @var string AUTHORIZATION_FAILED 注文者都合 決済審査不可
     */
    const AUTHORIZATION_FAILED = '170'; //
    /**
     * @var string OTHER_CUSTOMER_REASON 注文者都合 その他
     */

    const OTHER_CUSTOMER_REASON = '180';

    /**
     * @var string PAYMENT_METHOD_INVALID ストア都合 決済方法都合
     */
    const PAYMENT_METHOD_INVALID = '200';

    /**
     * @var string STOCKOUT ストア都合 欠品
     */
    const STOCKOUT = '210';

    /**
     * @var string SALES_SUSPENDED ストア都合 販売中止
     */
    const SALES_SUSPENDED = '220';

    /**
     * @var string OTHER_STORE_REASON ストア都合 その他
     */
    const OTHER_STORE_REASON = '230';

}
