<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $fillable = ['name','minimun_discount_amount','discount_percent','start_date','expiry_date'];
}
