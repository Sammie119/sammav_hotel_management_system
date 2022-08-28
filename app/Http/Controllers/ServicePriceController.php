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

        $this->trackPriceChanges($setprice->service, $setprice->description, $setprice->price);
        
        return redirect('prices')->with('success', 'Price Updated Successfully!!');
    }
    
}
