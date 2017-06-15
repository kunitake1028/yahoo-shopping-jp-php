<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Api\SearchItems;
use Shippinno\YahooShoppingJp\Api\SearchOrders;
use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;
use Shippinno\YahooShoppingJp\Factory\UpdateOrderStatusFactory;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\CancelReason;

define('YAHOO_APP_ID',
  'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET',
  'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$accessToken  = 'dw_bcoYMsYi_ahYU5.6vkn.vTk6Y6nF74YIw82P4dLoHjR8eRrEGMbKS9YYB1f6F95sgm3Z4d0FSWfrNYCb0EdxE02CFVz..4daPOZKt9Ud3dZ1ewLt7.TYDbkbjywzinO1qnH1Z4QdPaenDtNK.JVILPbTpJHIgmdatCFHX7ea_hFPfRl04Z7xuXaCE9NcH6ICdAYMaC2NE6N4Dg6hnY3sTJpwVGPCEc10GBcVLB7j2CTflK4rN0Vmmj2mdxCZqrE3jYh0AqtsfOpSqhXoHIBsepx5P7YiGtTclX_Uh0LpzDkTlpZJ7Si66zl4LOEkFASJHtU86bRosDPu3ISGDlf1ar61fJvf9q9Z94dXGJaIKRXpO2xFERGEOEH0FWUSzWeouJR0DZlnsAjvt2lT1wKBJH9IceNutTFdBe8ypIlkjlIRjyBc2jjVA6nz4.4E1DIRwTydYmZmbqnWqdp8oEuwX2Cd9QCGOjC9CWI2uHhCAx_bGm6GlPhNO.agutvX6zSzl.UdsU9JrDexi8XEg1FQ9s.EqownBSa8Uoh9dSUiMz8h4E8MyKM65d9e9csOzWTDqOkWeVGpIE5w60T8DmoI06nTCmgrACEk4jQaftj72fvX7uz.zTU4yUFYfUGi290XfPaIPMm.u33iI';
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
  ->setOrderStatus(OrderStatus::PROCESSED())
  ->setOrderId('snbx-nxpqe5hm3-10000045');

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

