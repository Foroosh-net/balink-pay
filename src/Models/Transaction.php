<?php

namespace Balink\BalinkPay\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    use HasFactory;
    protected $fillable = [
        'amount',
        'merchant',
        'authority',
        'status'
    ];

    public function payable() {
        return $this->morphTo();
    }
}