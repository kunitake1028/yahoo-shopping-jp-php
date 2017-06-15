<?php


namespace Shippinno\YahooShoppingJp\Enum;


use MyCLabs\Enum\Enum;

/**
 * 支払い分類
 *
 * @method static PayType PAYAFTER()
 * @method static PayType PAYBEFORE()
 */
class PayType extends Enum
{
    /**
     * @var string PAYAFTER 後払い
     */
    const PAYAFTER = '0';

    /**
     * @var string PAYBEFORE 前払い
     */
    const PAYBEFORE = '1';
}
