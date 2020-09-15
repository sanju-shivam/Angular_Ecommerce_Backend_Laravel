<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SubCategory extends Model
{
    protected $fillable = ['category_id','subcategory'];

    public function category()
    {
    	return $this->belongsTo('App\category','category_id','id');
    }
}
