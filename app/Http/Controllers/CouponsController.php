<?php

namespace App\Http\Controllers;

use App\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupons::all();
         return response()->json(['status' => 200,'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        header('Access-Control-Allow-Origin','*');
        // return response(json_decode(json_encode($request->all()), true));
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'minimun_discount_amount'=>'required',
            'discount_percent'=>'required',
            'StartDate'=>'required',
            'ExpiryDate' => 'required',
        ]);

         if($validator->fails())
        {
            return response()->json(['status'=>409,'error'=>$validator->messages()->get('*')]);
        }
        else
        {
            $coupon = Coupons::create([
                'name' => $request->name,
                'minimun_discount_amount' => $request->minimun_discount_amount,
                'discount_percent' => $request->discount_percent,
                'start_date' => $request->StartDate,
                'expiry_date' => $request->ExpiryDate,
            ]);
            return response()->json(['status' => 200]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function show(Coupons $coupons)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupons $coupons,$id)
    {
        return response()->json($coupons::find($id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupons $coupons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupons $coupons)
    {
        //
    }
}
