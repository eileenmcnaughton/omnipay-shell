<?php

namespace Omnipay\Shell\Message;

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
