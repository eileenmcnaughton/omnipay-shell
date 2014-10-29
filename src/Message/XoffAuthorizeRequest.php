<?php

namespace Omnipay\Shell\Message;

use Omnipay\Shell\Message\AbstractRequest;

/**
 * Paybox System Authorize Request
 */
class XoffAuthorizeRequest extends XoffAbstractRequest
{

    /**
     * sendData function. In this case, where the browser is to be directly it constructs and returns a response object
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|XoffAuthorizeResponse
     */
    public function sendData($data)
    {
        return $this->response = new XoffAuthorizeResponse($this, $data, $this->getEndpoint());
    }

    /**
     * Get an array of the required fields for the core gateway
     * @return array
     */
    public function getRequiredCoreFields()
    {
        return array
        (
            'amount',
            'currency',
        );
    }

    /**
     * get an array of the required 'card' fields (personal information fields)
     * @return array
     */
    public function getRequiredCardFields()
    {
        return array
        (
            'email',
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
     * this is the url provided by your payment processor. Github is standing in for the real url here
    * @return string
    */
    public function getEndpoint()
    {
        return 'https://github.com';
    }

    public function getTransactionType()
    {
        return 'Authorize';
    }
}
