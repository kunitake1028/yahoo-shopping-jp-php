<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Api\SearchOrders;
use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;



define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$accessToken  = '63MhY8Y_i6RDbeknp0tplfZXrjbv1SusQ78NU.4Daf1r67sC68xTkJwb91LFrV90JPzLbx_adIrgGpwyllmZpEKNGRRWlC4q55GJBfAiXYOwgZfvIvAmoqcefMHWxQrh9xRV592fSS2vTEq9JZnFjtRVVvqVM8pzuKVHgqiHPicGfK85wBWBHBUAvL9Y0wlHeks5FYVVrYbrVGBDkbfMQKirE71qD32UmHiUN5hA4XS12FB6lH76daOZAL.vPftODv9eJ8gjeEpLY23sn9ccjXmJjbTBQvqvnIGIATdVoBFzfOKUtdy.ZRx0PCzbvWsSW87qRk3o8G5R5EPoaMM2AYmItpM2VndtVwPR_RwQFT_DVP11ghpDhi6.uQvOZW862MYvPB2awbxmyfzcaLL8w6KD9Dl9Ch3GcSW_Kn5Ipv8bk6VGqluJ3VVf6BhfboeyGD9ALqm92qeWjhJ8lzeWBr9Y8hcxFGRLRzRqtMt4M0.W6_IvFl_XRjz5s8siD1tmsy8X.6l6dbNiCH9UMZL4cMuJWm1Ols94ZLAyriQYKXxRxX5b6E0oy8JWNDjpLzbYseVJN2GVEpPi3WRmPowd9Ld.s4NRkuKaBmVWba_1oi_Z3_KxGqFbeklcLAa4nelYy0EPk94-';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client($accessToken, $refreshToken);
$client->setApi(new OrderCount);
$response = $client->execute([
    'sellerId' => $seller_id,
]);

//$client->setApi(new SearchOrders);
//$response = $client->execute([
//    'Search' => [
//        'Result' => 50,
//        'Start' => 1,
//        'Condition' => [
//            'OrderId' => 'YO',
//        ],
//        'Field' => 'OrderId',
//    ],
//    'SellerId' => $seller_id,
//]);

var_dump($response);

//$client->setDebug(true);
//$response = $client->execute(['sellerId' => $seller_id], 'GET');

