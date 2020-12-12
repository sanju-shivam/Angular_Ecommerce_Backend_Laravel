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
        // $data = Coupons::all();
        header('Access-Control-Allow-Origin','*');
        return response()->json(['status' => 200,'data' => Coupons::all()]);
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
        header('Access-Control-Allow-Origin','*');
        return response()->json($coupons::find($id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupons $coupons,$id)
    {
        try{
                header('Access-Control-Allow-Origin','*');
                $coupons->find($id)->update([
                    'name' => $request->name,
                    'minimun_discount_amount' => $request->minimun_discount_amount,
                    'discount_percent' => $request->discount_percent,
                    'start_date' => $request->StartDate,
                    'expiry_date' => $request->ExpiryDate,
                ]);
                return true;
            }
            catch(Exception $e){
                return response()->json(['error'=>'some problem occures.try again'], 400);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupons $coupons,$id)
    {
        header('Access-Control-Allow-Origin','*');
        if($coupons::find($id)->delete()){
                return true;
        }
        else{
            return false;
        }
    }
}
