<?php

namespace Balink\BalinkPay\Drivers\Zarinpal;

use Balink\BalinkPay\Drivers\BaseDriver;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class Zarinpal extends BaseDriver {
    private $urls;

    public function __construct()
    {
        $this->urls  = config('balinkpay.driver.zarinpal.main');
    }

    public function request()
    {
        $response = Http::withHeaders([
            'accept'    =>  'application/json',
            'content-type'  =>  'application/json'
        ])->post($this->urls['request'], [
            'merchant_id'   =>  $this->merchant,
            'amount'        =>  $this->amount,
            'callback_url'  =>  $this->callback,
            'description'   =>  $this->description
        ]);

        if($response->status() == 200) {
            // create transaction and return authority
            if(count($response->json()['errors'])) {
                $errors = '';
                foreach($response->json()['errors']['validations'] as $error)
                    foreach($error as $message)
                        $errors .= PHP_EOL . $message;

                throw new Exception($errors, $response->json()['errors']['code']);
            }
            $this->authority($response->object()->data->authority);
            return $this;
        } else {
            throw new Exception("something got wrong", 500);
        }
    }

    public function redirect()
    {
        return Redirect::to($this->urls['pay'] . $this->authority);
    }

    public function getPaymentURL() : String {
        return $this->urls['pay'] . $this->authority;
    }

    public function verify()
    {
        $response = Http::post($this->urls['verify'], [
            'merchant_id'   =>  $this->merchant,
            'amount'        =>  $this->amount,
            'authority'     =>  $this->authority
        ]);

        if($response->status() == 200) {
            return $response->json()['data'];
        }

        switch($response->json()['errors']['code']) {
            case -50:
                throw new Exception("مبلغ پرداخت شده با مقدار مبلغ در وریفای متفاوت است");
                break;
            case -51:
                throw new Exception("پرداخت ناموفق");
                break;
            case -52:
                throw new Exception("خطای غیر منتظره");
                break;
            case -53:
                throw new Exception("کد رهگیری پرداخت برای این فروشنده نیست");
                break;
            case -54:
                throw new Exception("کد رهگیری نامعتبر است");
                break;
        }
    }
}
