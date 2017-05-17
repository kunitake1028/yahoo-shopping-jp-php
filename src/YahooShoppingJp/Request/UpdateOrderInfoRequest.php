<?php


namespace Shippinno\YahooShoppingJp\Request;


use FluidXml\FluidXml;
use LogicException;
use Shippinno\YahooShoppingJp\Api\UpdateOrderInfoApi;
use Shippinno\YahooShoppingJp\Enum\PayKind;
use Shippinno\YahooShoppingJp\Enum\PayMethod;
use Shippinno\YahooShoppingJp\Enum\PayType;
use Shippinno\YahooShoppingJp\Enum\SuspectFlag;
use Shippinno\YahooShoppingJp\Response\UpdateOrderInfoResponse;

class UpdateOrderInfoRequest extends AbstractRequest
{

    /**
     * @return UpdateOrderInfoApi
     */
    public function api()
    {
        return new UpdateOrderInfoApi;
    }

    /**
     * @return UpdateOrderInfoResponse
     */
    public function response()
    {
        return new UpdateOrderInfoResponse;
    }

    /**
     * @return void
     */
    protected function validateParams()
    {
    }

    /**
     * @return string
     */
    public function getParams()
    {
        $this->setIsSeen();
        $this->validateParams();

        $fluidXml = new FluidXml('Req');
        $fluidXml->add($this->params);

        return $fluidXml->xml();
    }

    /**
     * [必須]注文ID
     *
     * @param string $orderId
     * @return UpdateOrderInfoRequest
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
     * [必須]ストアアカウント
     *
     * @param string $sellerId
     * @return UpdateOrderInfoRequest
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
     * 更新者名（ビジネスID登録氏名）
     * セラー更新のみ
     *
     * @param string $operationUser
     * @return UpdateOrderInfoRequest
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
     * 閲覧済みフラグ
     * 更新する時必ずtrue
     *
     * @return UpdateOrderInfoRequest
     */
    public function setIsSeen(): self
    {
        $this->params['Order']['IsSeen'] = true;

        return $this;
    }

    /**
     * 悪戯フラグ
     *
     * @param SuspectFlag $suspectFlag
     * @return UpdateOrderInfoRequest
     */
    public function setSuspect(SuspectFlag $suspectFlag): self
    {
        if (isset($this->params['Order']['Suspect'])) {
            throw new LogicException('Suspect is already set.');
        }
        $this->params['Order']['Suspect'] = $suspectFlag->getValue();

        return $this;
    }

    /**
     * 支払い分類
     *
     * @param PayType $payType
     * @return UpdateOrderInfoRequest
     */
    public function setPayType(PayType $payType): self
    {
        if (isset($this->params['Order']['PayType'])) {
            throw new LogicException('PayType is already set.');
        }
        $this->params['Order']['PayType'] = $payType->getValue();

        return $this;
    }

    /**
     * 支払い種別
     *
     * @param PayKind $payKind
     * @return UpdateOrderInfoRequest
     */
    public function setPayKind(PayKind $payKind): self
    {
        if (isset($this->params['Order']['PayKind'])) {
            throw new LogicException('PayKind is already set.');
        }
        $this->params['Order']['PayKind'] = $payKind->getValue();

        return $this;
    }

    /**
     * 支払い方法
     *
     * @param PayMethod $payMethod
     * @return UpdateOrderInfoRequest
     */
    public function setPayMethod(PayMethod $payMethod): self
    {
        if (isset($this->params['Order']['PayMethod'])) {
            throw new LogicException('PayMethod is already set.');
        }
        $this->params['Order']['PayMethod'] = $payMethod->getValue();

        return $this;
    }

    /**
     * 支払い方法名称
     * max:150byte
     *
     * @param string $payMethodName
     * @return UpdateOrderInfoRequest
     */
    public function setPayMethodName(string $payMethodName): self
    {
        if (isset($this->params['Order']['PayMethodName'])) {
            throw new LogicException('PayMethodName is already set.');
        }
        $this->params['Order']['PayMethodName'] = $payMethodName;

        return $this;
    }

    /**
     * ストアステータス
     * ストアが独自に設定可能なステータスです。
     * max:2byte
     *
     * @param string $storeStatus
     * @return UpdateOrderInfoRequest
     */
    public function setStoreStatus(string $storeStatus): self
    {
        if (isset($this->params['Order']['StoreStatus'])) {
            throw new LogicException('StoreStatus is already set.');
        }
        $this->params['Order']['StoreStatus'] = $storeStatus;

        return $this;
    }

    /**
     * 注文伝票出力時刻
     * 注文伝票を出力した日時です。
     * format:YYYYMMDDHH24MISS
     *
     * @param string $printSlipTime
     * @return UpdateOrderInfoRequest
     */
    public function setPrintSlipTime(\DateTimeImmutable $printSlipTime): self
    {
        if (isset($this->params['Order']['PrintSlipTime'])) {
            throw new LogicException('PrintSlipTime is already set.');
        }
        $this->params['Order']['PrintSlipTime'] = $printSlipTime->format('YmdHis');

        return $this;
    }

    /**
     * 納品書出力時刻
     * 納品書を出力した日時です。
     * format:YYYYMMDDHH24MISS
     *
     * @param \DateTimeImmutable $printDeliveryTime
     * @return UpdateOrderInfoRequest
     */
    public function setPrintDeliveryTime(\DateTimeImmutable $printDeliveryTime): self
    {
        if (isset($this->params['Order']['PrintDeliveryTime'])) {
            throw new LogicException('PrintDeliveryTime is already set.');
        }
        $this->params['Order']['PrintDeliveryTime'] = $printDeliveryTime->format('YmdHis');

        return $this;
    }

    /**
     * 請求書出力時刻
     * 請求書を出力した日時です。
     * format:YYYYMMDDHH24MISS
     *
     * @param \DateTimeImmutable $printBillTime
     * @return UpdateOrderInfoRequest
     */
    public function setPrintBillTime(\DateTimeImmutable $printBillTime): self
    {
        if (isset($this->params['Order']['PrintBillTime'])) {
            throw new LogicException('PrintBillTime is already set.');
        }
        $this->params['Order']['PrintBillTime'] = $printBillTime->format('YmdHis');

        return $this;
    }

    /**
     * バイヤーコメント
     * ご要望欄入力内容です。
     * max:750byte
     *
     * @param string $buyerComments
     * @return UpdateOrderInfoRequest
     */
    public function setBuyerComments(string $buyerComments): self
    {
        if (isset($this->params['Order']['BuyerComments'])) {
            throw new LogicException('BuyerComments is already set.');
        }
        $this->params['Order']['BuyerComments'] = $buyerComments;

        return $this;
    }

    /**
     * セラーコメント
     * セラーがカートに表示しているコメント文字列です。
     * max:750byte
     *
     * @param string $sellerComments
     * @return UpdateOrderInfoRequest
     */
    public function setSellerComments(string $sellerComments): self
    {
        if (isset($this->params['Order']['SellerComments'])) {
            throw new LogicException('SellerComments is already set.');
        }
        $this->params['Order']['SellerComments'] = $sellerComments;

        return $this;
    }

    /**
     * 社内メモ
     * ビジネス注文管理ツールでセラーが入力した社内メモです
     * max:未定
     *
     * @param string $notes
     * @return UpdateOrderInfoRequest
     */
    public function setNotes(string $notes): self
    {
        if (isset($this->params['Order']['Notes'])) {
            throw new LogicException('Notes is already set.');
        }
        $this->params['Order']['Notes'] = $notes;

        return $this;
    }

    /**
     * 社内メモ
     * ビジネス注文管理ツールでセラーが入力した社内メモです
     * 1byte（固定）
     *
     * @param string $refundStatus
     * @return UpdateOrderInfoRequest
     */
    public function setRefundStatus(string $refundStatus): self
    {
        if (isset($this->params['Order']['RefundStatus'])) {
            throw new LogicException('RefundStatus is already set.');
        }
        $this->params['Order']['RefundStatus'] = $refundStatus;

        return $this;
    }

}
