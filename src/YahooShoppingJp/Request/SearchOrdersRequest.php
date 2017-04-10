<?php

namespace Shippinno\YahooShoppingJp\Request;

use DateTimeImmutable;
use FluidXml\FluidXml;
use InvalidArgumentException;
use LogicException;
use Shippinno\YahooShoppingJp\Exception\InvalidRequestException;

class SearchOrdersRequest extends AbstractRequest
{
    private $params = [];

    public function __construct()
    {
        $this->params['Search']['Field'] = implode(',', [
            'OrderId', 'Version', 'OriginalOrderId', 'ParentOrderId', 'DeviceType', 'IsSeen', 'IsSplit', 'IsRoyalty',
            'IsSeller', 'IsAffiliate', 'IsRatingB2s', 'OrderTime', 'ExistMultiReleaseDate', 'ReleaseDate',
            'LastUpdateTime', 'Suspect', 'OrderStatus', 'StoreStatus', 'RoyaltyFixTime', 'PrintSlipFlag',
            'PrintDeliveryFlag', 'PrintBillFlag', 'BuyerCommentsFlag', 'PayStatus', 'SettleStatus', 'PayType',
            'PayMethod', 'PayMethodName', 'PayDate', 'SettleId', 'UseWallet', 'NeedBillSlip', 'NeedDetailedSlip',
            'NeedReceipt', 'BillFirstName', 'BillFirstNameKana', 'BillLastName', 'BillLastNameKana', 'BillPrefecture',
            'ShipStatus', 'ShipMethod', 'ShipRequestDate', 'ShipRequestTime', 'ShipNotes', 'ShipInvoiceNumber1',
            'ShipInvoiceNumber2', 'ArriveType', 'ShipDate', 'NeedGiftWrap', 'NeedGiftWrapMessage', 'NeedGiftWrapPaper',
            'ShipFirstName', 'ShipFirstNameKana', 'ShipLastName', 'ShipLastNameKana', 'ShipPrefecture', 'PayCharge',
            'ShipCharge', 'GiftWrapCharge', 'Discount', 'UsePoint', 'TotalPrice', 'RefundTotalPrice', 'UsePointType',
            'IsGetPointFixAll', 'SellerId', 'IsLogin', 'PayNo', 'PayNoIssueDate', 'SellerType', 'IsPayManagement',
            'ShipUrl', 'ShipMethodName', 'ArrivalDate', 'TotalMallCouponDiscount',
        ]);
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
     * @param null|DateTimeImmutable $from
     * @param null|DateTimeImmutable $to
     * @return self
     */
    public function setOrderedDateTimeRange(DateTimeImmutable $from = null, DateTimeImmutable $to = null): self
    {
        if (null === $from && null === $to) {
            throw new InvalidArgumentException('Either OrderTimeFrom or OrderTimeTo has to be set.');
        }

        if (null !== $from &&
            null !== $to &&
            $from > $to) {
            throw new LogicException('OrderTimeFrom has to be earlier than OrderTimeTo.');
        }

        if (isset($this->params['Search']['Condition']['OrderTimeFrom'])) {
            throw new LogicException('OrderTimeFrom is already set.');
        }

        if (isset($this->params['Search']['Condition']['OrderTimeTo'])) {
            throw new LogicException('OrderTimeTo is already set.');
        }

        if (null !== $from) {
            $this->params['Search']['Condition']['OrderTimeFrom'] = $from->format('YmdHis');
        }

        if (null !== $to) {
            $this->params['Search']['Condition']['OrderTimeTo'] = $to->format('YmdHis');
        }

        return $this;
    }

    /**
     * @param int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        if ($offset < 0) {
            throw new InvalidArgumentException;
        }

        if (isset($this->params['Search']['Start'])) {
            throw new LogicException('Start is already set.');
        }

        $this->params['Search']['Start'] = $offset + 1;

        return $this;
    }

    /**
     * @param int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        if ($limit < 0) {
            throw new InvalidArgumentException;
        }

        if (isset($this->params['Search']['Result'])) {
            throw new LogicException('Result is already set.');
        }

        $this->params['Search']['Result'] = $limit;

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
        if (! isset($this->params['SellerId'])) {
            throw new InvalidRequestException;
        }
    }
}
