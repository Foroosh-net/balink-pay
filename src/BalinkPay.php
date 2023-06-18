<?php

namespace Balink\BalinkPay;

use Balink\BalinkPay\Drivers\Zarinpal\Zarinpal;
use Balink\BalinkPay\Enums\Gateway;
use Exception;

class BalinkPay {
    public function gate($driver) {
        switch($driver) {
            case Gateway::ZARINPAL->value:
                return new Zarinpal();
            default:
                return new Exception("Payment Gateway not found", 404);
        }
    }
}
