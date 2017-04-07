<?php

use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Request\SearchOrdersRequest;

class SearchOrdersRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_seller_id_and_returns_itself()
    {
        $request = new SearchOrdersRequest;

        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals('SELLER_ID', $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function test_it_cannot_set_seller_id_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID_1'));

        $request->setSellerId('SELLER_ID_2');
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
     * @expectedException LogicException
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
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));

        $this->assertSame($request, $request->setOrderedDateTimeRange(null, new DateTimeImmutable()));
        $simpleXml = simplexml_load_string($request->getParams());
        $this->assertFalse(isset($simpleXml->Search->Condition->OrderTimeFrom));


        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));

        $this->assertSame($request, $request->setOrderedDateTimeRange(new DateTimeImmutable(), null));
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertFalse(isset($simpleXml->Search->Condition->OrderTimeTo));
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function test_it_cannot_set_from_of_ordered_datetime_range_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderedDateTimeRange(new DateTimeImmutable, null));

        $request->setOrderedDateTimeRange(new DateTimeImmutable, null);
    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function test_it_cannot_set_to_of_ordered_datetime_range_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setOrderedDateTimeRange(null, new DateTimeImmutable));

        $request->setOrderedDateTimeRange(null, new DateTimeImmutable);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function test_it_cannot_set_ordered_datetime_range_to_both_null()
    {
        $request = new SearchOrdersRequest;

        $request->setOrderedDateTimeRange(null, null);
    }

    /**
     * @test
     */
    public function test_it_sets_offset()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));

        $request->setOffset(5);
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(6, $simpleXml->Search->Start->__toString());

    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function test_it_cannot_set_offset_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $this->assertSame($request, $request->setOffset(5));

        $request->setOffset(5);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function test_it_cannot_set_offset_to_less_than_zero()
    {
        $request = new SearchOrdersRequest;

        $request->setOffset(-1);
    }




    /**
     * @test
     */
    public function test_it_sets_limit()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));

        $request->setLimit(5);
        $simpleXml = simplexml_load_string($request->getParams());

        $this->assertEquals(5, $simpleXml->Search->Result->__toString());

    }

    /**
     * @test
     * @expectedException LogicException
     */
    public function test_it_cannot_set_limit_more_than_once()
    {
        $request = new SearchOrdersRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID'));
        $this->assertSame($request, $request->setLimit(5));

        $request->setLimit(5);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function test_it_cannot_set_limit_to_less_than_zero()
    {
        $request = new SearchOrdersRequest;

        $request->setLimit(-1);
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function test_it_validates_that_seller_id_is_set()
    {
        $request = new SearchOrdersRequest;

        $request->getParams();
    }
}
