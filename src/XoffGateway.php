<?php
namespace Omnipay\Shell; //Make sure you update the namespace to reflect your plugin

use Omnipay\Common\AbstractGateway;

/**
 * Sample Gateway using a redirect method
 */
class XoffGateway extends AbstractGateway
{

  /**
   * get the name of your processor. This will be the name used w
   * @return string
   */
    public function getName()
    {
        return 'ShellXoff';
    }

  /**
   * declare the parameters that will be used to authenticate with the site
   * You will need to create a function for each of these. e.g getUsername for username
   * @return array
   */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'testMode' => false,
        );
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Shell\Message\XoffAuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Shell\Message\XoffAuthorizeRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Shell\Message\XoffCaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Shell\Message\XoffCaptureRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Shell\Message\XoffPurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Shell\Message\XoffPurchaseRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Shell\Message\XoffCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Shell\Message\XoffCompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Shell\Message\CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Shell\Message\XoffCompleteAuthorizeRequest', $parameters);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
}
