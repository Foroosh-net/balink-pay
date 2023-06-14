<?php

namespace Balink\BalinkPay\Drivers\Aqayepardakht;

use Balink\BalinkPay\Drivers\BaseDriver;
use Balink\BalinkPay\Drivers\DriverInterface;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class Aqayepardakht extends BaseDriver implements DriverInterface {
    private $url;

    public function __construct()
    {
        $this->url = config('balinkpay.driver.aqayepardakht');
    }

    public function request()
    {
        $response = Http::withHeaders([
            'accept'    =>  'application/json',
            'content-type'  =>  'application/json'
        ])->post($this->url['request'], [
            'pin'           =>  $this->merchant,
            'amount'        =>  $this->amount,
            'callback_url'  =>  $this->callback,
            'description'   =>  $this->description
        ]);

        if($response->status() === 200) {
            $this->authority($response->object()->data->transid);
        }
    }

    public function redirect()
    {
        return Redirect::to($this->url['pay'] . $this->authority);
    }

    public function verify()
    {
        $response = Http::post($this->url['verify'], [
            'pin'           =>  $this->merchant,
            'amount'        =>  $this->amount,
            'authority'     =>  $this->authority
        ]);

        // if($response->status() == 200) {
            return $response->json()['data'];
        // }

        switch($response->json()['code']) {
            case 0:
                throw new Exception("پرداخت انجام نشد");
                break;
            case 2:
                throw new Exception("تراکنش قبلا وریفای شده");
                break;
        }
    }
}