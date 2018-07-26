<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wechat extends Model
{
    protected $table = 'wechat';
    protected $fillable = ['provider', 'booking', 'amount', 'status', 'transaction_id',	'booking_name','booking_date', 'bank_type'];
}
