<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Api\SearchItems;
use Shippinno\YahooShoppingJp\Api\SearchOrders;
use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;



define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$accessToken  = 'XlngmBQ4i.83eIUPehyBLlrmfOS4l.kMpbe8BlXnJV.Zs_BHQCAvmCQLW0FB_kGg5jNEw7rUbOofkLZB5Ke8nKJY1HUFphCI7WM9VlReHlDrMJkDHLHBeG3ayDH_ff6jK15rRNBnigVOERTdWbE07JZ0pryF16Fl_FMDlVr.FC8uBPloFUw6OG7LfDTT4iHw2Z2_KJzSjmRsGpbVE61WgHz.6ouCRRFvWEvEq4PxqWkJmB.LUonpMFgetcuidaZHsRIZzh8MzQdNVVt7qG1b12c0ue7BJdHyGEYIY5.j9Wy6NMEWyXY70KBGbig8dby9cxWaeFg7FCnQxE449C.5TnaAZJowsqT1mYOpxUWkmwSZ9BHdELjimh7wUy4HFA0DmzZcMDMnRiqjXWUzCRsdmz6yZGs3aJHziqq.qwTY0fFQ0v3uG.LPKKHFZUYSLSMNoz092nTH7Tge5p3.uvBfJDb2FnUY569Av.Il5pVrs7H_hOF0mxzus9iNIindv45dBxjDhDIA9B_3_MhW8sYYmHnedF1FIonrbBNGVV7OHhgu5aijpqjSt105F2nKI4_.NtkRXK04k3.E.wMGSuNwFMH9_Mncn_gKu7GEsNqiNW9HEkLFYxFdkc2qlzXNkaMRiVMvmX8-';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client(
    file_get_contents(__DIR__.'/access_token.txt'),
    file_get_contents(__DIR__.'/refresh_token.txt')
);
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

$client->setApi(new SearchItems);
$response = $client->execute([]);

var_dump($response);

//$client->setDebug(true);
//$response = $client->execute(['sellerId' => $seller_id], 'GET');

