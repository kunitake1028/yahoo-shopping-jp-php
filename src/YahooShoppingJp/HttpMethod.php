<?php

namespace Shippinno\YahooShoppingJp;

use MyCLabs\Enum\Enum;

/**
 * @method static HttpMethod GET()
 * @method static HttpMethod POST()
 */
class HttpMethod extends Enum
{
    /**
     * @var string
     */
    const GET = 'GET';

    /**
     * @var string
     */
    const POST = 'POST';
}
