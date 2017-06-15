<?php

namespace Shippinno\YahooShoppingJp\Request;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\ShipStatus;
use Shippinno\YahooShoppingJp\Enum\StoreStatus;

class SearchOrdersRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_order_id_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request, $request->setSellerId('SELLER_ID')->setOrderId('ORDER_ID'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('ORDER_ID', $simpleXml->Search->Condition->OrderId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_order_id_seen_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID')->setOrderId('ORDER_ID'));

        $request->setOrderId('ORDER_ID2');
    }

    /**
     * @test
     */
    public function it_sets_seller_id_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SELLER_ID', $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_seller_id_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID_1'));

        $request->setSellerId('SELLER_ID_2');
    }

    /**
     * @test
     */
    public function it_sets_is_seen_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID')->setIsSeen(true));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('true', $simpleXml->Search->Condition->IsSeen->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_is_seen_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID')->setIsSeen(false));

        $request->setIsSeen(true);
    }

    /**
     * @test
     */
    public function it_sets_ordered_datetime_range_and_returns_itself()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $from = new DateTimeImmutable('2000-01-01 00:00:00');
        $to = new DateTimeImmutable('2000-01-01 00:00:01');

        $this->assertSame($request, $request->setOrderedDateTimeRange($from, $to));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals($from->format('YmdHis'), $simpleXml->Search->Condition->OrderTimeFrom->__toString());
        $this->assertEquals($to->format('YmdHis'), $simpleXml->Search->Condition->OrderTimeTo->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ordered_datetime_range_when_to_is_earlier_than_from()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $from = new DateTimeImmutable('2000-01-01 00:00:01');
        $to = new DateTimeImmutable('2000-01-01 00:00:00');

        $request->setOrderedDateTimeRange($from, $to);
    }

    /**
     * @test
     */
    public function it_does_not_set_ordered_datetime_range_when_null()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));

        $this->assertSame($request, $request->setOrderedDateTimeRange(null, new DateTimeImmutable()));
        $simpleXml = simplexml_load_string($request->getParams());
        $this->assertFalse(isset($simpleXml->Search->Condition->OrderTimeFrom));


        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));

        $this->assertSame($request, $request->setOrderedDateTimeRange(new DateTimeImmutable(), null));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertFalse(isset($simpleXml->Search->Condition->OrderTimeTo));
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_from_of_ordered_datetime_range_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderedDateTimeRange(new DateTimeImmutable, null));

        $request->setOrderedDateTimeRange(new DateTimeImmutable, null);
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_to_of_ordered_datetime_range_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderedDateTimeRange(null, new DateTimeImmutable));

        $request->setOrderedDateTimeRange(null, new DateTimeImmutable);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_cannot_set_ordered_datetime_range_to_both_null()
    {
        $request = new SearchOrdersRequest;

        $request->setOrderedDateTimeRange(null, null);
    }

    /**
     * @test
     */
    public function it_sets_order_status_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request,
            $request->setOrderId('ORDER_ID')
                ->setSellerId('SELLER_ID')
                ->setOrderStatus(OrderStatus::PREORDERED()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(OrderStatus::PREORDERED()->getValue(), $simpleXml->Search->Condition->OrderStatus->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_order_status_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request,
            $request->setOrderId('ORDER_ID')
                ->setSellerId('SELLER_ID')
                ->setOrderStatus(OrderStatus::PROCESSED()));

        $request->setOrderStatus(OrderStatus::PROCESSING());
    }

    /**
     * @test
     */
    public function it_sets_ship_status_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request,
            $request->setOrderId('ORDER_ID')
                ->setSellerId('SELLER_ID')
                ->setShipStatus(ShipStatus::SHIPPABLE()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(ShipStatus::SHIPPABLE()->getValue(), $simpleXml->Search->Condition->ShipStatus->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_status_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request,
            $request->setOrderId('ORDER_ID')
                ->setSellerId('SELLER_ID')
                ->setShipStatus(ShipStatus::SHIPPED()));

        $request->setShipStatus(ShipStatus::UNSHIPPABLE());
    }

    /**
     * @test
     */
    public function it_sets_store_status_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request,
            $request->setOrderId('ORDER_ID')
                ->setSellerId('SELLER_ID')
                ->setStoreStatus(StoreStatus::STORE_STATUS1()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(StoreStatus::STORE_STATUS1()->getValue(), $simpleXml->Search->Condition->StoreStatus->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_store_status_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID')->setStoreStatus(StoreStatus::STORE_STATUS2()));

        $request->setStoreStatus(StoreStatus::STORE_STATUS3());
    }

    /**
     * @test
     */
    public function it_sets_offset()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));

        $request->setOffset(5);
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(6, $simpleXml->Search->Start->__toString());

    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_offset_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));
        $this->assertSame($request, $request->setOffset(5));

        $request->setOffset(5);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_cannot_set_offset_to_less_than_zero()
    {
        $request = new SearchOrdersRequest;

        $request->setOffset(-1);
    }




    /**
     * @test
     */
    public function it_sets_limit()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID')->setSellerId('SELLER_ID'));

        $request->setLimit(5);
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(5, $simpleXml->Search->Result->__toString());

    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_limit_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $this->assertSame($request, $request->setLimit(5));

        $request->setLimit(5);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_cannot_set_limit_to_less_than_zero()
    {
        $request = new SearchOrdersRequest;

        $request->setLimit(-1);
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function it_validates_that_seller_id_is_set()
    {
        $request = new SearchOrdersRequest;
        $from = new DateTimeImmutable('2000-01-01 00:00:00');
        $to = new DateTimeImmutable('2000-01-02 00:00:00');

        $this->assertSame($request, $request->setOrderedDateTimeRange($from, $to));

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage OrderId,OrderTime or OrderTimeFrom&OrderTimeTo is necessary.
     */
    public function it_validates_that_order_id_or_datetime_is_set()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request, $request->setSellerId('SELLER_ID'));

        $request->getParams();
    }
}
