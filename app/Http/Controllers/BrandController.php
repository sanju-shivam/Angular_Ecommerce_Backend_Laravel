<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function create(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
    	$obj = new Brand;
    	$obj->name = $request->name;
    	$obj->save();

    	return response()->json(['message'=>'Brand Created','status'=>200]);
    }

    public function show()
    {
    	$obj = Brand::all();
        header('Access-Control-Allow-Origin','*');
    	return response()->json($obj);
    }


    public function delet(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $obj = Brand::where('id','=',$request->all()[0])->delete();
        return response()->json(['message'=>'Brand Deleted','status'=>200]);
    }

    public function edit(Request $request)
    {
        $obj = Brand::where('id','=',$request->all()[0])->first();
        header('Access-Control-Allow-Origin','*');
        if($obj){
            return response()->json(['data'=>$obj,'status'=>200]);
        }
    }


    public function update(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $obj = Brand::find($request->id)->update([
            'name' => $request->name,
        ]);

        if($obj){
            return response()->json(['status'=>200]);
        }
    }
}
