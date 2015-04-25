<?php

namespace Omnipay\paypalstandard\Message;

/**
 * Purchase Request
 */
class XoffPurchaseRequest extends XoffAuthorizeRequest
{
    public function getTransactionType()
    {
        return 'sale';
    }
}
