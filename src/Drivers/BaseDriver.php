<?php

namespace Balink\BalinkPay\Drivers;

class BaseDriver implements DriverInterface {
    protected $merchant;
    protected $amount;
    protected $description;
    protected $callback;
    protected $authority;
    
    public function merchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    public function amount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function callback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    public function authority($authority)
    {
        $this->authority = $authority;
        return $this;
    }

    public function getAuthority() {
        return $this->authority;
    }

    public function request()
    {
        
    }

    public function redirect() {

    }

    public function verify()
    {
        
    }
}