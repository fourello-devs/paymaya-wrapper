<?php

use FourelloDevs\PaymayaWrapper\PaymayaWrapper;
use PayMaya\PayMayaSDK;

if (! function_exists('paymaya')) {

    /**
     * @return PaymayaWrapper
     */
    function paymaya(): PayMayaSDK
    {
        return resolve('paymayawrapper')->getInstance();
    }
}
