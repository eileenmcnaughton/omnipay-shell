<?php

namespace Omnipay\paypalstandard\Message;

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
