<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\SubCategory;
use App\Brand;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function getCat_SubCat_brand()
    {
        header('Access-Control-Allow-Origin','*');
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
        header('Access-Control-Allow-Origin','*');
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
            header('Access-Control-Allow-Origin','*');
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
        header('Access-Control-Allow-Origin','*');
        $products = Product::all();
        return response()->json($products);
    }

    

    public function delete(Request $request)
    {
        //return response()->json($request->all()[0]);
        header('Access-Control-Allow-Origin','*');
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
        header('Access-Control-Allow-Origin','*');
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'BrandId'=>'required',
            'CategoryId'=>'required',
            'SubCategoryId' => 'required',
            'price'=>'required',
            'code' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }
        else
        {
            if(!empty($request->image)){
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
            }else{
                $p = Product::find($request->id)->update([
                    'name' => $request->name,  
                    'category_id' => $request->CategoryId,
                    'brand_id' => $request->BrandId,
                    'description' => $request->Description,
                    'price' => $request->price,
                    'subcategory_id' => $request->SubCategoryId,
                    'quantity' => $request->Quantity,
                    'discount_price' => $request->discountprice,
                    'code' => $request->code,
                ]);
            }
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
        header('Access-Control-Allow-Origin','*');
        $validator=Validator::make($request->all(),[
            'image' => 'required',
            'ProductId' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>'something went wrong', 'status'=>409,]);
        }

        header('Access-Control-Allow-Origin','*');
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
        header('Access-Control-Allow-Origin','*');
        $a = Product::find($request->id);
        $categoryname = category::find($a->category_id)->first()->name;
        $SubCategory =  SubCategory::find($a->subcategory_id)->first()->subcategory;
        $brand =  Brand::find($a->brand_id)->first()->name;
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
        header('Access-Control-Allow-Origin','*');
        $products = Product::Find($id);
        return response()->json($products);
    }


    public function editSingleProduct(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $product = Product::find($request->id);
        
        return response()->json([ 'product'=> $product ]);
    }

    public function editSingleProductImage(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $productImages = ProductImage::where('product_id','=',$request->id)->get();
        return response()->json([ 'productImage' => $productImages ]);
    }

    public function deleteSingleProductImage(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $product = ProductImage::where('id','=',$request->id)->where('product_id','=',$request->product_id['id'])->delete();
        if($product){
            return response()->json(['status' => 200]);
        }
    }


    public function statusupdate(Request $request)
    {
        header('Access-Control-Allow-Origin','*');        
        $prodcut = Product::find($request[1])->update([
            'status' => $request[0]
        ]);
        if($prodcut)
            return 1;
        else
            return 0;

    }

}
