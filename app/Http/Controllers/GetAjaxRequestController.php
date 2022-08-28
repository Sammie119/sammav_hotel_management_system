<?php

namespace App\Http\Controllers;

use App\Models\Room;
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
}
