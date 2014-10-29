<?php

namespace Omnipay\Shell\Message;

use Omnipay\Shell\Message\AbstractRequest;

/**
 * Paybox System Authorize Request
 */
class XoffAuthorizeRequest extends XoffAbstractRequest
{

    public function getData()
    {
        $this->validate('currency', 'amount');
        return $this->getBaseData() + $this->getTransactionData();
    }

    public function sendData($data)
    {
        return $this->response = new XoffAuthorizeResponse($this, $data, $this->getEndpoint());
    }

    protected function createResponse($data)
    {
        return $this->response = new XoffResponse($this, $data);
    }

    public function getRequiredFields()
    {
        return array
        (
            'amount',
            'email',
            'currency',
        );
    }

    public function getTransactionData()
    {
        return array
        (
            'PBX_CMD' => $this->getTransactionId(),
            'PBX_TOTAL' => $this->getAmount(),
            'PBX_DEVISE' => $this->getCurrencyNumeric(),
        );
    }

    /**
     * @return array
     * Get data that is common to all requests - generally aut
     */
    public function getBaseData()
    {
        return array(
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'type' => $this->getTransactionType(),
        );
    }

    /**
     * @return string
     */
    public function getUniqueID()
    {
        return uniqid();
    }

    /**
     * this is the url provided by your payment processor. Github is standing in for the real url here
    * @return string
    */
    public function getEndpoint()
    {
        return 'https://github.com';
    }

    public function getPaymentMethod()
    {
        return 'card';
    }

    public function getTransactionType()
    {
        return 'Authorize';
    }
}
