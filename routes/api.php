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