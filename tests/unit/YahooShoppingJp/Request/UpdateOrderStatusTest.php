<?php

namespace Shippinno\YahooShoppingJp\Request;

use PHPUnit\Framework\TestCase;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\CancelReason;

class UpdateOrderStatusTest extends TestCase
{
    protected $SellerId;
    protected $OrderId;
    protected $IsPointFix;
    protected $OrderStatus;
    protected $CancelReason;
    protected $OperationUser;

    protected function setUp()
    {
        $this->SellerId      = 'SELLER_ID';
        $this->OrderId       = 'ORDER_ID';
        $this->IsPointFix    = true;
        $this->OrderStatus   = OrderStatus::PROCESSED();
        $this->OperationUser = 'OPERATION_USER';
        $this->CancelReason  = CancelReason::ADDRESS_UNKNOWN();
    }

    /**
     * @test
     */
    public function create_instance()
    {
        $request = new UpdateOrderStatusRequest;
        $this->assertInstanceOf(UpdateOrderStatusRequest::class, $request);

        $this->assertSame($request, $request->setSellerId($this->SellerId));
        $this->assertSame($request, $request->setOrderId($this->OrderId));
        $this->assertSame($request, $request->setIsPointFix($this->IsPointFix));
        $this->assertSame($request, $request->setOrderStatus($this->OrderStatus));
        $this->assertSame($request, $request->setOperationUser($this->OperationUser));
        $this->assertSame($request, $request->setCancelReason($this->CancelReason));

        return $request;
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_SellerId_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->SellerId, $simpleXml->SellerId->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_SellerId_once($incetance)
    {
        $incetance->setSellerId('SELLER_ID_ONCE');
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_OrderId_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->OrderId, $simpleXml->Target->OrderId->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_OrderId_once($incetance)
    {
        $incetance->setOrderId('ORDER_ID_ONCE');
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_IsPointFix_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals(var_export($this->IsPointFix, TRUE), $simpleXml->Target->IsPointFix->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_IsPointFix_once($incetance)
    {
        $incetance->setIsPointFix($this->IsPointFix);
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_OrderStatus_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->OrderStatus->getValue(), $simpleXml->Order->OrderStatus->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_OrderStatus_once($incetance)
    {
        $incetance->setOrderStatus($this->OrderStatus);
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_OperationUser_once($incetance)
    {
        $incetance->setOperationUser($this->OperationUser);
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_OperationUser_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->OperationUser, $simpleXml->Target->OperationUser->__toString());
    }

    /**
     * @test
     * @depends create_instance
     * @expectedException \LogicException
     */
    public function set_CancelReason_once($incetance)
    {
        $incetance->setCancelReason($this->CancelReason);
    }

    /**
     * @test
     * @depends create_instance
     */
    public function check_CancelReason_value($instance)
    {
        $simpleXml = simplexml_load_string($instance->getParams());

        $this->assertEquals($this->CancelReason->getValue(), $simpleXml->Order->CancelReason->__toString());
    }

    /**
     * @test
     * @expectedException Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_SellerId()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setOrderId($this->OrderId)
            ->setIsPointFix($this->IsPointFix)
            ->setOrderStatus($this->OrderStatus);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_OrderId()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId($this->SellerId)
            ->setIsPointFix($this->IsPointFix)
            ->setOrderStatus($this->OrderStatus);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_IsPointFix()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId($this->SellerId)
            ->setOrderId($this->OrderId)
            ->setOrderStatus($this->OrderStatus);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_not_set_OrderStatus()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId($this->SellerId)
            ->setOrderId($this->OrderId)
            ->setIsPointFix($this->IsPointFix);

        $request->getParams();
    }

    /**
     * @test
     * @expectedException Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     */
    public function validate_OrderStatus_and_IsPointFix()
    {
        $request = (new UpdateOrderStatusRequest)
            ->setSellerId($this->SellerId)
            ->setOrderId($this->OrderId);

        $request
            ->setIsPointFix(false)
            ->setOrderStatus(OrderStatus::PROCESSED());

        $request->getParams();
    }

}
