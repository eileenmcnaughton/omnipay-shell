<?php

namespace civicrm\paypalstandard\Message;

/**
 * Purchase Request
 */
class PurchaseRequest extends AuthorizeRequest
{
    public function getTransactionType()
    {
        return 'sale';
    }
}
