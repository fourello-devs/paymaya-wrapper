<?php

namespace FourelloDevs\PaymayaWrapper;

use PayMaya\API\Customization;
use PayMaya\PayMayaSDK;

/**
 * Class PaymayaWrapper
 * @package FourelloDevs\PaymayaWrapper
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class PaymayaWrapper extends PayMayaSDK
{
    public function __construct()
    {
        // Initialize PaymayaSDK
        $this->initializePaymayaSDK();

        // Customize PayMaya Checkout Page
        $this->customizePaymayaCheckoutPage();

        parent::__construct();
    }

    /**
     * Initialize PaymayaWrapper SDK
     */
    protected function initializePaymayaSDK()
    {
        // Initialize Checkout
        PayMayaSDK::getInstance()->initCheckout(config('paymayawrapper.checkout.key.public'), config('paymayawrapper.checkout.key.secret'), config('paymayawrapper.checkout.environment'));

        // Initialize Payment
        PayMayaSDK::getInstance()->initPayments(config('paymayawrapper.payments.key.public'), config('paymayawrapper.payments.key.secret'), config('paymayawrapper.payments.environment'));
    }

    /**
     * Customize PaymayaWrapper Checkout Page
     */
    protected function customizePaymayaCheckoutPage(): void
    {
        $shopCustomization = new Customization();
        $shopCustomization->logoUrl = asset(config('paymayawrapper.logo_url'));
        $shopCustomization->iconUrl = asset(config('paymayawrapper.icon_url'));
        $shopCustomization->appleTouchIconUrl = asset(config('paymayawrapper.apple_touch_icon_url'));
        $shopCustomization->customTitle = config('paymayawrapper.custom_title');
        $shopCustomization->colorScheme = config('paymayawrapper.color_scheme');
        $shopCustomization->set();
    }
}
