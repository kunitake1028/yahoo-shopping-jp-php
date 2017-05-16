<?php

namespace Shippinno\YahooShoppingJp\Request;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\ShipMethod;
use Shippinno\YahooShoppingJp\Enum\ShipStatus;

class UpdateOrderShippingStatusRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_seller_id_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
                        $request->setSellerId('SELLER_ID')
                                ->setOrderId('ORDER_ID')
                                ->setIsPointFix(true)
                                ->setShipStatus(ShipStatus::SHIPPABLE()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SELLER_ID', $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_seller_id_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID_1'));

        $request->setSellerId('SELLER_ID_2');
    }

    /**
     * @test
     */
    public function it_sets_order_id_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(true)
                ->setShipStatus(ShipStatus::SHIPPABLE()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('ORDER_ID', $simpleXml->Target->OrderId->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_order_id_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setOrderId('ORDER_ID_1'));

        $request->setOrderId('ORDER_ID_2');
    }

    /**
     * @test
     */
    public function it_sets_is_point_fix_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('false', $simpleXml->Target->IsPointFix->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_is_point_fix_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setIsPointFix(true));

        $request->setIsPointFix(false);
    }

    /**
     * @test
     */
    public function it_sets_operation_user_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(true)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setOperationUser('OPERATION_USER'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('OPERATION_USER', $simpleXml->Target->OperationUser->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_operation_user_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setOperationUser('OPERATION_USER_1'));

        $request->setOperationUser('OPERATION_USER_2');
    }

    /**
     * @test
     */
    public function it_sets_ship_status_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(ShipStatus::SHIPPABLE()->getValue(), $simpleXml->Order->Ship->ShipStatus->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_status_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipStatus(ShipStatus::SHIPPED()));

        $request->setShipStatus(ShipStatus::DELIVERED());
    }

    /**
     * @test
     */
    public function it_sets_ship_method_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipMethod(ShipMethod::METHOD1()));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(ShipMethod::METHOD1()->getValue(), $simpleXml->Order->Ship->ShipMethod->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_method_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipMethod(ShipMethod::METHOD1()));

        $request->setShipMethod(ShipMethod::METHOD2());
    }

    /**
     * @test
     */
    public function it_sets_ship_notes_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipNotes('SHIP_NOTES'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SHIP_NOTES', $simpleXml->Order->Ship->ShipNotes->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_notes_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipNotes('SHIP_NOTES_1'));

        $request->setShipNotes('SHIP_NOTES_2');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_cannot_set_ship_notes_too_long_string()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $longStr = str_pad('SHIP_NOTES', 501, "_", STR_PAD_BOTH);
        $request->setShipNotes($longStr);
    }

    /**
     * @test
     */
    public function it_sets_ship_invoice_number1_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipInvoiceNumber1('SHIP_INVOICE_NUMBER1'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SHIP_INVOICE_NUMBER1', $simpleXml->Order->Ship->ShipInvoiceNumber1->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_invoice_number1_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipInvoiceNumber1('SHIP_INVOICE_NUMBER1_1'));

        $request->setShipInvoiceNumber1('SHIP_INVOICE_NUMBER1_2');
    }

    /**
     * @test
     */
    public function it_sets_ship_invoice_number2_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipInvoiceNumber2('SHIP_INVOICE_NUMBER2'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SHIP_INVOICE_NUMBER2', $simpleXml->Order->Ship->ShipInvoiceNumber2->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_invoice_number2_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipInvoiceNumber2('SHIP_INVOICE_NUMBER2_1'));

        $request->setShipInvoiceNumber2('SHIP_INVOICE_NUMBER2_2');
    }

    /**
     * @test
     */
    public function it_sets_ship_url_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipUrl('https://hogehoge'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('![CDATA[https://hogehoge]]', $simpleXml->Order->Ship->ShipUrl->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_url_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipUrl('https://hogehoge'));

        $request->setShipUrl('https://hogehoge2');
    }

    /**
     * @test
     */
    public function it_sets_ship_date_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        date_default_timezone_set('UTC');

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setShipDate(new DateTimeImmutable('2017-04-11 20:00:00')));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('20170412', $simpleXml->Order->Ship->ShipDate->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_ship_date_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setShipDate(new DateTimeImmutable('2017-04-11 20:00:00')));

        $request->setShipDate(new DateTimeImmutable('2017-04-11 21:00:00'));
    }

    /**
     * @test
     */
    public function it_sets_arrival_date_and_returns_itself()
    {
        $request = new UpdateOrderShippingStatusRequest;

        date_default_timezone_set('UTC');

        $this->assertSame($request,
            $request->setSellerId('SELLER_ID')
                ->setOrderId('ORDER_ID')
                ->setIsPointFix(false)
                ->setShipStatus(ShipStatus::SHIPPABLE())
                ->setArrivalDate(new DateTimeImmutable('2017-04-11 20:00:00')));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('20170412', $simpleXml->Order->Ship->ArrivalDate->__toString());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function it_cannot_set_arrival_date_more_than_once()
    {
        $request = new UpdateOrderShippingStatusRequest;
        $this->assertSame($request, $request->setArrivalDate(new DateTimeImmutable('2017-04-11 20:00:00')));

        $request->setArrivalDate(new DateTimeImmutable('2017-04-11 21:00:00'));
    }
}
