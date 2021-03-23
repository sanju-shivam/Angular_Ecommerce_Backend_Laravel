<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['category_id','subcategory'];

    public function category()
    {
    	return $this->belongsTo('App\category','category_id','id');
    }
}
