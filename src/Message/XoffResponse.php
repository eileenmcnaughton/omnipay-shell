<?php

namespace Omnipay\Shell\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Stripe Response
 */
class XoffResponse extends AbstractResponse implements RedirectResponseInterface
{
  /**
   * endpoint is the remote url - should be provided by the processor
   * @var string
   */
    public $endpoint = 'https://github.com';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
      //  $this->redirectUrl = $redirectUrl;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function isTransparentRedirect()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return $this->endpoint .'?' . http_build_query($this->data);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
