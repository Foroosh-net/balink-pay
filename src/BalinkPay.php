<?php

namespace Balink\BalinkPay;

use Balink\BalinkPay\Drivers\Zarinpal\Zarinpal;

class BalinkPay {
    public function gate($driver) {
        switch($driver) {
            case 'zarinpal':
                return new Zarinpal();
        }
    }
}
