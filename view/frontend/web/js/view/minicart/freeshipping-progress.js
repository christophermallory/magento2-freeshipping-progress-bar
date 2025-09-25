/**
 * Copyright © Chris Mallory All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data',
    'Magento_Catalog/js/price-utils',
    'mage/translate'
], function (Component, ko, customerData, priceUtils, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'ChrisMallory_FreeShippingProgressBar/minicart/freeshipping-progress'
        },

        /**
         * Initialize component
         */
        initialize: function () {
            this._super();
            this.cart = customerData.get('cart');
            this.isLoading = ko.observable(false);
        },

        /**
         * Check if free shipping progress bar is enabled
         */
        isEnabled: function () {
            return window.checkoutConfig && 
                   window.checkoutConfig.freeShippingProgressBar && 
                   window.checkoutConfig.freeShippingProgressBar.enabled;
        },

        /**
         * Get free shipping minimum value
         */
        getFreeShippingMinValue: function () {
            if (!window.checkoutConfig || !window.checkoutConfig.freeShippingProgressBar) {
                return 0;
            }
            return parseFloat(window.checkoutConfig.freeShippingProgressBar.minValue) || 0;
        },

        /**
         * Get current cart total
         */
        getCurrentTotal: function () {
            var cartData = this.cart();
            if (!cartData || !cartData.subtotalAmount) {
                return 0;
            }
            return parseFloat(cartData.subtotalAmount) || 0;
        },

        /**
         * Check if cart is eligible for free shipping
         */
        isFreeShippingEligible: function () {
            return this.getCurrentTotal() >= this.getFreeShippingMinValue();
        },

        /**
         * Get difference between minimum and current total
         */
        getFreeShippingDifference: function () {
            return Math.max(0, this.getFreeShippingMinValue() - this.getCurrentTotal());
        },

        /**
         * Get completion percentage
         */
        getFreeShippingCompletionPercent: function () {
            var minValue = this.getFreeShippingMinValue();
            if (minValue <= 0) {
                return 100;
            }
            return Math.min(100, (this.getCurrentTotal() / minValue) * 100);
        },

        /**
         * Format price
         */
        getFormattedPrice: function (price, precision) {
            precision = precision || 2;
            return priceUtils.formatPrice(price, {
                pattern: window.checkoutConfig.priceFormat.pattern,
                precision: precision,
                requiredPrecision: precision,
                decimalSymbol: window.checkoutConfig.priceFormat.decimalSymbol,
                groupSymbol: window.checkoutConfig.priceFormat.groupSymbol,
                groupLength: window.checkoutConfig.priceFormat.groupLength,
                integerRequired: window.checkoutConfig.priceFormat.integerRequired
            });
        },

        /**
         * Get upsell message
         */
        getUpsellMessage: function () {
            var difference = this.getFreeShippingDifference();
            var formattedDifference = this.getFormattedPrice(difference);

            return $t('Add <span class="freeship-price">%1</span> more to get <span class="freeship-bold">FREE SHIPPING!</span>')
                .replace('%1', formattedDifference);
        },

        /**
         * Get eligible message
         */
        getEligibleMessage: function () {
            return $t('Your order is eligible for <span class="freeship-bold">FREE SHIPPING!</span>');
        },

        /**
         * Get progress background
         */
        getProgressBackground: function () {
            var percent = this.getFreeShippingCompletionPercent();
            var background = "linear-gradient(to right, #00b052 0%, #00b052 " + percent + "%, lightgreen)";

            if (percent > 90) {
                background = "linear-gradient(to right, #00b052 0%, #00b052 95%, lightgreen)";
            }

            return background;
        }
    });
});
