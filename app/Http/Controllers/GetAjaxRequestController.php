<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\VWStaff;
use Illuminate\Http\Request;

class GetAjaxRequestController extends Controller
{
    public function getRoomFromRoomType(Request $request)
    {
        $rooms = Room::where('room_type_id', $request['roomtype'])->get();
        echo '<option value="" disabled selected>Room Number</option>';
        foreach ($rooms as $room) {
            echo'<option value="'.$room->room_id.'">'.$room->room_number.'</option>';
        }
    }

    public function getStaffInfo(Request $request)
    {
        $staff = VWStaff::where('fullname', $request['staff'])->first();

        if($staff){
            $results = [
                'staff_id' => $staff->staff_id,
                'position' =>$staff->position,
                'salary' =>$staff->salary,
            ];
        }
        else{
            $results = [
                'staff_id' => 'No_data'
            ];
        }

        return response()->json($results);
    }

    public function getSMSRecipient(Request $request)
    {
        $staff = VWStaff::where('fullname', $request['recipient'])->first();

        $customer = Customer::where('name', $request['recipient'])->first();

        if(isset($staff)){
            $results = [
                'name' => $staff->fullname,
                'phone' => $staff->phone,
            ];
        }
        elseif (isset($customer)) {
            $results = [
                'name' => $customer->name,
                'phone' => $customer->phone,
            ];
        }
        else{
            $results = [
                'phone' => 'No_data'
            ];
        }

        return response()->json($results);
    }
}
