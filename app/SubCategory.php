<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\category;

class SubCategory extends Model
{
    protected $fillable = ['category_id','subcategory'];
}
