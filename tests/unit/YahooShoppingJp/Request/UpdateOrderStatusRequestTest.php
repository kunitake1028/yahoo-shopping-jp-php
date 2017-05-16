<?php

namespace Shippinno\YahooShoppingJp\Test\Unit\Request;

use Shippinno\YahooShoppingJp\Request\UpdateOrderStatusRequest;

use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\CancelReason;

class UpdateOrderStatusRequestTest extends TestCase
{
    const VALID_SELLER_ID = 'SELLER_ID';
    const VALID_ORDER_ID = 'ORDER_ID';
    const VALID_IS_POINT_FIX = true;
    const VALID_OPERATION_USER = 'OPERATION_USER';

    protected $order_status;
    protected $cancel_reason;

    protected function setUp()
    {
        $this->order_status   = OrderStatus::PROCESSED();
        $this->cancel_reason  = CancelReason::ADDRESS_UNKNOWN();
    }

    /**
     * @test
     */
    public function create_instance_with_only_required_fields()
    {
        $instance = new UpdateOrderStatusRequest;
        $this->assertInstanceOf(UpdateOrderStatusRequest::class, $instance);

        $this->assertSame($instance, $instance->setSellerId(self::VALID_SELLER_ID));
        $this->assertSame($instance, $instance->setOrderId(self::VALID_ORDER_ID));
        $this->assertSame($instance, $instance->setIsPointFix(self::VALID_IS_POINT_FIX));
        $this->assertSame($instance, $instance->setOrderStatus($this->order_status));

        return $instance;
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_SellerId_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals(self::VALID_SELLER_ID, $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_SellerId_once(UpdateOrderStatusRequest $instance)
    {
        $instance->setSellerId(self::VALID_SELLER_ID);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_OrderId_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals(self::VALID_ORDER_ID, $simpleXml->Target->OrderId->__toString());
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_OrderId_once($instance)
    {
        $instance->setOrderId(self::VALID_ORDER_ID);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_IsPointFix_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals(var_export(self::VALID_IS_POINT_FIX, TRUE), $simpleXml->Target->IsPointFix->__toString());
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_IsPointFix_once($instance)
    {
        $instance->setIsPointFix(self::VALID_IS_POINT_FIX);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_OrderStatus_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->order_status->getValue(), $simpleXml->Order->OrderStatus->__toString());
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_OrderStatus_once($instance)
    {
        $instance->setOrderStatus($this->order_status);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_OperationUser_once($instance)
    {   $instance->setOperationUser(self::VALID_OPERATION_USER);

        $instance->setOperationUser(self::VALID_OPERATION_USER);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_OperationUser_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals(self::VALID_OPERATION_USER, $simpleXml->Target->OperationUser->__toString());
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     * @expectedException \LogicException
     */
    public function set_CancelReason_once($instance)
    {
        $instance->setCancelReason($this->cancel_reason);

        $instance->setCancelReason($this->cancel_reason);
    }

    /**
     * @test
     * @depends create_instance_with_only_required_fields
     */
    public function check_CancelReason_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->cancel_reason->getValue(), $simpleXml->Order->CancelReason->__toString());
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_SellerId()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setOrderId(self::VALID_ORDER_ID)
            ->setIsPointFix(self::VALID_IS_POINT_FIX)
            ->setOrderStatus($this->order_status);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_OrderId()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId(self::VALID_SELLER_ID)
            ->setIsPointFix(self::VALID_IS_POINT_FIX)
            ->setOrderStatus($this->order_status);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_IsPointFix()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId(self::VALID_SELLER_ID)
            ->setOrderId(self::VALID_ORDER_ID)
            ->setOrderStatus($this->order_status);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_OrderStatus()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId(self::VALID_SELLER_ID)
            ->setOrderId(self::VALID_ORDER_ID)
            ->setIsPointFix(self::VALID_IS_POINT_FIX);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_OrderStatus_and_IsPointFix()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId(self::VALID_SELLER_ID)
            ->setOrderId(self::VALID_ORDER_ID);

        $request
            ->setIsPointFix(false)
            ->setOrderStatus(OrderStatus::PROCESSED());

        $request->getParams();
    }

}
