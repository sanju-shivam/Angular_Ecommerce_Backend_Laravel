<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Category
Route::post('category/delete','CategoryController@delet');
Route::post('category/create','CategoryController@create');
Route::get('category/show','CategoryController@show');
Route::post('category/edit','CategoryController@edit');
Route::post('category/update','CategoryController@update');

//SUB CATEGORY
Route::get('category/getallCategoryforsubcategories','SubCategoryController@getallCategoryforsubcategory');
Route::post('savesubcategories','SubCategoryController@savesubcategories');
Route::get('subcategory/show','SubCategoryController@subcategoryShow');
Route::post('subcategory/edit','SubCategoryController@subcategoryEdit');
Route::post('subcategory/delete','SubCategoryController@subcategoryDelete');
Route::post('subcategory/update','SubCategoryController@subcategoryUpdate');


//BRANDS
Route::post('brand/delete','BrandController@delet');
Route::post('brand/create','BrandController@create');
Route::get('brand/show','BrandController@show');
Route::post('brand/edit','BrandController@edit');
Route::post('brand/update','BrandController@update');


//PRODUCT
Route::get('product/gtallbrandcatsubcat','ProductController@getCat_SubCat_brand');
Route::post('product/save','ProductController@saveProduct');
Route::get('product/show','ProductController@show');
Route::post('product/delete','ProductController@delete');
Route::post('product/update','ProductController@update');
Route::post('product/statusupdate','ProductController@statusupdate');
Route::post('product/singelProduct','ProductController@viewProduct');
Route::post('product/editProduct','ProductController@editSingleProduct');


//ADD IMAGE OF SINGLE PRODUCT
Route::post('product/addImage','ProductController@addImage');
Route::post('product/editSingleProductImage','ProductController@editSingleProductImage');
Route::post('product/deleteSingleProductImage','ProductController@deleteSingleProductImage');



// BANNER 
Route::post('banner/save','BannerController@save');


// Coupons 
Route::resource('coupons','CouponsController');