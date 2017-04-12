<?php

namespace Shippinno\YahooShoppingJp\Request;

use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\CancelReason;

class UpdateOrderStatusTest extends TestCase
{
    protected $seller_id;
    protected $order_id;
    protected $is_point_fix;
    protected $order_status;
    protected $cancel_reason;

    protected function setUp()
    {
        $this->seller_id     = 'SELLER_ID';
        $this->order_id      = 'ORDER_ID';
        $this->is_point_fix  = true;
        $this->order_status  = OrderStatus::PROCESSED();
        $this->cancel_reason = CancelReason::ADDRESS_UNKNOWN();
    }

    /**
     * @test
     */
    public function create_instance()
    {
        $request = new UpdateOrderStatusRequest;
        $this->assertInstanceOf(UpdateOrderStatusRequest::class, $request);

        $request
            ->setSellerId($this->seller_id)
            ->setOrderId($this->order_id)
            ->setIsPointFix($this->is_point_fix)
            ->setOrderStatus($this->order_status);

        return $request;
    }

    /**
     * @test
     */
    public function set_seller_id()
    {
        $request = new UpdateOrderStatusRequest;
        $this->assertSame($request, $request->setSellerId($this->seller_id));
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_seller_id_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->seller_id, $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_seller_id_once($incetance)
    {
        $incetance->setSellerId('SELLER_ID_ONCE');
    }

}
