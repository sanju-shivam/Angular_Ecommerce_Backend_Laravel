<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\SubCategory;
use App\Brand;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getCat_SubCat_brand()
    {
    	$categories = category::all();
    	$subcategories = SubCategory::all();
    	$brands = Brand::all();

    	return  response()->json([
    	    		'category' => $categories,
    	    		'subcategory' => $subcategories,
    	    		'brand' => $brands
    	    	]);
    }

    public function saveProduct(Request $request)
    {  
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'BrandId'=>'required',
            'CategoryId'=>'required',
            'Description'=>'required',
            'SubCategoryId' => 'required',
            'price'=>'required',
            'image' => 'required',
            'Quantity' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>'sakbkg', 'status'=>409,]);
        }
        else
        {
            $p = new Product;
            $p->name = $request->name;  
            $p->category_id = $request->CategoryId;
            $p->brand_id = $request->BrandId;
            $p->description = $request->Description;
            $p->price = $request->price;
            $p->subcategory_id = $request->SubCategoryId;
            $p->quantity = $request->Quantity;
            $p->discount_price = $request->discountprice;
            $p->image = $request->image;
            $p->code = $request->code;
            $p->save();

            if($p){
                return response()->json([
                    'status'=>200,
                ]);
            }
            else{
                    return response()->json($data=[
                    'status'=>203,
                    'msg'=>'something went wrong'
                   ]);
                } 
        }     
    }


    public function show()
    {
        $products = Product::all();
        return response()->json($products);
    }

    

    public function delete(Request $request)
    {
        //return response()->json($request->all()[0]);
        $obj = Product::find($request->all()[0])->delete();
        $product_images = ProductImage::where('product_id','=',$request->all()[0])->delete();
        if($obj){
            return response()->json([
                    'status'=>200,
                ]);
        }
        else{
            return response()->json($data=[
                'status'=>203,
           ]);
        }    
    }


    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'BrandId'=>'required',
            'CategoryId'=>'required',
            'SubCategoryId' => 'required',
            'price'=>'required',
            'image' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }
        else
        {
            $p = Product::find($request->id)->update([
                'name' => $request->name,  
                'category_id' => $request->CategoryId,
                'brand_id' => $request->BrandId,
                'description' => $request->Description,
                'price' => $request->price,
                'subcategory_id' => $request->SubCategoryId,
                'quantity' => $request->Quantity,
                'discount_price' => $request->discountprice,
                'image' => $request->image,
                'code' => $request->code,
            ]);

            if($p){
                return response()->json([
                    'status'=>200,
                ]);
            }
            else{
                    return response()->json($data=[
                    'status'=>203,
                    'msg'=>'something went wrong'
                   ]);
                } 
        }
    }


    public function addImage(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'image' => 'required',
            'ProductId' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>'something went wrong', 'status'=>409,]);
        }

        $ProductAddImageObject = ProductImage::create([
            'product_id' => $request->ProductId,
            'image' => $request->image,
        ]);

        if($ProductAddImageObject){
            return response()->json([
                    'status'=>200,
            ]);
        }
        return response()->json($data=[
                'status'=>203,
        ]);
    }

    public function viewProduct(Request $request)
    {
        //return response()->json($request->id);
        $a = Product::find($request->id);
        $categoryname = category::find($a->category_id)->first()->name;
        $SubCategory =  SubCategory::find($a->subcategory_id)->first()->subcategory;
        $brand =  Brand::find($a->brand_id)->first()->name;
         //dd($categoryname,$SubCategory, $brand);
        $productImages = ProductImage::where('product_id','=',$request->id)->get();
        return response()->json([
                    'product' =>$a,
                    'images' => $productImages,
                    'category' => $categoryname,
                    'subcategory' => $SubCategory,
                    'brand' => $brand,
                    ]);
    }

    public function showSingleProduct($id)
    {
        $products = Product::Find($id);
        
        return response()->json($products);
    }
}
