<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static OrderStatus PREORDERED()
 * @method static OrderStatus PROCESSING()
 * @method static OrderStatus PENDING()
 * @method static OrderStatus CANCELLED()
 * @method static OrderStatus PROCESSED()
 */
class OrderStatus extends Enum
{

    /**
     * @var string PREORDERED 予約中
     */
    const PREORDERED = '1';

    /**
     * @var string PROCESSING 処理中
     */
    const PROCESSING = '2';

    /**
     * @var string PENDING 保留
     */
    const PENDING = '3';

    /**
     * @var string CANCELLED キャンセル
     */
    const CANCELLED = '4';

    /**
     * @var string PROCESSED 完了
     */
    const PROCESSED = '5';

}
