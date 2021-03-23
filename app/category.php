<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['name'];

    public function subcategory()
    {
    	return $this->hasMany('App\SubCategory');
    }

    public function product()
    {
    	return $this->hasMany('App\Product');
    }
}
