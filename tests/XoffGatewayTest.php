<?php

namespace Omnipay\Shell;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Shell\XoffGateway;

class XoffGatewayTest extends GatewayTestCase
{
  /**
   * @var Omnipay/Shell/SystemGateway
   */
    public $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new XoffGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setUsername('Billy');
        $this->gateway->setPassword('really_secure');
    }

public function testPurchase()
{
    $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978))->send();
    $this->assertInstanceOf('Omnipay\Shell\Message\XoffAuthorizeResponse', $response);
    $this->assertFalse($response->isSuccessful());
    $this->assertTrue($response->isRedirect());
    $this->assertNotEmpty($response->getRedirectUrl());
    $this->assertSame('https://github.com?username=Billy&password=really_secure&type=sale&PBX_TOTAL=10.00', $response->getRedirectUrl());
}

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00'));

        $this->assertInstanceOf('Omnipay\Shell\Message\XoffCompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCompletePurchaseSend()
    {
      $request = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
        'firstName' => 'Pokemon',
        'lastName' => 'The second',
      )))->send();

      $this->assertInstanceOf('Omnipay\Shell\Message\XoffAuthorizeResponse', $request);
      $this->assertFalse($request->isTransparentRedirect());
    }
}
