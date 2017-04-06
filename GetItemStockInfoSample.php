<?php

require_once __DIR__ . '/vendor/autoload.php';


use Shippinno\YahooShoppingJp\Factory\GetItemStockInfoFactory;
use Shippinno\YahooShoppingJp\Client;


define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');

$sellerId = 'snbx-nxpqe5hm3';
$itemCodeList = [
    'B01G6K0G7O',
    'B016ZZIS2U',
];

$factory = new GetItemStockInfoFactory;

$request = $factory->request();
$request->setSellerId($sellerId);
$request->setItemCodeList($itemCodeList);

$client = new Client(
    file_get_contents(__DIR__.'/access_token.txt'),
    file_get_contents(__DIR__.'/refresh_token.txt')
);

$client->setApi($factory->api());
$response = $client->execute($request);

var_dump($response);

