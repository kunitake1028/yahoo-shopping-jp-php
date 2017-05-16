<?php


namespace Shippinno\YahooShoppingJp\Request;


use FluidXml\FluidXml;
use LogicException;
use Shippinno\YahooShoppingJp\Api\UpdateOrderInfoApi;
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
     * 閲覧済みフラグ
     * 更新する時必ずtrue
     *
     * @return bool
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
}