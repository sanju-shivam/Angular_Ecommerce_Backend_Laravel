<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;

class category extends Model
{
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
