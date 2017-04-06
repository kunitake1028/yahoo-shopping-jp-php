<?php

namespace Shippinno\YahooShoppingJp\Request;

use LogicException;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;
use Shippinno\YahooShoppingJp\Enum\OrderStatus;
use Shippinno\YahooShoppingJp\Enum\CancelReason;
use FluidXml\FluidXml;

class UpdateOrderStatusRequest extends AbstractRequest
{
    /**
     * @var array
     */
    private $params = [];

    public function __construct()
    {
        
    }

    /**
     * 【必須】ストアアカウント
     *
     * @param string $sellerId
     * @return self
     */
    public function setSellerId(string $sellerId): self
    {
        if (isset($this->params['SellerId'])) {
            throw new LogicException('SellerId is already set.');
        }

        $this->params['SellerId'] = $sellerId;

        return $this;
    }

    /**
     * 【必須】注文ID
     *
     * @param string $orderId
     * @return self
     */
    public function setOrderId(string $orderId): self
    {
        if (isset($this->params['Target']['OrderId'])) {
            throw new LogicException('OrderId is already set.');
        }

        $this->params['Target']['OrderId'] = $orderId;

        return $this;
    }

    /**
     * 【必須】ポイント確定要否
     * true : ポイント確定します。
     * false : ポイント確定しません。
     * ※注文ステータスを「完了」に変更する際は、必ずポイント確定要否をtrueに指定してください。
     *
     * @param bool $isPointFix
     * @return self
     */
    public function setIsPointFix(bool $isPointFix): self
    {
        if (isset($this->params['Target']['IsPointFix'])) {
            throw new LogicException('IsPointFix is already set.');
        }

        $this->params['Target']['IsPointFix'] = ($isPointFix ? 'true' : 'false');

        return $this;
    }

    /**
     * 【必須】注文ステータス
     *
     * @param OrderStatus $orderStatus
     * @return self
     */
    public function setOrderStatus(OrderStatus $orderStatus): self
    {
        if (isset($this->params['Order']['OrderStatus'])) {
            throw new LogicException('OrderStatus is already set.');
        }
        $this->params['Order']['OrderStatus'] = $orderStatus->getValue();

        return $this;
    }

    /**
     * 更新者名（ビジネスID登録氏名）
     *
     * @param string $operationUser
     * @return self
     */
    public function setOperationUser(string $operationUser): self
    {
        if (isset($this->params['Target']['OperationUser'])) {
            throw new LogicException('OperationUser is already set.');
        }

        $this->params['Target']['OperationUser'] = $operationUser;

        return $this;
    }

    /**
     * キャンセル理由
     *
     * @param CancelReason $cancelReason
     * @return self
     */
    public function setCancelReason(CancelReason $cancelReason): self
    {
        if (isset($this->params['Order']['CancelReason'])) {
            throw new LogicException('CancelReason is already set.');
        }

        $this->params['Order']['CancelReason'] = $cancelReason->getValue();

        return $this;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        $this->validateRequest();

        $fluidXml = new FluidXml('Req');
        $fluidXml->add($this->params);

        return $fluidXml->xml();
    }

    /**
     * @throws InvalidRequestException
     */
    private function validateRequest(): void
    {
        if (!isset($this->params['SellerId'])) {
            throw new InvalidRequestException;
        }
        if (!isset($this->params['Target']['OrderId'])) {
            throw new InvalidRequestException;
        }
        if (!isset($this->params['Target']['IsPointFix'])) {
            throw new InvalidRequestException;
        }
        if (!isset($this->params['Order']['OrderStatus'])) {
            throw new InvalidRequestException;
        }
        // ※注文ステータスを「完了」に変更する際は、必ずポイント確定要否をtrueに指定してください。
        if ($this->params['Order']['OrderStatus'] === OrderStatus::PROCESSED() && $this->params['Target']['IsPointFix'] === false) {
            throw new InvalidRequestException;
        }
    }

}
