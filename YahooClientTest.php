<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Api\SearchItems;
use Shippinno\YahooShoppingJp\Api\SearchOrders;
use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;
use Shippinno\YahooShoppingJp\Factory\UpdateOrderStatusFactory;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;

define('YAHOO_APP_ID',
  'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET',
  'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$accessToken  = 'V1q.H5thh5WhzIZj5pDpuleH.vvtCzipLEIse7vz2lICACc92JXYRZpf579Pwibj79zydSPy7K2SAj5CrMohTMbc_RPdsHbgoYflT68sxrbJJudM7kSSIGdpxBTBMoEPxArFiffGNI1XVtmTK7JiJEhykdkxISSWJ1ux9tuaKLR_jzqu6b.KD9pQOVL42pMcHgd1weAFfZCTKVTUz0_cxJdMqWUWeh.lCapph82S.2QERVjzfjSAfkV8QAjotQ413WqvHAtBmnx5dxg3DS5dAiK1RN0cAf5u_2EKcyxaBKL8QhJN5knDuOx_eA3kYpblwc82ghNLWEeb.EQwxTkNcuzE5VJuUdO0OuH0i.7pOPpbMSBho0zx1ySTgK3qGUaleG0KgW0AJ3uEU0xr9g5GUFyTlw1lO5e0Q8hKqsXGj6DAcTqnnW9UHj1u2.XjOKW735vnZAL0KF5xZj6BE9GnKwvlHghoglx4pA_0p8_pALKC5Lbru.JE4LearhBrjcQKGowx6M.jhwfc8oNtUKS7bO600fYLsH9xuNXY3lu8ABrfcmuC3ZPClh7UMFBD7FfIrQZ4yx3FJ.pjZSaXfuNyv2bYTSk0jK_ulzmDafsESkLGzmigddC3ZAVj3YO0dGlq0loqvKgGdRSPHtT5';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client(
  $accessToken,
  $refreshToken);
//  file_get_contents(__DIR__ . '/access_token.txt'),
//  file_get_contents(__DIR__ . '/refresh_token.txt')
//);

$factory = new UpdateOrderStatusFactory;

$client->setApi($factory->api());
$request = $factory->request();
$request->setSellerId($seller_id)
  ->setIsPointFix(false)
  ->setOrderStatus(OrderStatus::PREORDERED())
  ->setOrderId('snbx-nxpqe5hm3-10000054');

$response = $client->execute($request);

var_dump($response);


//$client->setApi(new OrderCount);
//$response = $client->execute([
//    'sellerId' => $seller_id,
//]);
//$client->setApi(new SearchOrders);
//$response = $client->execute([
//    'Search' => [
//        'Result' => 50,
//        'Start' => 1,
//        'Condition' => [
//            'OrderTimeFrom' => '20170403000000',
//            'OrderTimeTo' => '20170403000000',
//        ],
//        'Field' => 'OrderId,OrderStatus',
//    ],
//    'SellerId' => $seller_id,
//]);

//$client->setApi(new SearchItems);
//$response = $client->execute([]);

//var_dump($response);

//$client->setDebug(true);
//$response = $client->execute(['sellerId' => $seller_id], 'GET');

