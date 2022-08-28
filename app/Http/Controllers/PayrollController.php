<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\VWStaff;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = VWStaff::orderByDesc('staff_id')->get();
        return view('admin.payroll-payment', ['salary' => $salary]);
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
            'room_type_id' => 'required|numeric',
            'room_number' => 'required',
        ]);

        if($request->has('id')){
            $room = Payroll::find($request->id);
        }
        else {
            $room = new Payroll;
        }

        $room->room_type_id = $request->room_type_id;
        $room->room_number = $request->room_number;
        $room->room_name = $request->room_name;
        $room->description = $request->description;

        if($request->has('id')){
            $room->update();

            return redirect('rooms')->with('success', 'Room Updated Successfully!!');
        }
        else {
            $room->save();

            return redirect('rooms')->with('success', 'Room Created Successfully!!');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy($room_id)
    {
        $room = Payroll::find($room_id);
        $room->delete();

        return redirect('rooms')->with('success', 'Room Deleted Successfully!!');
    }
}
