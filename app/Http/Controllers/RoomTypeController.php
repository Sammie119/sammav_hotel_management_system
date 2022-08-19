<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\ServicePrice;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('admin.room-types', ['roomTypes' => $roomTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->has('id')){
            $roomType = RoomType::find($request->id);

            ServicePrice::where('service', $roomType->name)->update(['service' => $request->name]);
        }
        else {
            $roomType = new RoomType;
        }

        $roomType->name = $request->name;
        $roomType->description = $request->description;

        if($request->has('id')){
            $roomType->update();

            return redirect('room_types')->with('success', 'Room Type Updated Successfully!!');
        }
        else {

            $this->servicePricing($roomType->name, 'Room Type', 0);

            $roomType->save();

            return redirect('room_types')->with('success', 'Room Type Created Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy($roomType)
    {
        $roomType = RoomType::find($roomType);

        ServicePrice::where('service', $roomType->name)->delete();

        $roomType->delete();

        return redirect('room_types')->with('success', 'Room Type Deleted Successfully!!');
    }
}
