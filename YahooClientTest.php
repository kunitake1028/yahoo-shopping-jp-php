<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;

define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');

$accessToken  = '7JGOIH895rnxTzeN6qlBhVl3yvm_eS.ch8n45iXF9ygfPEvrYgOqYvbNKbYpcOwcGwRtBhe4nUcUecQdi1wN2jqE6fqy_tWQi0PCoeLGOHedJx8tzk6LzgUeLZulvhmPDRSz3avevqhW9R1nGQeOKIi.TqzKe5Ax0hs4D6RyLRQtrKo_gcJ013Ag_W_GxSZSmAENTuZUCsu5UT05qM6Vk0HZSF1qUktJIG.HkUQlrFzmbFoQsTbSnt1NiLIgH1f9QJA1abL7KXgtFpegKJgah5PKXSF9qYwtmNFWQeYxAawVN4vGtZlScpm4E0F31MGbJi2sMiSwtkQ9CjxpMtjXF2SQRBA6Sr3YEsmrW8x6pJ5wrfMOaN0Vx1.Ek.dFq.URTcO57VoNBrLlXaTnEkj1nAGwN.ygyFV5RNVnKNGgPCya4LwZIK2kRDETixd8_p_nstK1oARR.zl25udG0Hg1m8hC3erIjJGA19_iuhxwcVQwGpeLgdDnLHjHh0HLpVehl7oNdzrB94U6gbls2_kxjGV7xO7IydugirL7BMBJqFRJiT5BTTWvysBCBLWmFGbY2xtH5kXeyD1_wqYGDPciSVGJD8FnLSYS35HzrXRXMOBQgIQ4TqepjzzGLsr6Ds45HhKS424-';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';

$client = new Client($accessToken, $refreshToken);
$client->setApi(new OrderCount());

$client->execute(['sellerId' => $seller_id], 'GET');
