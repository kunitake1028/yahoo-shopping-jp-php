<?php

namespace Shippinno\YahooShoppingJp\Request;

use FluidXml\FluidXml;
use LogicException;
use Shippinno\YahooShoppingJp\Api\UpdateOrderInfoApi;
use Shippinno\YahooShoppingJp\Enum\BillAddressFrom;
use Shippinno\YahooShoppingJp\Enum\PayKind;
use Shippinno\YahooShoppingJp\Enum\PayMethod;
use Shippinno\YahooShoppingJp\Enum\PayType;
use Shippinno\YahooShoppingJp\Enum\RefundStatus;
use Shippinno\YahooShoppingJp\Enum\ShipMethod;
use Shippinno\YahooShoppingJp\Enum\SuspectFlag;
use Shippinno\YahooShoppingJp\Response\UpdateOrderInfoResponse;

/**
 * Class UpdateOrderInfoRequest
 *
 * @package Shippinno\YahooShoppingJp\Request
 */
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
     * [必須]ストアアカウント
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
     * 更新者名（ビジネスID登録氏名）
     * セラー更新のみ
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
     * 閲覧済みフラグ
     * 更新する時必ずtrue
     *
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * 返金ステータス
     * APIで更新できるのは1：必要から2：返金済みへの更新のみ。
     *
     * @param RefundStatus $refundStatus
     * @return self
     */
    public function setRefundStatus(RefundStatus $refundStatus): self
    {
        if (isset($this->params['Order']['RefundStatus'])) {
            throw new LogicException('RefundStatus is already set.');
        }
        $this->params['Order']['RefundStatus'] = $refundStatus->getValue();

        return $this;
    }

    /**
     * @param \DateTimeImmutable $printBillTime
     * @return self
     */
    public function setPayDate(\DateTimeImmutable $payDate): self
    {
        if (isset($this->params['Pay']['PayDate'])) {
            throw new LogicException('PayDate is already set.');
        }
        $this->params['Pay']['PayDate'] = $payDate->format('Ymd');

        return $this;
    }

    /**
     * 入金処理備考
     * max:1000byte
     *
     * @param string $payNotes
     * @return self
     */
    public function setPayNotes(string $payNotes): self
    {
        if (isset($this->params['Pay']['PayNotes'])) {
            throw new LogicException('PayNotes is already set.');
        }
        $this->params['Pay']['PayNotes'] = $payNotes;

        return $this;
    }

    /**
     * 代金支払い管理注文期限日時
     * format:YYYYMMDD
     *
     * @param \DateTimeImmutable $printBillTime
     * @return self
     */
    public function setPayManageLimitDate(\DateTimeImmutable $payManageLimitDate): self
    {
        if (isset($this->params['Pay']['PayManageLimitDate'])) {
            throw new LogicException('PayManageLimitDate is already set.');
        }
        $this->params['Pay']['PayManageLimitDate'] = $payManageLimitDate->format('Ymd');

        return $this;
    }

    /**
     * 請求書有無
     * 伝票画面上では、「納品書」表記です。
     * 帳票出力でも「納品書」出力で、「明細書」が出力可能です。
     * キーなし : カートに設定なし
     * false : 領袖書不要
     * true : 領袖書必要
     *
     * @param string $needBillSlip
     * @return self
     */
    public function setNeedBillSlip(bool $needBillSlip): self
    {
        if (isset($this->params['Pay']['NeedBillSlip'])) {
            throw new LogicException('NeedBillSlip is already set.');
        }
        $this->params['Pay']['NeedBillSlip'] = $needBillSlip ? 1 : 0;

        return $this;
    }

    /**
     * 明細書有無
     * キーなし : カートに設定なし
     * false : 領袖書不要
     * true : 領袖書必要
     *
     * @param string $needDetailedSlip
     * @return self
     */
    public function setNeedDetailedSlip(bool $needDetailedSlip): self
    {
        if (isset($this->params['Pay']['NeedDetailedSlip'])) {
            throw new LogicException('NeedDetailedSlip is already set.');
        }
        $this->params['Pay']['NeedDetailedSlip'] = $needDetailedSlip ? 1 : 0;

        return $this;
    }

    /**
     * 領収書有無
     * キーなし : カートに設定なし
     * false : 領袖書不要
     * true : 領袖書必要
     *
     * @param string $needReceipt
     * @return self
     */
    public function setNeedReceipt(bool $needReceipt): self
    {
        if (isset($this->params['Pay']['NeedReceipt'])) {
            throw new LogicException('NeedReceipt is already set.');
        }
        $this->params['Pay']['NeedReceipt'] = $needReceipt ? 1 : 0;

        return $this;
    }

    /**
     * ご請求先名前
     * max:297byte
     *
     * @param string $billFirstName
     * @return self
     */
    public function setBillFirstName(string $billFirstName): self
    {
        if (isset($this->params['Pay']['BillFirstName'])) {
            throw new LogicException('BillFirstName is already set.');
        }
        $this->params['Pay']['BillFirstName'] = $billFirstName;

        return $this;
    }

    /**
     * ご請求先名前（フリガナ）
     * max:297byte
     *
     * @param string $billFirstnameKana
     * @return self
     */
    public function setBillFirstnameKana(string $billFirstnameKana): self
    {
        if (isset($this->params['Pay']['BillFirstnameKana'])) {
            throw new LogicException('BillFirstnameKana is already set.');
        }
        $this->params['Pay']['BillFirstnameKana'] = $billFirstnameKana;

        return $this;
    }

    /**
     * ご請求先名字
     * max:297byte
     *
     * @param string $billLastName
     * @return self
     */
    public function setBillLastName(string $billLastName): self
    {
        if (isset($this->params['Pay']['BillLastName'])) {
            throw new LogicException('BillLastName is already set.');
        }
        $this->params['Pay']['BillLastName'] = $billLastName;

        return $this;
    }

    /**
     * ご請求先名字（フリガナ）
     * max:297byte
     *
     * @param string $billLastNameKana
     * @return self
     */
    public function setBillLastNameKana(string $billLastNameKana): self
    {
        if (isset($this->params['Pay']['BillLastNameKana'])) {
            throw new LogicException('BillLastNameKana is already set.');
        }
        $this->params['Pay']['BillLastNameKana'] = $billLastNameKana;

        return $this;
    }

    /**
     * ご請求先郵便番号
     * max:10byte
     *
     * @param string $billZipCode
     * @return self
     */
    public function setBillZipCode(string $billZipCode): self
    {
        if (isset($this->params['Pay']['BillZipCode'])) {
            throw new LogicException('BillZipCode is already set.');
        }
        $this->params['Pay']['BillZipCode'] = $billZipCode;

        return $this;
    }

    /**
     * ご請求先都道府県
     * 海外の場合「その他」が入ります。
     * max:12byte
     *
     * @param string $billPrefecture
     * @return self
     */
    public function setBillPrefecture(string $billPrefecture): self
    {
        if (isset($this->params['Pay']['BillPrefecture'])) {
            throw new LogicException('BillPrefecture is already set.');
        }
        $this->params['Pay']['BillPrefecture'] = $billPrefecture;

        return $this;
    }

    /**
     * ご請求先都道府県フリガナ
     * max:18byte
     *
     * @param string $billPrefectureKana
     * @return self
     */
    public function setBillPrefectureKana(string $billPrefectureKana): self
    {
        if (isset($this->params['Pay']['BillPrefectureKana'])) {
            throw new LogicException('BillPrefectureKana is already set.');
        }
        $this->params['Pay']['BillPrefectureKana'] = $billPrefectureKana;

        return $this;
    }

    /**
     * ご請求先市区郡
     * max:297byte
     *
     * @param string $billCity
     * @return self
     */
    public function setBillCity(string $billCity): self
    {
        if (isset($this->params['Pay']['BillCity'])) {
            throw new LogicException('BillCity is already set.');
        }
        $this->params['Pay']['BillCity'] = $billCity;

        return $this;
    }

    /**
     * ご請求先市区郡フリガナ
     * max:297byte
     *
     * @param string $billCityKana
     * @return self
     */
    public function setBillCityKana(string $billCityKana): self
    {
        if (isset($this->params['Pay']['BillCityKana'])) {
            throw new LogicException('BillCityKana is already set.');
        }
        $this->params['Pay']['BillCityKana'] = $billCityKana;

        return $this;
    }

    /**
     * ご請求先住所引用元
     *
     * @param BillAddressFrom $billAddressFrom
     * @return self
     */
    public function setBillAddressFrom(BillAddressFrom $billAddressFrom): self
    {
        if (isset($this->params['Pay']['BillAddressFrom'])) {
            throw new LogicException('BillAddressFrom is already set.');
        }
        $this->params['Pay']['BillAddressFrom'] = $billAddressFrom->getValue();

        return $this;
    }

    /**
     * ご請求先住所1
     * max:297byte
     *
     * @param string $billAddress1
     * @return self
     */
    public function setBillAddress1(string $billAddress1): self
    {
        if (isset($this->params['Pay']['BillAddress1'])) {
            throw new LogicException('BillAddress1 is already set.');
        }
        $this->params['Pay']['BillAddress1'] = $billAddress1;

        return $this;
    }

    /**
     * ご請求先住所1フリガナ
     * max:297byte
     *
     * @param string $billAddress1Kana
     * @return self
     */
    public function setBillAddress1Kana(string $billAddress1Kana): self
    {
        if (isset($this->params['Pay']['BillAddress1Kana'])) {
            throw new LogicException('BillAddress1Kana is already set.');
        }
        $this->params['Pay']['BillAddress1Kana'] = $billAddress1Kana;

        return $this;
    }

    /**
     * ご請求先住所2
     * max:297byte
     *
     * @param string $billAddress2
     * @return self
     */
    public function setBillAddress2(string $billAddress2): self
    {
        if (isset($this->params['Pay']['BillAddress2'])) {
            throw new LogicException('BillAddress2 is already set.');
        }
        $this->params['Pay']['BillAddress2'] = $billAddress2;

        return $this;
    }

    /**
     * ご請求先住所2フリガナ
     * max:297byte
     *
     * @param string $billAddress2Kana
     * @return self
     */
    public function setBillAddress2Kana(string $billAddress2Kana): self
    {
        if (isset($this->params['Pay']['BillAddress2Kana'])) {
            throw new LogicException('BillAddress2Kana is already set.');
        }
        $this->params['Pay']['BillAddress2Kana'] = $billAddress2Kana;

        return $this;
    }

    /**
     * ご請求先電話番号
     * max:14byte
     *
     * @param string $billPhoneNumber
     * @return self
     */
    public function setBillPhoneNumber(string $billPhoneNumber): self
    {
        if (isset($this->params['Pay']['BillPhoneNumber'])) {
            throw new LogicException('BillPhoneNumber is already set.');
        }
        $this->params['Pay']['BillPhoneNumber'] = $billPhoneNumber;

        return $this;
    }

    /**
     * ご請求先電話番号（緊急）
     * max:14byte
     *
     * @param string $billEmgPhoneNumber
     * @return self
     */
    public function setBillEmgPhoneNumber(string $billEmgPhoneNumber): self
    {
        if (isset($this->params['Pay']['BillEmgPhoneNumber'])) {
            throw new LogicException('BillEmgPhoneNumber is already set.');
        }
        $this->params['Pay']['BillEmgPhoneNumber'] = $billEmgPhoneNumber;

        return $this;
    }

    /**
     * ご請求先メールアドレス
     * バイヤーの入力したメールアドレスです。
     * Wallet利用の場合でかつ追加メールアドレス欄に入力がある場合は追加メールアドレスを入れます。
     * max:99length
     *
     * @param string $billMailAddress
     * @return self
     */
    public function setBillMailAddress(string $billMailAddress): self
    {
        if (isset($this->params['Pay']['BillMailAddress'])) {
            throw new LogicException('BillMailAddress is already set.');
        }
        $this->params['Pay']['BillMailAddress'] = $billMailAddress;

        return $this;
    }

    /**
     * ご請求先所属1フィールド名
     * max:297byte
     *
     * @param string $billSection1Field
     * @return self
     */
    public function setBillSection1Field(string $billSection1Field): self
    {
        if (isset($this->params['Pay']['BillSection1Field'])) {
            throw new LogicException('BillSection1Field is already set.');
        }
        $this->params['Pay']['BillSection1Field'] = $billSection1Field;

        return $this;
    }

    /**
     * ご請求先所属1入力情報
     * max:297byte
     *
     * @param string $billSection1Value
     * @return self
     */
    public function setBillSection1Value(string $billSection1Value): self
    {
        if (isset($this->params['Pay']['BillSection1Value'])) {
            throw new LogicException('BillSection1Value is already set.');
        }
        $this->params['Pay']['BillSection1Value'] = $billSection1Value;

        return $this;
    }

    /**
     * ご請求先所属2フィールド名
     * max:297byte
     *
     * @param string $billSection2Field
     * @return self
     */
    public function setBillSection2Field(string $billSection2Field): self
    {
        if (isset($this->params['Pay']['BillSection2Field'])) {
            throw new LogicException('BillSection2Field is already set.');
        }
        $this->params['Pay']['BillSection2Field'] = $billSection2Field;

        return $this;
    }

    /**
     * ご請求先所属2入力情報
     * max:297byte
     *
     * @param string $billSection2Value
     * @return self
     */
    public function setBillSection2Value(string $billSection2Value): self
    {
        if (isset($this->params['Pay']['BillSection2Value'])) {
            throw new LogicException('BillSection2Value is already set.');
        }
        $this->params['Pay']['BillSection2Value'] = $billSection2Value;

        return $this;
    }

    /**
     * 配送方法
     *
     * @param ShipMethod $shipMethod
     * @return self
     */
    public function setShipMethod(ShipMethod $shipMethod): self
    {
        if (isset($this->params['Ship']['ShipMethod'])) {
            throw new LogicException('ShipMethod is already set.');
        }
        $this->params['Ship']['ShipMethod'] = $shipMethod->getValue();

        return $this;
    }

    /**
     * 配送方法名称
     * ヤマト運輸など、お届け方法名称です。
     * Keyと名称のセットはセラー登録次第なのでセラー毎に違います。
     * max:297byte
     *
     * @param string $shipMethodName
     * @return self
     */
    public function setShipMethodName(string $shipMethodName): self
    {
        if (isset($this->params['Ship']['ShipMethodName'])) {
            throw new LogicException('ShipMethodName is already set.');
        }
        $this->params['Ship']['ShipMethodName'] = $shipMethodName;

        return $this;
    }

    /**
     * 配送希望日
     * 注文管理で利用します（検索など）。
     * ＦＥツールでは、Ｎｕｌｌ＝お届け希望日なし、あすつくＦＬＧあったらあすつく希望などです。
     * format:YYYYMMDD
     *
     * @param \DateTimeImmutable $shipRequestDate
     * @return self
     */
    public function setShipRequestDate(\DateTimeImmutable $shipRequestDate): self
    {
        if (isset($this->params['Ship']['ShipRequestDate'])) {
            throw new LogicException('ShipRequestDate is already set.');
        }
        $this->params['Ship']['ShipRequestDate'] = $shipRequestDate->format('Ymd');

        return $this;
    }

    /**
     * 配送希望時間
     * 12:00～14:00などです。
     * max:13byte
     *
     * @param string $shipRequestTime
     * @return self
     */
    public function setShipRequestTime(string $shipRequestTime): self
    {
        if (isset($this->params['Ship']['ShipRequestTime'])) {
            throw new LogicException('ShipRequestTime is already set.');
        }
        $this->params['Ship']['ShipRequestTime'] = $shipRequestTime;

        return $this;
    }

    /**
     * 配送希望時間
     * 注文管理ツールで入力された出荷の配送希望メモ入力内容です
     * max:500byte
     *
     * @param string $shipNotes
     * @return self
     */
    public function setShipNotes(string $shipNotes): self
    {
        if (isset($this->params['Ship']['ShipNotes'])) {
            throw new LogicException('ShipNotes is already set.');
        }
        $this->params['Ship']['ShipNotes'] = $shipNotes;

        return $this;
    }


}
