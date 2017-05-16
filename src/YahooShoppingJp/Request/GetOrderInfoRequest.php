<?php

namespace Shippinno\YahooShoppingJp\Request;

use FluidXml\FluidXml;
use LogicException;
use Shippinno\YahooShoppingJp\Api\GetOrderInfoApi;
use Shippinno\YahooShoppingJp\Response\GetOrderInfoResponse;

class GetOrderInfoRequest extends AbstractRequest
{

    public function __construct()
    {
        $this->params['Target']['Field'] = implode(',', [
            'OrderId', 'Version', 'ParentOrderId', 'ChildOrderId', 'DeviceType', 'MobileCarrierName', 'IsSeen',
            'IsSplit', 'CancelReason', 'IsRoyalty', 'IsRoyaltyFix', 'IsSeller', 'IsAffiliate', 'IsRatingB2s', 'NeedSnl',
            'OrderTime', 'LastUpdateTime', 'Suspect', 'SuspectMessage', 'OrderStatus', 'StoreStatus', 'RoyaltyFixTime',
            'SendConfirmTime', 'SendPayTime', 'PrintSlipTime', 'PrintDeliveryTime', 'PrintBillTime', 'BuyerComments',
            'SellerComments', 'Notes', 'OperationUser', 'Referer', 'EntryPoint', 'HistoryId', 'HistoryId',
            'UseCouponData', 'UseCouponData', 'ShippingCouponFlg', 'ShippingCouponDiscount', 'CampaignPoints',
            'PayStatus', 'SettleStatus', 'PayType', 'PayKind', 'PayMethod', 'PayMethodName', 'SellerHandlingCharge',
            'PayActionTime', 'PayDate', 'PayNotes', 'SettleId', 'CardBrand', 'CardNumber', 'CardNumberLast4',
            'CardExpireYear', 'CardExpireMonth', 'CardPayType', 'CardHolderName', 'CardPayCount', 'CardBirthDay',
            'UseYahooCard', 'UseWallet', 'NeedBillSlip', 'NeedDetailedSlip', 'NeedReceipt', 'AgeConfirmField',
            'AgeConfirmValue', 'AgeConfirmValue', 'BillAddressFrom', 'BillFirstName', 'BillFirstNameKana',
            'BillLastName', 'BillLastNameKana', 'BillZipCode', 'BillPrefecture', 'BillPrefectureKana', 'BillCity',
            'BillCityKana', 'BillAddress1', 'BillAddress1Kana', 'BillAddress2', 'BillAddress2Kana', 'BillPhoneNumber',
            'BillEmgPhoneNumber', 'BillMailAddress', 'BillSection1Field', 'BillSection1Value', 'BillSection2Field',
            'BillSection2Value', 'PayNo', 'PayNoIssueDate', 'ConfirmNumber', 'PaymentTerm', 'ShipStatus', 'ShipMethod',
            'ShipMethodName', 'ShipRequestDate', 'ShipRequestTime', 'ShipNotes', 'ShipInvoiceNumber1',
            'ShipInvoiceNumber2', 'ShipUrl', 'ArriveType', 'ShipDate', 'ArrivalDate', 'NeedGiftWrap', 'GiftWrapType',
            'GiftWrapMessage', 'NeedGiftWrapPaper', 'GiftWrapPaperType', 'GiftWrapName', 'Option1Field', 'Option1Type',
            'Option1Value', 'Option2Field', 'Option2Type', 'Option2Value', 'ShipFirstName', 'ShipFirstNameKana',
            'ShipLastName', 'ShipLastNameKana', 'ShipZipCode', 'ShipPrefecture', 'ShipPrefectureKana', 'ShipCity',
            'ShipCityKana', 'ShipAddress1', 'ShipAddress1Kana', 'ShipAddress2', 'ShipAddress2Kana', 'ShipPhoneNumber',
            'ShipEmgPhoneNumber', 'ShipSection1Field', 'ShipSection1Value', 'ShipSection2Field', 'ShipSection2Value',
            'PayCharge', 'ShipCharge', 'GiftWrapCharge', 'Discount', 'Adjustments', 'SettleAmount', 'UsePoint',
            'TotalPrice', 'SettlePayAmount', 'TaxRatio', 'IsGetPointFixAll', 'TotalMallCouponDiscount', 'LineId',
            'ItemId', 'Title', 'SubCode', 'SubCodeOption', 'ItemOption', 'Inscription', 'IsUsed', 'ImageId', 'IsTaxable',
            'Jan', 'ProductId', 'CategoryId', 'AffiliateRatio', 'UnitPrice', 'Quantity', 'PointAvailQuantity',
            'ReleaseDate', 'IsShippingFree', 'HaveReview', 'PointFspCode', 'PointRatioY', 'PointRatioSeller',
            'UnitGetPoint', 'IsGetPointFix', 'GetPointFixDate', 'CouponData', 'CouponDiscount', 'CouponUseNum',
            'OriginalPrice', 'OriginalNum', 'SellerId', 'IsLogin', 'FspLicenseCode', 'FspLicenseName', 'GuestAuthId',
        ]);
    }

    /**
     * @return GetOrderInfoApi
     */
    public function api()
    {
        return new GetOrderInfoApi;
    }

    /**
     * @return GetOrderInfoResponse
     */
    public function response()
    {
        return new GetOrderInfoResponse;
    }

    /**
     * @return void
     */
    protected function validateParams()
    {
        // TODO: Implement validateParams() method.
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $fluidXml = new FluidXml('Req');
        $fluidXml->add($this->params);

        return $fluidXml->xml();
    }

    /**
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

}
