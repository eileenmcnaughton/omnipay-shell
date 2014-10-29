<?php

namespace Omnipay\Shell\Message;

/**
 * Capture Request
 */
class XoffCaptureRequest extends XoffAuthorizeRequest
{
    public function getTransactionType()
    {
        return 'Purchase';
    }
}
