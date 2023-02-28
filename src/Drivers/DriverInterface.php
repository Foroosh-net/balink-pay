<?php

namespace Balink\BalinkPay\Drivers;

interface DriverInterface {
    public function amount($amount);

    public function description($description);

    public function merchant($merchant);

    public function callback($callback);

    public function prepare();

    public function pay();

    public function verify($refId, $amount);
}