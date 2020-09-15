<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','code','category_id','brand_id','subcategory_id','quantity','status','price','discount_price','image'];

    public function category()
    {
    	return $this->belongsTo('App\category','category_id','id');
    }

    // public function subcategory()
    // {
    // 	return $this->belongsTo(SubCategory::class);
    // }

    // public function brands()
    // {
    // 	return $this->belongsTo(Brand::class);
    // }

    //  public function productImage()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }
}
