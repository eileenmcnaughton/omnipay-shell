<?php

namespace omnipay\paypalstandard\Message;

/**
 * Capture Request
 */
class CaptureRequest extends AuthorizeRequest
{
    public function getTransactionType()
    {
        return 'capture';
    }
}
