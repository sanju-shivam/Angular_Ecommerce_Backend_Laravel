<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
    	$obj = new category;
    	$obj->name = $request->name;
    	$obj->save();

    	return response()->json(['message'=>'Category Created','status'=>200]);
    }

    public function show()
    {
    	$obj = category::all();

    	return response()->json($obj);
    }


    public function delet(Request $request)
    {
        $obj = category::where('id','=',$request->all()[0])->delete();
            return response()->json(['message'=>'Category Deleted','status'=>200]);
    }
}
