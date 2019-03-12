<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alipay extends Model
{
    protected $table = 'alipay';
    protected $fillable = [
        'provider',
        'booking',
        'timestamp',
        'total_amount',
        'out_trade_no',
        'trade_no',
        'seller_id',
        'status'
    ];
}
