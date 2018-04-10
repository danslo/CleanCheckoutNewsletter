<?php
/**
 * Copyright © 2018 Rubic. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Rubic\CleanCheckoutNewsletter\ConfigProvider;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;

class CheckoutConfigProvider implements ConfigProviderInterface
{
    const CONFIG_PATH_NEWSLETTER_ENABLED      = 'clean_checkout/newsletter/enabled';
    const CONFIG_PATH_NEWSLETTER_CHECKED      = 'clean_checkout/newsletter/checked';
    const CONFIG_PATH_NEWSLETTER_LABEL        = 'clean_checkout/newsletter/label';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param UrlInterface $url
     */
    public function __construct(ScopeConfigInterface $scopeConfig, UrlInterface $url)
    {
        $this->scopeConfig = $scopeConfig;
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'newsletterUrl' => $this->url->getUrl('clean_checkout/newsletter/subscribe'),
            'newsletterEnabled' => (bool)$this->scopeConfig->getValue(
                self::CONFIG_PATH_NEWSLETTER_ENABLED,
                ScopeInterface::SCOPE_STORE
            ),
            'newsletterChecked' => (bool)$this->scopeConfig->getValue(
                self::CONFIG_PATH_NEWSLETTER_CHECKED,
                ScopeInterface::SCOPE_STORE
            ),
            'newsletterLabel' => $this->scopeConfig->getValue(
                self::CONFIG_PATH_NEWSLETTER_LABEL,
                ScopeInterface::SCOPE_STORE
            )
        ];
    }
}
