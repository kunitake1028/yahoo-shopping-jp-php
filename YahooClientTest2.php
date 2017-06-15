<?php
//kanazawa test

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\ShipStatus;
use Shippinno\YahooShoppingJp\Enum\StoreStatus;
use Shippinno\YahooShoppingJp\Request\UpdateOrderShippingStatusRequest;


define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client(
    file_get_contents(__DIR__.'/access_token.txt'),
    null,null,true
);

try{
    /*
     * UpdateOrderShippingStatusRequest
     */
//    $request = new UpdateOrderShippingStatusRequest();
//
//    $request = $request
//                        ->setSellerId($seller_id)
//                        ->setOrderId('snbx-nxpqe5hm3-10000069')
//                        ->setIsPointFix(true)
//                        ->setShipStatus(ShipStatus::UNSHIPPABLE());

    /*
     * GetOrderInfoRequest
     */
//    $request = new \Shippinno\YahooShoppingJp\Request\GetOrderInfoRequest();
//    $request->setSellerId($seller_id);
//    $request->setOrderId('snbx-nxpqe5hm3-10000069');

    /*
     * SearchOrdersRequest
     */
    $request = new \Shippinno\YahooShoppingJp\Request\SearchOrdersRequest();
    $request->setSellerId($seller_id)
            ->setOrderedDateTimeRange((new DateTimeImmutable)->sub(new DateInterval('P30D')))
            ->setIsSeen(false)
            ->setOrderStatus(OrderStatus::PREORDERED())
            ->setShipStatus(ShipStatus::SHIPPABLE())
            ->setStoreStatus(StoreStatus::STORE_STATUS1());

    $response = $client->execute($request);

    var_dump($response);

}catch (Exception $e){
    echo $e;
}

