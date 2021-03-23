<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['name','minimun_discount_amount','discount_percent','start_date','expiry_date'];
}
