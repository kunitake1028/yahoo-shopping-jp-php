<?php

namespace Shippinno\YahooShoppingJp\Request;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\ShipMethod;
use Shippinno\YahooShoppingJp\Enum\ShipStatus;

class GetOrderInfoRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_seller_id_and_returns_itself()
    {
        $request = new GetOrderInfoRequest();

        $this->assertSame($request,
                        $request->setSellerId('SELLER_ID')
                                ->setOrderId('ORDER_ID'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SELLER_ID', $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_seller_id_more_than_once()
    {
        $request = new GetOrderInfoRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID_1'));

        $request->setSellerId('SELLER_ID_2');
    }

    /**
     * @test
     */
    public function it_sets_order_id_and_returns_itself()
    {
        $request = new GetOrderInfoRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('ORDER_ID', $simpleXml->Target->OrderId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_order_id_more_than_once()
    {
        $request = new GetOrderInfoRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID_1'));

        $request->setOrderId('ORDER_ID_2');
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage SellerId is required.
     */
    public function seller_id_is_not_set()
    {
        $request = new GetOrderInfoRequest;

        $this->assertSame($request, $request->setOrderId('ORDER_ID_1'));
        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage OrderId is required.
     */
    public function order_id_is_not_set()
    {
        $request = new GetOrderInfoRequest;

        $this->assertSame($request, $request->setSellerId('valid-seller-id'));
        $request->getParams();
    }
}
