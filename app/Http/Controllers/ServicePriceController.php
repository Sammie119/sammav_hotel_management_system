<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use App\Models\ServicePrice;
use Illuminate\Http\Request;

class ServicePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setprices = ServicePrice::orderBy('description')->get();
        return view('admin.service_price', ['setprices' => $setprices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicePrice  $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ServicePrice $servicePrice)
    {
        $setprice = ServicePrice::find($request->id);
        $setprice->update([
            'price' => $request->price,
        ]);

        $history = new PriceHistory;
        $history->service = $setprice->service;
        $history->description = $setprice->description;
        $history->price = $setprice->price;
        $history->created_by = Auth()->user()->user_id;
        $history->save();

        return redirect('prices')->with('success', 'Price Updated Successfully!!');
    }
    
}
