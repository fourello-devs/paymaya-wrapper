<?php

namespace FourelloDevs\PaymayaWrapper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PaymayaWrapper
 * @package FourelloDevs\PaymayaWrapper\Facades
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class PaymayaWrapper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'paymayawrapper';
    }
}
