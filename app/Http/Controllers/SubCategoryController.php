<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\SubCategory;
use DB;

class SubCategoryController extends Controller
{
    public function getallCategoryforsubcategory()
    {
    	header('Access-Control-Allow-Origin','*');
    	$obj = category::select('name','id')->get();
    	return response()->json($obj);
    }

    public function savesubcategories(Request $Request)
    {
    	//return response()->json($Request->all());
    	$obj= new SubCategory;
    	$obj->category_id = $Request->CategoryId;
    	$obj->subcategory = $Request->SubCategoryName;
    	$obj->save();
    	if($obj){
    	    return response()->json(['status' => 200]);
    	}
    }

    public function subcategoryShow()
    {
        $obj    =   DB::table('sub_categories')
                    ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
                    ->select('categories.name', 'sub_categories.id', 'sub_categories.subcategory')
                    ->get();
        return response()->json($obj);
    }

    public function subcategoryEdit(Request $request)
    {
        $obj = SubCategory::where('id','=',$request->all()[0])->first();
        if($obj){
            return response()->json(['data'=>$obj,'status'=>200]);
        }
    }

    public function subcategoryDelete(Request $request)
    {
        $obj = SubCategory::find($request->all()[0])->delete();
            return response()->json(['message'=>'Sub Category Deleted','status'=>200]);
    }

    public function subcategoryUpdate(Request $request)
    {
        $obj = SubCategory::find($request->id)->update([
            'name' => $request->name,
            'category_id' => $request->CategoryId,
            'subcategory' => $request->SubCategoryName,
        ]);

        if($obj){
            return response()->json(['status'=>200]);
        }
    }
}
