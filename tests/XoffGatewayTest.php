<?php

namespace Omnipay\paypal_standard;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\paypal_standard\XoffGateway;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\CreditCard;

class XoffGatewayTest extends GatewayTestCase
{
  /**
   * @var Omnipay/paypal_standard/SystemGateway
   */
    public $gateway;

    /**
     * @var CreditCard
     */
    public $card;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new XoffGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setUsername('Billy');
        $this->gateway->setPassword('really_secure');
        $this->card = new CreditCard(array('email' => 'mail@mail.com'));
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\paypal_standard\Message\XoffAuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?username=Billy&password=really_secure&type=sale&total=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testAuthorize()
    {
        $response = $this->gateway->authorize(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\paypal_standard\Message\XoffAuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?username=Billy&password=really_secure&type=Authorize&total=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testCapture()
    {
        $response = $this->gateway->capture(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\paypal_standard\Message\XoffAuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?username=Billy&password=really_secure&type=capture&total=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00',));

        $this->assertInstanceOf('Omnipay\paypal_standard\Message\XoffCompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    /**
     * @expectedException Omnipay\Common\Exception\InvalidRequestException
     */
    public function testCompletePurchaseSendMissingEmail()
    {
        $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
            'firstName' => 'Pokemon',
            'lastName' => 'The second',
        )))->send();
    }
}
