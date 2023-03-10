<?php

namespace Balink\BalinkPay\Drivers;

interface DriverInterface {
    public function amount($amount);

    public function description($description);

    public function merchant($merchant);

    public function callback($callback);

    public function authority($authority);

    public function request();

    public function redirect();

    public function verify();
}