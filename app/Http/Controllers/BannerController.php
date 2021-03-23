<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use DB;

class BannerController extends Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin','*');
        $banners = Banner::all();

        return response()->json([
            'status' => 200,
            'data'  =>  $banners
        ]);
    }
    public function save(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
    	$banner = DB::table('banners')->insert([
    		'title' =>	$request->title,
    		'url'	=>	$request->url,
    		'image'	=>	$request->image
    	]);

    	return response()->json([
    		'status' => 200,
    	]);
    }

    public function edit(Request $request)
    {
        header('Access-Control-Allow-Origin','*');
        $id = $request->all()[0];
        $banner = Banner::find($id)->first();

        return ($banner);
    }
}
