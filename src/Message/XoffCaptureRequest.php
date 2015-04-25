<?php

namespace Omnipay\paypal_standard\Message;

/**
 * Capture Request
 */
class XoffCaptureRequest extends XoffAuthorizeRequest
{
    public function getTransactionType()
    {
        return 'capture';
    }
}
