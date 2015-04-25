<?php

namespace Omnipay\paypalstandard\Message;

/**
 * Authorize Request
 */
class XoffCompletePurchaseRequest extends XoffAbstractRequest
{
    public function sendData($data)
    {
        return $this->response = new XoffCompletePurchaseResponse($this, $data);
    }

    public function getData()
    {
        if (strtolower($this->httpRequest->request->get('x_MD5_Hash')) !== $this->getHash()) {
            throw new InvalidRequestException('Incorrect hash');
        }

        return $this->httpRequest->request->all();
    }
}
