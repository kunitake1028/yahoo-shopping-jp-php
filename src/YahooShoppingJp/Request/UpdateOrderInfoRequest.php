<?php

namespace Shippinno\YahooShoppingJp\Request;

use FluidXml\FluidXml;
use LogicException;
use Shippinno\YahooShoppingJp\Api\UpdateOrderInfoApi;
use Shippinno\YahooShoppingJp\Enum\ArriveType;
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
     * 注文情報を更新した場合、自動で閲覧済みになります。
     * また、未閲覧から閲覧済みにのみ更新できます。
     * 閲覧済み→未閲覧：更新できません
     * 未閲覧→閲覧済み：更新できます
     * false : 未閲覧
     * true : 閲覧済み
     *
     * @return self
     */
    public function setIsSeen(bool $isSeen): self
    {
        if (isset($this->params['Order']['IsSeen'])) {
            throw new LogicException('IsSeen is already set.');
        }
        $this->params['Order']['IsSeen'] = $isSeen ? 'true' : 'false';

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
     * @param \DateTimeImmutable $printSlipTime
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
     * @param \DateTimeImmutable $payDate
     * @return self
     * @internal param \DateTimeImmutable $printBillTime
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
     * @param \DateTimeImmutable $payManageLimitDate
     * @return self
     * @internal param \DateTimeImmutable $printBillTime
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
     * @param bool|string $needBillSlip
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
     * @param bool|string $needDetailedSlip
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
     * @param bool|string $needReceipt
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
     * 配送メモ
     * 注文管理ツールで入力された出荷の配送希望メモ入力内容です。
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

    /**
     * 配送伝票番号1
     * 注文管理ツールでセラーが入力、アップロードした配送会社の配送伝票番号です。注文管理ツールの画面上は1と2があります。
     * max:30byte
     *
     * @param string $shipInvoiceNumber1
     * @return self
     */
    public function setShipInvoiceNumber1(string $shipInvoiceNumber1): self
    {
        if (isset($this->params['Ship']['ShipInvoiceNumber1'])) {
            throw new LogicException('ShipInvoiceNumber1 is already set.');
        }
        $this->params['Ship']['ShipInvoiceNumber1'] = $shipInvoiceNumber1;

        return $this;
    }

    /**
     * 配送伝票番号2
     * 注文管理ツールでセラーが入力、アップロードした配送会社の配送伝票番号です。注文管理ツールの画面上は1と2があります。
     * max:30byte
     *
     * @param string $shipInvoiceNumber2
     * @return self
     */
    public function setShipInvoiceNumber2(string $shipInvoiceNumber2): self
    {
        if (isset($this->params['Ship']['ShipInvoiceNumber2'])) {
            throw new LogicException('ShipInvoiceNumber2 is already set.');
        }
        $this->params['Ship']['ShipInvoiceNumber2'] = $shipInvoiceNumber2;

        return $this;
    }

    /**
     * 配送会社URL
     * アップロードした配送会社の配送伝票番号です.
     * max:100byte
     *
     * @param string $shipUrl
     * @return self
     */
    public function setShipUrl(string $shipUrl): self
    {
        if (isset($this->params['Ship']['ShipUrl'])) {
            throw new LogicException('ShipUrl is already set.');
        }
        $this->params['Ship']['ShipUrl'] = $shipUrl;

        return $this;
    }

    /**
     * きょうつく、あすつく
     * きょうつく注文、あすつく注文の場合設定
     *
     * @param ArriveType $arriveType
     * @return self
     */
    public function setArriveType(ArriveType $arriveType): self
    {
        if (isset($this->params['Ship']['ArriveType'])) {
            throw new LogicException('ArriveType is already set.');
        }
        $this->params['Ship']['ArriveType'] = $arriveType->getValue();

        return $this;
    }

    /**
     * 出荷日
     * 注文管理ツールで入力された出荷日です。
     * format:YYYYMMDD
     *
     * @param \DateTimeImmutable $shipDate
     * @return self
     */
    public function setShipDate(\DateTimeImmutable $shipDate): self
    {
        if (isset($this->params['Ship']['ShipDate'])) {
            throw new LogicException('ShipDate is already set.');
        }
        $this->params['Ship']['ShipDate'] = $shipDate->format('Ymd');

        return $this;
    }

    /**
     * 出荷日
     * 注文管理ツールで入力された出荷日です。
     * format:YYYYMMDD
     *
     * @param \DateTimeImmutable $arrivalDate
     * @return self
     */
    public function setArrivalDate(\DateTimeImmutable $arrivalDate): self
    {
        if (isset($this->params['Ship']['ArrivalDate'])) {
            throw new LogicException('ArrivalDate is already set.');
        }
        $this->params['Ship']['ArrivalDate'] = $arrivalDate->format('Ymd');

        return $this;
    }

    /**
     * ギフト包装有無
     * ※モバイル支払いの場合、ギフト包装の変更はできません。
     * キーなし : カートに設定なし
     * false : ギフト包装無し
     * true : ギフト包装有り
     * max:5byte
     *
     * @param bool $needGiftWrap
     * @return self
     */
    public function setNeedGiftWrap(bool $needGiftWrap): self
    {
        if (isset($this->params['Ship']['NeedGiftWrap'])) {
            throw new LogicException('NeedGiftWrap is already set.');
        }
        $this->params['Ship']['NeedGiftWrap'] = $needGiftWrap ? 'true' : 'false';

        return $this;
    }

    /**
     * ギフト包装の種類
     * max:30byte
     *
     * @param string $giftWrapType
     * @return self
     */
    public function setGiftWrapType(string $giftWrapType): self
    {
        if (isset($this->params['Ship']['GiftWrapType'])) {
            throw new LogicException('GiftWrapType is already set.');
        }
        $this->params['Ship']['GiftWrapType'] = $giftWrapType;

        return $this;
    }

    /**
     * ギフトメッセージ
     * max:297byte
     *
     * @param string $giftWrapMessage
     * @return self
     */
    public function setGiftWrapMessage(string $giftWrapMessage): self
    {
        if (isset($this->params['Ship']['GiftWrapMessage'])) {
            throw new LogicException('GiftWrapMessage is already set.');
        }
        $this->params['Ship']['GiftWrapMessage'] = $giftWrapMessage;

        return $this;
    }

    /**
     * のしの有無
     * キーなし : カートに設定なし
     * false : のし無し
     * true : のし有り
     *
     * @param bool $needGiftWrapPaper
     * @return self
     */
    public function setNeedGiftWrapPaper(bool $needGiftWrapPaper): self
    {
        if (isset($this->params['Ship']['NeedGiftWrapPaper'])) {
            throw new LogicException('NeedGiftWrapPaper is already set.');
        }
        $this->params['Ship']['NeedGiftWrapPaper'] = $needGiftWrapPaper ? '1' : '0';

        return $this;
    }

    /**
     * のし種類
     * max:30byte
     *
     * @param string $giftWrapPaperType
     * @return self
     */
    public function setGiftWrapPaperType(string $giftWrapPaperType): self
    {
        if (isset($this->params['Ship']['GiftWrapPaperType'])) {
            throw new LogicException('GiftWrapPaperType is already set.');
        }
        $this->params['Ship']['GiftWrapPaperType'] = $giftWrapPaperType;

        return $this;
    }

    /**
     * 名入れ（メッセージ）
     * max:297byte
     *
     * @param string $giftWrapName
     * @return self
     */
    public function setGiftWrapName(string $giftWrapName): self
    {
        if (isset($this->params['Ship']['GiftWrapName'])) {
            throw new LogicException('GiftWrapName is already set.');
        }
        $this->params['Ship']['GiftWrapName'] = $giftWrapName;

        return $this;
    }

    /**
     * お届け先名前
     * max:297byte
     *
     * @param string $shipFirstName
     * @return self
     */
    public function setShipFirstName(string $shipFirstName): self
    {
        if (isset($this->params['Ship']['ShipFirstName'])) {
            throw new LogicException('ShipFirstName is already set.');
        }
        $this->params['Ship']['ShipFirstName'] = $shipFirstName;

        return $this;
    }

    /**
     * お届け先名前
     * max:297byte
     *
     * @param string $shipFirstNameKana
     * @return self
     */
    public function setShipFirstNameKana(string $shipFirstNameKana): self
    {
        if (isset($this->params['Ship']['ShipFirstNameKana'])) {
            throw new LogicException('ShipFirstNameKana is already set.');
        }
        $this->params['Ship']['ShipFirstNameKana'] = $shipFirstNameKana;

        return $this;
    }

    /**
     * お届け先名字
     * max:297byte
     *
     * @param string $shipLastName
     * @return self
     */
    public function setShipLastName(string $shipLastName): self
    {
        if (isset($this->params['Ship']['ShipLastName'])) {
            throw new LogicException('ShipLastName is already set.');
        }
        $this->params['Ship']['ShipLastName'] = $shipLastName;

        return $this;
    }

    /**
     * お届け先名字カナ
     * max:297byte
     *
     * @param string $shipLastNameKana
     * @return self
     */
    public function setShipLastNameKana(string $shipLastNameKana): self
    {
        if (isset($this->params['Ship']['ShipLastNameKana'])) {
            throw new LogicException('ShipLastNameKana is already set.');
        }
        $this->params['Ship']['ShipLastNameKana'] = $shipLastNameKana;

        return $this;
    }

    /**
     * お届け先郵便番号
     * max:10byte
     *
     * @param string $shipZipCode
     * @return self
     */
    public function setShipZipCode(string $shipZipCode): self
    {
        if (isset($this->params['Ship']['ShipZipCode'])) {
            throw new LogicException('ShipZipCode is already set.');
        }
        $this->params['Ship']['ShipZipCode'] = $shipZipCode;

        return $this;
    }

    /**
     * お届け先都道府県
     * 海外の場合は「その他」として保存します。
     * max:12byte
     *
     * @param string $shipPrefecture
     * @return self
     */
    public function setShipPrefecture(string $shipPrefecture): self
    {
        if (isset($this->params['Ship']['ShipPrefecture'])) {
            throw new LogicException('ShipPrefecture is already set.');
        }
        $this->params['Ship']['ShipPrefecture'] = $shipPrefecture;

        return $this;
    }

    /**
     * お届け先都道府県フリガナ
     * max:18byte
     *
     * @param string $shipPrefectureKana
     * @return self
     */
    public function setShipPrefectureKana(string $shipPrefectureKana): self
    {
        if (isset($this->params['Ship']['ShipPrefectureKana'])) {
            throw new LogicException('ShipPrefectureKana is already set.');
        }
        $this->params['Ship']['ShipPrefectureKana'] = $shipPrefectureKana;

        return $this;
    }

    /**
     * お届け先市区郡
     * max:297byte
     *
     * @param string $shipCity
     * @return self
     */
    public function setShipCity(string $shipCity): self
    {
        if (isset($this->params['Ship']['ShipCity'])) {
            throw new LogicException('ShipCity is already set.');
        }
        $this->params['Ship']['ShipCity'] = $shipCity;

        return $this;
    }

    /**
     * お届け先市区郡フリガナ
     * max:297byte
     *
     * @param string $shipCityKana
     * @return self
     */
    public function setShipCityKana(string $shipCityKana): self
    {
        if (isset($this->params['Ship']['ShipCityKana'])) {
            throw new LogicException('ShipCityKana is already set.');
        }
        $this->params['Ship']['ShipCityKana'] = $shipCityKana;

        return $this;
    }

    /**
     * お届け先住所1
     * max:297byte
     *
     * @param string $shipAddress1
     * @return self
     */
    public function setShipAddress1(string $shipAddress1): self
    {
        if (isset($this->params['Ship']['ShipAddress1'])) {
            throw new LogicException('ShipAddress1 is already set.');
        }
        $this->params['Ship']['ShipAddress1'] = $shipAddress1;

        return $this;
    }

    /**
     * お届け先住所1フリガナ
     * max:297byte
     *
     * @param string $shipAddress1Kana
     * @return self
     */
    public function setShipAddress1Kana(string $shipAddress1Kana): self
    {
        if (isset($this->params['Ship']['ShipAddress1Kana'])) {
            throw new LogicException('ShipAddress1Kana is already set.');
        }
        $this->params['Ship']['ShipAddress1Kana'] = $shipAddress1Kana;

        return $this;
    }

    /**
     * お届け先住所2
     * max:297byte
     *
     * @param string $shipAddress2
     * @return self
     */
    public function setShipAddress2(string $shipAddress2): self
    {
        if (isset($this->params['Ship']['ShipAddress2'])) {
            throw new LogicException('ShipAddress2 is already set.');
        }
        $this->params['Ship']['ShipAddress2'] = $shipAddress2;

        return $this;
    }

    /**
     * お届け先住所2フリガナ
     * max:297byte
     *
     * @param string $shipAddress2Kana
     * @return self
     */
    public function setShipAddress2Kana(string $shipAddress2Kana): self
    {
        if (isset($this->params['Ship']['ShipAddress2Kana'])) {
            throw new LogicException('ShipAddress2Kana is already set.');
        }
        $this->params['Ship']['ShipAddress2Kana'] = $shipAddress2Kana;

        return $this;
    }

    /**
     * お届け先電話番号
     * max:14byte
     *
     * @param string $shipPhoneNumber
     * @return self
     */
    public function setShipPhoneNumber(string $shipPhoneNumber): self
    {
        if (isset($this->params['Ship']['ShipPhoneNumber'])) {
            throw new LogicException('ShipPhoneNumber is already set.');
        }
        $this->params['Ship']['ShipPhoneNumber'] = $shipPhoneNumber;

        return $this;
    }

    /**
     * お届け先緊急連絡先
     * max:14byte
     *
     * @param string $shipEmgPhoneNumber
     * @return self
     */
    public function setShipEmgPhoneNumber(string $shipEmgPhoneNumber): self
    {
        if (isset($this->params['Ship']['ShipEmgPhoneNumber'])) {
            throw new LogicException('ShipEmgPhoneNumber is already set.');
        }
        $this->params['Ship']['ShipEmgPhoneNumber'] = $shipEmgPhoneNumber;

        return $this;
    }

    /**
     * お届け先所属1フィールド名
     * max:297byte
     *
     * @param string $shipSection1Field
     * @return self
     */
    public function setShipSection1Field(string $shipSection1Field): self
    {
        if (isset($this->params['Ship']['ShipSection1Field'])) {
            throw new LogicException('ShipSection1Field is already set.');
        }
        $this->params['Ship']['ShipSection1Field'] = $shipSection1Field;

        return $this;
    }

    /**
     * お届け先所属1入力情報
     * max:297byte
     *
     * @param string $shipSection1Value
     * @return self
     */
    public function setShipSection1Value(string $shipSection1Value): self
    {
        if (isset($this->params['Ship']['ShipSection1Value'])) {
            throw new LogicException('ShipSection1Value is already set.');
        }
        $this->params['Ship']['ShipSection1Value'] = $shipSection1Value;

        return $this;
    }

    /**
     * お届け先所属2フィールド名
     * max:297byte
     *
     * @param string $shipSection2Field
     * @return self
     */
    public function setShipSection2Field(string $shipSection2Field): self
    {
        if (isset($this->params['Ship']['ShipSection2Field'])) {
            throw new LogicException('ShipSection2Field is already set.');
        }
        $this->params['Ship']['ShipSection2Field'] = $shipSection2Field;

        return $this;
    }

    /**
     * お届け先所属2入力情報
     * max:297byte
     *
     * @param string $shipSection2Value
     * @return self
     */
    public function setShipSection2Value(string $shipSection2Value): self
    {
        if (isset($this->params['Ship']['ShipSection2Value'])) {
            throw new LogicException('ShipSection2Value is already set.');
        }
        $this->params['Ship']['ShipSection2Value'] = $shipSection2Value;

        return $this;
    }

    /**
     * 手数料
     * セラーが設定した手数料（代引き手数料など）、Yahoo!決済の決済手数料は別です。
     * max:10byte
     *
     * @param string $payCharge
     * @return self
     */
    public function setPayCharge(string $payCharge): self
    {
        if (isset($this->params['Detail']['PayCharge'])) {
            throw new LogicException('PayCharge is already set.');
        }
        $this->params['Detail']['PayCharge'] = $payCharge;

        return $this;
    }

    /**
     * 送料
     * max:10byte
     *
     * @param string $shipCharge
     * @return self
     */
    public function setShipCharge(string $shipCharge): self
    {
        if (isset($this->params['Detail']['ShipCharge'])) {
            throw new LogicException('ShipCharge is already set.');
        }
        $this->params['Detail']['ShipCharge'] = $shipCharge;

        return $this;
    }

    /**
     * ギフト包装料
     * max:10byte
     *
     * @param string $giftWrapCharge
     * @return self
     */
    public function setGiftWrapCharge(string $giftWrapCharge): self
    {
        if (isset($this->params['Detail']['GiftWrapCharge'])) {
            throw new LogicException('GiftWrapCharge is already set.');
        }
        $this->params['Detail']['GiftWrapCharge'] = $giftWrapCharge;

        return $this;
    }

    /**
     * 値引き
     * max:10byte
     *
     * @param string $discount
     * @return self
     */
    public function setDiscount(string $discount): self
    {
        if (isset($this->params['Detail']['Discount'])) {
            throw new LogicException('Discount is already set.');
        }
        $this->params['Detail']['Discount'] = $discount;

        return $this;
    }

    /**
     * 調整額
     * マイナスの値も許容、その場合は -(10byte) が許容最大
     * max:10byte
     *
     * @param string $adjustments
     * @return self
     */
    public function setAdjustments(string $adjustments): self
    {
        if (isset($this->params['Detail']['Adjustments'])) {
            throw new LogicException('Adjustments is already set.');
        }
        $this->params['Detail']['Adjustments'] = $adjustments;

        return $this;
    }

    /**
     * 商品LineID
     * 商品情報を更新する際は必須です。
     *
     * @param string $lineId
     * @return self
     */
    public function setLineId(string $lineId): self
    {
        if (isset($this->params['Item']['LineId'])) {
            throw new LogicException('LineId is already set.');
        }
        $this->params['Item']['LineId'] = $lineId;

        return $this;
    }

    /**
     * 商品ごとの数量
     * max:3byte
     *
     * @param string $quantity
     * @return self
     */
    public function setQuantity(string $quantity): self
    {
        if (isset($this->params['Item']['Quantity'])) {
            throw new LogicException('Quantity is already set.');
        }
        $this->params['Item']['Quantity'] = $quantity;

        return $this;
    }

    /**
     * 発売日
     * 発売日の入力がある場合です。
     * 発売日＞注文日の場合、予約注文として扱います。
     * format:YYYYMMDD
     *
     * @param \DateTimeImmutable $releaseDate
     * @return self
     */
    public function setReleaseDate(\DateTimeImmutable $releaseDate): self
    {
        if (isset($this->params['Item']['ReleaseDate'])) {
            throw new LogicException('ReleaseDate is already set.');
        }
        $this->params['Item']['ReleaseDate'] = $releaseDate->format('Ymd');

        return $this;
    }

}
