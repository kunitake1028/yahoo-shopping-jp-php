<?php
//kanazawa test

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Enum\ShipStatus;
use Shippinno\YahooShoppingJp\Factory\UpdateOrderShippingStatusFactory;


define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client(
    file_get_contents(__DIR__.'/access_token.txt'),
    file_get_contents(__DIR__.'/refresh_token.txt')
);

try{
    $factory = new UpdateOrderShippingStatusFactory();

    $client->setApi($factory->api());
    $request = $factory->request();
    $request = $request
                        ->setSellerId($seller_id)
                        ->setOrderId('hogehoge')
                        ->setIsPointFix(true)
                        ->setShipStatus(ShipStatus::UNSHIPPABLE());

    //$options['body'] = $fluidXml->xml();で通る
    $response = $client->execute($request);

    var_dump($response);

}catch (Exception $e){
    echo $e->getFile()."\n";
    echo $e->getLine()."\n";
    echo $e->getCode().':'.$e->getMessage()."\n";
}

