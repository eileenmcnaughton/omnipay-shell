<?php

namespace Omnipay\paypal_standard\Message;

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
