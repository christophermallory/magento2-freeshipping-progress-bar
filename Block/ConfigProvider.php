<?php
/**
 * Copyright © Chris Mallory All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ChrisMallory\FreeShippingProgressBar\Block;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /**
     * System XML config path for ChrisMallory_FreeShippingProgressBar
     */
    private const CHECKOUT_CART_XML_CONFIG_PATH = 'checkout/cart/';
    private const CARRIERS_FREE_SHIPPING_XML_CONFIG_PATH = 'carriers/freeshipping/';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve checkout configuration
     *
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'freeShippingProgressBar' => [
                'enabled' => $this->isEnabled(),
                'minValue' => $this->getFreeShippingMinValue(),
                'useSubtotal' => $this->useSubtotal(),
                'includeDiscount' => $this->includeDiscount(),
                'includeTax' => $this->includeTax()
            ]
        ];
    }

    /**
     * Check if free shipping progress bar is enabled
     *
     * @return bool
     */
    private function isEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'freeshipping_progress_enable',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get free shipping minimum value
     *
     * @return float
     */
    private function getFreeShippingMinValue(): float
    {
        if ($this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'use_freeshipping_method_config',
            ScopeInterface::SCOPE_STORE
        ) && $this->scopeConfig->getValue(
            self::CARRIERS_FREE_SHIPPING_XML_CONFIG_PATH . 'active',
            ScopeInterface::SCOPE_STORE
        )) {
            return (float)$this->scopeConfig->getValue(
                self::CARRIERS_FREE_SHIPPING_XML_CONFIG_PATH . 'free_shipping_subtotal',
                ScopeInterface::SCOPE_STORE
            );
        }

        return (float)$this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'freeshipping_progress_min_total',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if should use subtotal
     *
     * @return bool
     */
    private function useSubtotal(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'freeshipping_progress_use_subtotal',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if should include discount in subtotal
     *
     * @return bool
     */
    private function includeDiscount(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'freeshipping_progress_subtotal_includes_discount',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if should include tax in subtotal
     *
     * @return bool
     */
    private function includeTax(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::CHECKOUT_CART_XML_CONFIG_PATH . 'freeshipping_progress_subtotal_includes_tax',
            ScopeInterface::SCOPE_STORE
        );
    }
}
