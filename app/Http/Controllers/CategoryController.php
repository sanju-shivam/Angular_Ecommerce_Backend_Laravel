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

    public function edit(Request $request)
    {
        $obj = category::where('id','=',$request->all()[0])->first();

        if($obj){
            return response()->json(['data'=>$obj,'status'=>200]);
        }
    }


    public function update(Request $request)
    {
        //return response()->json($request->id);
        $obj = Category::find($request->id)->update([
            'name' => $request->name,
        ]);

        if($obj){
            return response()->json(['status'=>200]);
        }
    }
}
