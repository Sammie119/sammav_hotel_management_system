<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
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
        if($request->has('id')){
            $roomType = RoomType::find($request->id);
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
        $roomType->delete();

        return redirect('room_types')->with('success', 'Room Type Deleted Successfully!!');
    }
}
