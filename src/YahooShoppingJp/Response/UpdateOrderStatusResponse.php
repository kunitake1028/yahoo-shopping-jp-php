<?php


namespace Shippinno\YahooShoppingJp\Response;


class UpdateOrderStatusResponse extends AbstractResponse
{

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $warningCode = '';

    /**
     * @var string
     */
    private $warningMessage = '';

    /**
     * @var string
     */
    private $warningDetail = '';

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->status = $data['Status'];

        if (isset($data['Warning'])) {
            $this->warningCode = $data['Warning']['Code'];
            $this->warningMessage = $data['Warning']['Message'];
            $this->warningDetail = $data['Warning']['Detail'];
        }
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function warningCode(): string
    {
        return $this->warningCode;
    }

    /**
     * @return string
     */
    public function warningMessage(): string
    {
        return $this->warningMessage;
    }

    /**
     * @return string
     */
    public function warningDetail(): string
    {
        return $this->warningDetail;
    }
}