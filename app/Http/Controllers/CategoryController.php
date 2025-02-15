<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Cache;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
    	$obj = new category;
    	$obj->name = $request->name;
    	$obj->save();

    	return response()->json(['message'=>'Category Created','status'=>200]);
    }

    public function show()
    {
    
        header('Access-Control-Allow-Origin','*');
    	$obj = Cache::remember('category', 1000, function () {
           return  category::select('id','name')->get(); 
        });
    	return response()->json($obj);
    }


    public function delet(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $obj = category::where('id','=',$request->all()[0])->delete();
            return response()->json(['message'=>'Category Deleted','status'=>200]);
    }

    public function edit(Request $request)
    {
        $obj = category::where('id','=',$request->all()[0])->first();
        header('Access-Control-Allow-Origin','*');
        if($obj){
            return response()->json(['data'=>$obj,'status'=>200]);
        }
    }


    public function update(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $obj = Category::find($request->id)->update([
            'name' => $request->name,
        ]);

        if($obj){
            return response()->json(['status'=>200]);
        }
    }
}
