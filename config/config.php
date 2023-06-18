<?php

return [
    "debug"         =>  env("APP_DEBUG", true),

    "driver"        =>  [
        "zarinpal"   =>  [
            "main"      =>  [
                "request"   =>  "https://api.zarinpal.com/pg/v4/payment/request.json",
                "verify"    =>  "https://api.zarinpal.com/pg/v4/payment/verify.json",
                "pay"       =>  "https://www.zarinpal.com/pg/StartPay/"
            ],
            "sandbox"   =>  [
                "request"   =>  "https://sandbox.zarinpal.com/pg/v4/payment/request.json",
                "verify"    =>  "https://sandbox.zarinpal.com/pg/v4/payment/verify.json",
                "pay"       =>  "https://sandbox.zarinpal.com/pg/StartPay/"
            ]
        ],
    ]
];