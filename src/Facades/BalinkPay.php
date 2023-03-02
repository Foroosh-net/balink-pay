<?php

namespace Balink\BalinkPay\Facades;

use Illuminate\Support\Facades\Facade;

class BalinkPay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BalinkPay';
    }
}