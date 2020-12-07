<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    public function save(Request $request)
    {
    	$banner = Banner::create([
    		'title' =>	$request->title,
    		'url'	=>	$request->url,
    		'image'	=>	$request->image
    	]);

    	return response()->json([
    		'status' => 200,
    	]);
    }
}
