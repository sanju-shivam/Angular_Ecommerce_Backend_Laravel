<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
	use SoftDeletes;
	
    protected $fillable=['product_id','image'];

    public function product()
    {
    	return $this->belongsTo('App\Product','product_id','id');
    }

   
}
