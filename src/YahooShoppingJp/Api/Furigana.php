<?php

namespace Shippinno\YahooShoppingJp\Api;

/**
 * Description of Furigana
 *
 * @author FUKUI
 */
class Furigana extends AbstractApi
{

    public function path(): string
    {
        return '/FuriganaService/V1/furigana';
    }

}
