<?php

namespace Shippinno\YahooShoppingJp\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ShipMethod PAYMENT_A1()
 * @method static ShipMethod PAYMENT_A6()
 * @method static ShipMethod PAYMENT_A7()
 * @method static ShipMethod PAYMENT_A8()
 * @method static ShipMethod PAYMENT_A9()
 * @method static ShipMethod PAYMENT_A10()
 * @method static ShipMethod PAYMENT_A11()
 * @method static ShipMethod PAYMENT_A15()
 * @method static ShipMethod PAYMENT_A16()
 * @method static ShipMethod PAYMENT_C1()
 * @method static ShipMethod PAYMENT_C2()
 * @method static ShipMethod PAYMENT_C3()
 * @method static ShipMethod PAYMENT_D1()
 * @method static ShipMethod PAYMENT_Z1()
 * @method static ShipMethod METHOD16()
 */
class PayMethod extends Enum
{
    /**
     * @var string PAYMENT_A1 カード決済
     */
    const PAYMENT_A1 = 'payment_a1';

    /**
     * @var string PAYMENT_A6 コンビニ決済（セブンイレブン）
     */
    const PAYMENT_A6 = 'payment_a6';

    /**
     * @var string PAYMENT_A7 コンビニ決済（その他）
     */
    const PAYMENT_A7 = 'payment_a7';

    /**
     * @var string PAYMENT_A8 モバイルSuica決済
     */
    const PAYMENT_A8 = 'payment_a8';

    /**
     * @var string PAYMENT_A9 ドコモケータイ払い
     */
    const PAYMENT_A9 = 'payment_a9';

    /**
     * @var string PAYMENT_A10 auかんたん決済
     */
    const PAYMENT_A10 = 'payment_a10';

    /**
     * @var string PAYMENT_A11 ソフトバンクまとめて支払い
     */
    const PAYMENT_A11 = 'payment_a11';

    /**
     * @var string PAYMENT_A15 ペイジー
     */
    const PAYMENT_A15 = 'payment_a15';

    /**
     * @var string PAYMENT_A16 Yahoo!マネー/預金払い
     */
    const PAYMENT_A16 = 'payment_a16';

    // payment_b[1-6]：銀行振込（名称はストアの自由設定）

    /**
     * @var string PAYMENT_C1 ゆうちょ銀行（前払い）
     */
    const PAYMENT_C1 = 'payment_c1';

    /**
     * @var string PAYMENT_C2 ゆうちょ銀行（後払い）
     */
    const PAYMENT_C2 = 'payment_c2';

    /**
     * @var string PAYMENT_C3 現金書留
     */
    const PAYMENT_C3 = 'payment_c3';

    /**
     * @var string PAYMENT_D1 商品代引
     */
    const PAYMENT_D1 = 'payment_d1';

    // payment_e[1-15]：ストアの自由なお支払い方法名

    /**
     * @var string PAYMENT_Z1 ポイント全額払い
     */
    const PAYMENT_Z1 = 'payment_z1';

}
