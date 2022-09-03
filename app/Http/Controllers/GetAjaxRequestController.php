<?php

namespace App\Http\Controllers;

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
}
