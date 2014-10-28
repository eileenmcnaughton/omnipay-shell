<?php

namespace Omnipay\Shell;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Shell\SystemGateway;

class SystemGatewayTest extends GatewayTestCase
{
  /**
   * @var Omnipay/Shell/SystemGateway
   */
    public $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new SystemGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978))->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());

      $response->getRedirectData();

      $request = $this->gateway->purchase(array('amount' => '10.00'));
      $this->assertInstanceOf('Omnipay\Shell\Message\PurchaseRequest', $request);
      $this->assertSame('10.00', $request->getAmount());
      $this->assertFalse($response->isSuccessful());
      $this->assertTrue($response->isRedirect());
      $this->assertNotEmpty($response->getRedirectUrl());

      $this->assertSame('https://preprod-tpeweb.Shell.com/cgi/MYchoix_pagepaiement.cgi?', $response->getRedirectUrl());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00'));

        $this->assertInstanceOf('Omnipay\Shell\Message\CompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCompletePurchaseSend()
    {
      $request = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
        'firstName' => 'Pokemon',
        'lastName' => 'The second',
      )))->send();

      $this->assertInstanceOf('Omnipay\Shell\Message\Response', $request);
      $this->assertFalse($request->isTransparentRedirect());
    }
}
